<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'product_name' => fake()->words(2, true),

            'category' => fake()->randomElement([
                'Food',
                'Beverages',
                'Dairy',
                'Cleaning',
                'Personal Care',
                'Snacks',
            ]),

            'unitprice' => fake()->randomFloat(2, 10, 1000),

            'quantity' => fake()->numberBetween(1, 100),

            'image' => 'products/default.jpg',

            'store_date' => fake()->date(),

            'location' => fake()->randomElement([
                'Shelf A',
                'Shelf B',
                'Shelf C',
                'Warehouse',
            ]),
        ];
    }
}