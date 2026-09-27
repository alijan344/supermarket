<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscriber>
 */
class SubscriberFactory extends Factory
{
    public function definition(): array
    {
        return [
            'subscriber_name' => fake()->name(),
            'image' => 'subscribers/default.jpg',
            'phone' => fake()->unique()->numerify('07########'),
            'email' => fake()->unique()->safeEmail(),
            'dob' => fake()->date(),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'address' => fake()->address(),
        ];
    }
}