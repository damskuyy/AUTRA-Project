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
        Schema::create('keranjang_peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa');
            $table->foreignId('alat_id')->nullable()->constrained('alats');
            $table->foreignId('bahan_id')->nullable()->constrained('bahans');
            $table->unsignedInteger('jumlah');
            $table->enum('tipe', ['alat', 'bahan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang_peminjamans');
    }
};
