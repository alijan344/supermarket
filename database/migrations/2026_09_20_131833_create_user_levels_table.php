<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_level', function (Blueprint $table) {
            $table->unsignedInteger('employee_id')->primary();
            $table->boolean('head')->default(false);
            $table->boolean('hr')->default(false);
            $table->boolean('inventory')->default(false);
            $table->boolean('finance')->default(false);

            $table->foreign('employee_id')
                ->references('employee_id')
                ->on('employee')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_level');
    }
};