<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_detail', function (Blueprint $table) {
            $table->unsignedInteger('detail_id')->autoIncrement()->primary();
            $table->unsignedInteger('sale_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('quantity');
            $table->decimal('unitprice', 12, 2);
            $table->decimal('totalprice', 12, 2);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('totalamount', 12, 2);

            $table->foreign('sale_id')
                ->references('sale_id')
                ->on('sales')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('product_id')
                ->references('product_id')
                ->on('product')
                ->onDelete('no action')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_detail');
    }
};