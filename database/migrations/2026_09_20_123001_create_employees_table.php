<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->unsignedInteger('employee_id')->autoIncrement()->primary();
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->string('position', 100);
            $table->string('education', 100);
            $table->string('phone', 20)->unique();
            $table->string('email', 100)->nullable()->unique();
            $table->string('address', 255);
            $table->string('image', 255);
            $table->string('gender', 20);
            $table->date('hire_date');
            $table->date('dob');
            $table->string('marital_status', 30);
            $table->decimal('salary', 12, 2);
            $table->string('shift', 30);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};