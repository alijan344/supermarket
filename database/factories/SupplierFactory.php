<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Supplier>
 */
class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company(),

            'phone' => fake()->unique()->numerify('07########'),

            'email' => fake()->unique()->safeEmail(),

            'supplier_type' => fake()->randomElement([
                'Local',
                'Wholesale',
                'Distributor',
                'Manufacturer',
            ]),

            'location' => fake()->city(),
        ];
    }
}