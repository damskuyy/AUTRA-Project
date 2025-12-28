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
            $table->dateTime('waktu');
            $table->decimal('suhu', 5, 2); // Temperature in Celsius (e.g., 28.50)
            $table->integer('cahaya'); // Light intensity in Lux
            $table->decimal('kelembapan', 5, 2); // Humidity in percentage (e.g., 65.50)
            $table->enum('status', ['Normal', 'Warning', 'Danger'])->default('Normal');
            $table->timestamps();
            
            // Indexes for better query performance
            $table->index('waktu');
            $table->index('status');
            $table->index('created_at');
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