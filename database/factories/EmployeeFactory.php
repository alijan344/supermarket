<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),

            'position' => fake()->randomElement([
                'Manager',
                'Cashier',
                'Salesperson',
                'Accountant',
                'Storekeeper',
                'HR',
            ]),

            'education' => fake()->randomElement([
                'High School',
                'Bachelor',
                'Master',
            ]),

            'phone' => fake()->unique()->numerify('07########'),

            'email' => fake()->unique()->safeEmail(),

            'address' => fake()->address(),

            'image' => 'employees/default.jpg',

            'gender' => fake()->randomElement([
                'Male',
                'Female',
            ]),

            'hire_date' => fake()->date(),

            'dob' => fake()->date(),

            'marital_status' => fake()->randomElement([
                'Single',
                'Married',
            ]),

            'salary' => fake()->randomFloat(2, 10000, 50000),

            'shift' => fake()->randomElement([
                'Morning',
                'Afternoon',
                'Night',
            ]),
        ];
    }
}