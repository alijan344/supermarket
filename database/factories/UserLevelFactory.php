<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserLevel>
 */
class UserLevelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'head' => fake()->boolean(),
            'hr' => fake()->boolean(),
            'inventory' => fake()->boolean(),
            'finance' => fake()->boolean(),
        ];
    }
}