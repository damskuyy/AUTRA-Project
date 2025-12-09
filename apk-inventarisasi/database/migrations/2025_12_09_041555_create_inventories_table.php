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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items'); // Relasi ke data pusat
            $table->foreignId('ruangan_id')->constrained('ruangans'); // Ruangan di jurusan
            // Status spesifik di jurusan
            $table->enum('status', ['TERSEDIA', 'DIPINJAM', 'RUSAK', 'HILANG', 'DIPERBAIKI'])->default('TERSEDIA');
            $table->enum('kondisi', ['BAIK', 'RUSAK_RINGAN', 'RUSAK_BERAT'])->default('BAIK');
            // Hanya untuk alat (non-habis pakai)
            $table->string('nomor_inventaris')->nullable()->unique();
            $table->string('serial_number')->nullable();
            // Hanya untuk bahan (habis pakai)
            $table->integer('stok')->nullable()->default(0);
	        // Kode QR khusus inventaris jurusan (berbeda dari kode_barang pusat)
            $table->string('kode_qr_jurusan')->nullable()->unique();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
