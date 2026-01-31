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
        Schema::create('sensor_readings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->float('sensor1')->nullable(); // Humidity
            $table->float('sensor2')->nullable(); // Temperature
            $table->float('sensor3')->nullable(); // Lux

            $table->enum('status', ['ONLINE', 'OFFLINE', 'NO_DATA']);
            $table->timestamp('received_at')->useCurrent();

            $table->timestamps();

            // Index untuk performa dashboard
            $table->index('received_at');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_readings');
    }
};
