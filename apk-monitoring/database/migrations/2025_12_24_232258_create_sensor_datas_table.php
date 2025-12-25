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
        Schema::create('sensor_datas', function (Blueprint $table) {
            $table->id();
            $table->string('waktu'); // Format: 25/12/2025, 06.12.47
            $table->decimal('suhu', 5, 1); // Temperature in Celsius
            $table->integer('cahaya'); // Light in Lux
            $table->decimal('kelembapan', 5, 1); // Humidity in percentage
            $table->enum('status', ['Normal', 'Warning', 'Danger'])->default('Normal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_datas');
    }
};