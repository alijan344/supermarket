<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesReturn>
 */
class SalesReturnFactory extends Factory
{
    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 20);
        $unitprice = fake()->randomFloat(2, 10, 1000);

        return [
            'product_id' => Product::factory(),
            'return_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'reason' => fake()->randomElement([
                'Damaged product',
                'Expired product',
                'Wrong product',
                'Customer request',
                'Quality problem',
            ]),
            'quantity' => $quantity,
            'unitprice' => $unitprice,
            'totalprice' => $quantity * $unitprice,
        ];
    }
}