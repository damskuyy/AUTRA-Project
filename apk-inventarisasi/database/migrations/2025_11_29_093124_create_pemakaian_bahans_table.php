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
            $table->foreignId('siswa_id')->constrained('siswas');
            $table->foreignId('inventory_id')->constrained('inventories'); // Bahan yang dipakai
            $table->foreignId('admin_id')->constrained('users'); // Teknisi yang memproses
            $table->integer('jumlah');
            $table->timestamp('waktu_pakai');
            $table->foreignId('ruangan_id')->constrained('ruangans');
            $table->text('catatan')->nullable();
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
