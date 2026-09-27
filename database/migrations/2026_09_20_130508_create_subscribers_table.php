<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriber', function (Blueprint $table) {
            $table->unsignedInteger('subscriber_id')->autoIncrement()->primary();
            $table->string('subscriber_name', 100);
            $table->string('image', 255)->nullable();
            $table->string('phone', 20)->unique();
            $table->string('email', 100)->nullable()->unique();
            $table->date('dob');
            $table->string('gender', 20);
            $table->string('address', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriber');
    }
};