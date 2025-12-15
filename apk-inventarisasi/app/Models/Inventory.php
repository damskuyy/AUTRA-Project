<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';

    protected $fillable = [
        'item_id',
        'ruangan_id',
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
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'inventory_id');
    }

    public function pemakaians()
    {
        return $this->hasMany(Pemakaian::class, 'inventory_id');
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'inventory_id');
    }

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