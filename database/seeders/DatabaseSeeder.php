<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Employee::factory(10)->create();
        \App\Models\Supplier::factory(10)->create();
        \App\Models\Product::factory(10)->create();
        \App\Models\Subscriber::factory(10)->create();
        \App\Models\EmployeeReference::factory(10)->create();
        \App\Models\User::factory(10)->create();
        \App\Models\UserLevel::factory(10)->create();
        \App\Models\Buy::factory(10)->create();
        \App\Models\Order::factory(10)->create();
        \App\Models\OrderDetail::factory(10)->create();
        \App\Models\Sale::factory(10)->create();
        \App\Models\SalesDetail::factory(10)->create();
        \App\Models\SalesReturn::factory(10)->create();
        \App\Models\Expense::factory(10)->create();


    }
}