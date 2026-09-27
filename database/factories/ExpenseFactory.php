<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->randomElement([
                'Electricity Bill',
                'Water Bill',
                'Internet',
                'Office Supplies',
                'Transportation',
                'Maintenance',
            ]),
            'amount' => fake()->randomFloat(2, 100, 50000),
            'currency' => 'AFN',
            'pay_date' => fake()->date(),
            'employee_id' => Employee::factory(),
            'receiver' => fake()->name(),
        ];
    }
}