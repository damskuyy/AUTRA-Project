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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas');
            $table->foreignId('inventory_id')->constrained('inventories'); // Barang yang dipinjam
            $table->foreignId('user_id')->constrained('users'); // Teknisi yang memproses
            $table->timestamp('waktu_pinjam');
            $table->timestamp('waktu_kembali_aktual')->nullable();
            $table->enum('kondisi_pinjam', ['BAIK', 'RUSAK_RINGAN', 'RUSAK_BERAT']);
            $table->text('catatan_pinjam')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
