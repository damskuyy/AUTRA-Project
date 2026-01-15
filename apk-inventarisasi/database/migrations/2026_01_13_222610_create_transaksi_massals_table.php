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
        Schema::create('transaksi_massals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas');
            $table->timestamp('jam_transaksi');
            $table->time('jam_kembali');
            $table->text('catatan')->nullable();
            $table->boolean('dikembalikan')->default(false);
            $table->timestamps();
        });

        // Pivot table
        Schema::create('transaksi_massal_inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_massal_id')->constrained('transaksi_massals')->onDelete('cascade');
            $table->foreignId('inventory_id')->constrained('inventories')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_massals');
    }
};
