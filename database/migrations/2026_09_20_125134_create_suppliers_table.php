<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->unsignedInteger('supplier_id')->autoIncrement()->primary();
            $table->string('name', 100);
            $table->string('phone', 20)->nullable()->unique();
            $table->string('email', 100)->nullable()->unique();
            $table->string('supplier_type', 50);
            $table->string('location', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supplier');
    }
};