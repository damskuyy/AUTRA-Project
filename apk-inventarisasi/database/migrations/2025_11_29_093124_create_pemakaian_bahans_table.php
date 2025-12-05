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
        Schema::create('pemakaian_bahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa');
            $table->foreignId('peminjaman_id')->nullable()->constrained('peminjamans');
            $table->foreignId('bahan_id')->constrained('bahans');
            $table->unsignedInteger('jumlah_digunakan');
            $table->string('mapel');
            $table->foreignId('ruangan_id')->constrained('ruangans');
            $table->date('tanggal_pakai');
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak', 'selesai'])->default('menunggu');
            $table->text('alasan_penolakan')->nullable();
            $table->enum('tipe', ['single', 'multi'])->default('single');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemakaian_bahans');
    }
};
