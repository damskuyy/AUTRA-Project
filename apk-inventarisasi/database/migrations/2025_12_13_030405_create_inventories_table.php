<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items');
            $table->foreignId('ruangan_id')->constrained('ruangans');
            $table->enum('status', ['TERSEDIA', 'DIPINJAM', 'RUSAK', 'HILANG', 'DIPERBAIKI'])->default('TERSEDIA');
            $table->enum('kondisi', ['BAIK', 'RUSAK_RINGAN', 'RUSAK_BERAT'])->default('BAIK');
            $table->string('nomor_inventaris')->nullable()->unique();
            $table->string('serial_number')->nullable();
            $table->integer('stok')->nullable()->default(0);
            $table->string('kode_qr_jurusan')->nullable()->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};