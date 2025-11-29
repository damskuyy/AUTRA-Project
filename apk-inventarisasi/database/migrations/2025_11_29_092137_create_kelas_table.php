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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas');
            $table->integer('batas_pelanggaran')->default(3);
            $table->integer('total_pelanggaran')->default(0);
            $table->boolean('status_blokir')->default(false);
            $table->timestamp('tanggal_blokir_mulai')->nullable();
            $table->timestamp('tanggal_blokir_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
