<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_return', function (Blueprint $table) {
            $table->unsignedInteger('return_id')->autoIncrement()->primary();
            $table->unsignedInteger('product_id');
            $table->dateTime('return_date')->useCurrent();
            $table->string('reason', 255);
            $table->unsignedInteger('quantity');
            $table->decimal('unitprice', 12, 2);
            $table->decimal('totalprice', 12, 2);

            $table->foreign('product_id')
                ->references('product_id')
                ->on('product')
                ->onDelete('no action')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_return');
    }
};