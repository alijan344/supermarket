<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->unsignedInteger('order_id')->autoIncrement()->primary();
            $table->unsignedInteger('subscriber_id');
            $table->dateTime('order_date')->useCurrent();

            $table->foreign('subscriber_id')
                ->references('subscriber_id')
                ->on('subscriber')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};