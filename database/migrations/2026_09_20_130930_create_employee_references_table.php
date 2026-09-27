<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_reference', function (Blueprint $table) {
            $table->unsignedInteger('reference_id')->autoIncrement()->primary();
            $table->unsignedInteger('employee_id');
            $table->string('reference_name', 100);
            $table->string('organization', 150);
            $table->string('position', 100);
            $table->string('phone', 20)->nullable()->unique();
            $table->string('email', 100)->nullable()->unique();

            $table->foreign('employee_id')
                ->references('employee_id')
                ->on('employee')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_reference');
    }
};