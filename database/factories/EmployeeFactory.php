<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $roles = ['admin', 'staff'];
        return [
            'name' => fake()->name(),
            'username' => fake()->userName(),
            'password' => fake()->password(8),
            'role' => Arr::random($roles),
        ];
    }
}