<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class EmployeeFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'designation' => fake()->randomElement(['Manager', 'Developer', 'Designer', 'Analyst', 'QA Engineer', 'Team Lead']),
        ];
    }
}
