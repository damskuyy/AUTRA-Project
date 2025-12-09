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
        
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->timestamp('waktu');
            $table->string('aktivitas');
            $table->text('detail');
            $table->foreignId('admin_id')->constrained('users'); // Admin yang melakukan aksi
            $table->foreignId('siswa_id')->nullable()->constrained('siswas');
            $table->morphs('subject'); // Polymorphic relation untuk terhubung ke berbagai tabel (transactions, material_usages, dll)
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
