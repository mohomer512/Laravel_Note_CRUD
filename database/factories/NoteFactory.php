<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Note;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => User::factory(), // إنشاء مستخدم عشوائي عند إنشاء ملاحظة
            'note' => $this->faker->paragraph,
           // 'note' => fake()->realText(2000),
           // 'id' => 1
        ];
    }
}
