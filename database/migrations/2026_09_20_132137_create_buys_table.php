<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buy', function (Blueprint $table) {
            $table->unsignedInteger('buy_id')->autoIncrement()->primary();
            $table->unsignedInteger('product_id');
            $table->string('product_name', 150);
            $table->string('category', 100);
            $table->text('description')->nullable();
            $table->unsignedInteger('quantity');
            $table->decimal('unitprice', 12, 2);
            $table->decimal('totalprice', 12, 2);
            $table->unsignedInteger('supplier_id');
            $table->unsignedInteger('employee_id')->nullable();
            $table->date('buy_date');
            $table->date('manufacture_date');
            $table->date('expire_date')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('product_id')
                ->references('product_id')
                ->on('product')
                ->onDelete('no action')
                ->onUpdate('cascade');

            $table->foreign('supplier_id')
                ->references('supplier_id')
                ->on('supplier')
                ->onDelete('no action')
                ->onUpdate('cascade');

            $table->foreign('employee_id')
                ->references('employee_id')
                ->on('employee')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buy');
    }
};