<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $states = ['pending', 'in_progress', 'done'];

        $users = User::pluck('id')->toArray();
        return [
            'title'=> fake()->sentence(3),
            'description'=> fake()->sentence(8),
            'status'=> fake()->randomElement($states),
            'user_id'=> fake()->randomElement($users),
        ];
    }
}
