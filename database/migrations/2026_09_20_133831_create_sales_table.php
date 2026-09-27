<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->unsignedInteger('sale_id')->autoIncrement()->primary();
            $table->unsignedInteger('employee_id')->nullable();
            $table->dateTime('sale_date')->useCurrent();

            $table->foreign('employee_id')
                ->references('employee_id')
                ->on('employee')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};