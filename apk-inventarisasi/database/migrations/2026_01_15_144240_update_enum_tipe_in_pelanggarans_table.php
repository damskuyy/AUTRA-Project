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
        // Update enum tipe untuk menambah 'TRANSAKSI_MASSAL'
        DB::statement("ALTER TABLE inv_pelanggarans MODIFY COLUMN tipe ENUM('TELAT_KEMBALI', 'KERUSAKAN', 'HILANG', 'TRANSAKSI_MASSAL')");
    }

    public function down(): void
    {
        // Kembalikan ke enum lama
        DB::statement("ALTER TABLE inv_pelanggarans MODIFY COLUMN tipe ENUM('TELAT_KEMBALI', 'KERUSAKAN', 'HILANG')");
    }
};
