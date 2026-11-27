<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pet_shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['Dog', 'Cat', 'Bird', 'Other']);
            $table->string('breed')->nullable();
            $table->date('birth_date');
            $table->string('owner_first_name');
            $table->string('owner_last_name');
            $table->string('owner_phone');
            $table->date('next_vaccination_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_shops');
    }
};
