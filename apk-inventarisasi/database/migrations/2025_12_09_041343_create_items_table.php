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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique(); // Dari pusat (misal: ALT-0021, BHN-0013)
            $table->string('nama_barang'); // Dari pusat
            $table->text('spesifikasi')->nullable(); // Dari pusat
            $table->string('merk')->nullable(); // Dari pusat
            $table->enum('jenis', ['alat', 'bahan']); // Ditentukan oleh kode_barang atau logic
            $table->string('foto')->nullable(); // URL gambar dari pusat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
