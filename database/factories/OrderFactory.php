<?php

namespace Database\Factories;

use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'subscriber_id' => Subscriber::factory(),
            'order_date' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}