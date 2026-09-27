<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->unsignedInteger('product_id')->autoIncrement()->primary();
            $table->string('product_name', 150);
            $table->string('category', 100);
            $table->decimal('unitprice', 12, 2);
            $table->unsignedInteger('quantity')->default(0);
            $table->string('image', 255)->nullable();
            $table->date('store_date');
            $table->string('location', 100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};