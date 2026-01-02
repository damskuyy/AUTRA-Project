<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    protected $table = 'inventories';

    protected $fillable = [
        'barang_masuk_id',
        'status',
        'kondisi',
        'nomor_inventaris',
        'serial_number',
        'stok',
        'kode_qr_jurusan',
    ];

    protected $casts = [
        'stok' => 'integer',
    ];

    // Relasi
    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'barang_masuk_id');
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'inventory_id');
    }

    public function pemakaians()
    {
        return $this->hasMany(PemakaianBahan::class, 'inventory_id');
    }

    // public function barangMasuk()
    // {
    //     return $this->hasMany(BarangMasuk::class, 'inventory_id');
    // }

    // Helper methods
    // public function isTersedia()
    // {
    //     return $this->status === 'TERSEDIA';
    // }

    // public function isAlat()
    // {
    //     return $this->item->jenis === 'alat';
    // }

    // public function isBahan()
    // {
    //     return $this->item->jenis === 'bahan';
    // }
}