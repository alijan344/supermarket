<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buy>
 */
class BuyFactory extends Factory
{
    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 100);
        $unitprice = fake()->randomFloat(2, 10, 1000);

        return [
            'product_id' => Product::factory(),
            'product_name' => fake()->words(2, true),
            'category' => fake()->randomElement([
                'Dairy',
                'Beverages',
                'Bakery',
                'Fruits',
                'Vegetables',
                'Meat',
            ]),
            'description' => fake()->sentence(),
            'quantity' => $quantity,
            'unitprice' => $unitprice,
            'totalprice' => $quantity * $unitprice,
            'supplier_id' => Supplier::factory(),
            'employee_id' => Employee::factory(),
            'buy_date' => fake()->date(),
            'manufacture_date' => fake()->date(),
            'expire_date' => fake()->date(),
        ];
    }
}