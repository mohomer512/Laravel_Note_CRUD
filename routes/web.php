<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




route::redirect('/','/note')->name('dashboard');
route::middleware(['auth','verified'])->group(function () {


    //Route::get('/note', [NoteController::class,'index'])->name('note.index');
//Route::get('/note/create', [NoteController::class,'create'])->name('note.create');
//Route::post('/note',[NoteController::class,'store'])->name('note.store');
//Route::get('/note/{id}/',[NoteController::class,'show'])->name('note.show');
//Route::get('/note/{id}/edit',action: [NoteController::class,'edit'])->name('note.edit');
//Route::put('/note/{id}',action: [NoteController::class,'update'])->name('note.update');
//Route::delete('/note/{id}',action: [NoteController::class,'destroy'])->name('note.destroy');


Route::resource('note', NoteController::class);


});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
