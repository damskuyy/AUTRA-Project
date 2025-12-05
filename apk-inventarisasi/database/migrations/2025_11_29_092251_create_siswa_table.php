<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');  // Hapus references di sini
            $table->string('ketua_kelas')->nullable();
            $table->string('nis')->unique();
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->enum('status', ['aktif', 'banned'])->default('aktif');
            $table->timestamp('tanggal_blokir')->nullable();
            $table->timestamp('tanggal_aktif_kembali')->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto_profil')->nullable();
            $table->timestamps();
        });

        // Tambahkan foreign key secara manual tanpa prefix
        DB::statement('ALTER TABLE inv_siswa ADD CONSTRAINT inv_siswa_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE inv_siswa DROP FOREIGN KEY inv_siswa_user_id_foreign');
        Schema::dropIfExists('siswa');
    }
};
