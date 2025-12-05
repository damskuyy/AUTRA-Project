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
            $table->foreignId('siswa_id')->constrained('siswa');
            $table->string('mapel');
            $table->foreignId('ruangan_id')->constrained('ruangans');
            $table->timestamp('waktu_pinjam');
            $table->timestamp('waktu_kembali_rencana')->nullable(); // Ubah jadi nullable
            $table->timestamp('waktu_kembali_real')->nullable();
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak', 'selesai'])->default('menunggu');
            $table->string('kode_verifikasi', 6)->nullable();
            $table->timestamp('expired_at')->nullable();
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
        Schema::dropIfExists('peminjamans');
    }
};
