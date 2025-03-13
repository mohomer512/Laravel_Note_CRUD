<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $notes = Note::query()->where('user_id', request()->user()->id)->orderBy('created_at','desc')->paginate(10);


      //  $notes = Note::orderBy("created_at", "desc")->paginate(10);
        //dd($notes);
        return view('note.index', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // التحقق من البيانات المدخلة
        $data = $request->validate([
            'note' => ['required', 'string'],
        ]);

        // إضافة user_id للبيانات
        $data['user_id'] = $request->user()->id; // يمكنك استخدام Auth::id() للمستخدم الحالي

        // إنشاء الملاحظة
        $note = Note::create($data);

        // إعادة التوجيه مع رسالة نجاح
        return to_route('note.show', $note)->with('message', 'Note has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {


        if ($note->user_id !== request()->user()->id) {
            abort(403);
            }
        return view('note.show', ['note' => $note]);
    
             }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        
        if ($note->user_id !== request()->user()->id) {
            abort(403);
            }

        return view('note.edit', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {

        
        if ($note->user_id !== request()->user()->id) {
            abort(403);
            }
        // التحقق من البيانات المدخلة
        $data = $request->validate([
            'note' => ['required', 'string'],
        ]);


        $note->update($data);

        // إعادة التوجيه مع رسالة نجاح
        return to_route('note.show', $note)->with('message', 'Note has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {

        
        if ($note->user_id !== request()->user()->id) {
            abort(code: 403);
            }

        $note->delete();
        return to_route('note.index')->with('message', 'note has been deleted');
    }
}
