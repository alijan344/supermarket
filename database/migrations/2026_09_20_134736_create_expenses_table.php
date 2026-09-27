<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expense', function (Blueprint $table) {
            $table->unsignedInteger('expense_id')->autoIncrement()->primary();
            $table->string('title', 150);
            $table->decimal('amount', 12, 2);
            $table->string('currency', 10);
            $table->date('pay_date');
            $table->unsignedInteger('employee_id')->nullable();
            $table->string('receiver', 100);

            $table->foreign('employee_id')
                ->references('employee_id')
                ->on('employee')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expense');
    }
};