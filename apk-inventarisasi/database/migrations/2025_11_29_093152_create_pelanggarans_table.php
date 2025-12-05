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
        Schema::create('pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa');
            $table->foreignId('peminjaman_id')->nullable()->constrained('peminjamans');
            $table->enum('jenis_pelanggaran', ['keterlambatan', 'kerusakan', 'kehilangan']);
            $table->timestamp('tanggal_pelanggaran');
            $table->enum('status', ['aktif', 'selesai'])->default('aktif');
            $table->text('deskripsi');
            $table->text('sanksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggarans');
    }
};
