<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesDetail>
 */
class SalesDetailFactory extends Factory
{
    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 20);
        $unitprice = fake()->randomFloat(2, 10, 1000);
        $totalprice = $quantity * $unitprice;
        $discount = fake()->randomFloat(2, 0, $totalprice * 0.10);
        $totalamount = $totalprice - $discount;

        return [
            'sale_id' => Sale::factory(),
            'product_id' => Product::factory(),
            'quantity' => $quantity,
            'unitprice' => $unitprice,
            'totalprice' => $totalprice,
            'discount' => $discount,
            'totalamount' => $totalamount,
        ];
    }
}