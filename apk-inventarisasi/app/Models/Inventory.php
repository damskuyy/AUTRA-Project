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
        'stok',
        'penempatan_rak',
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

    public function getPenempatanRakLabelAttribute()
    {
        return match ($this->penempatan_rak) {
            'PT'  => 'Power Tools',
            'HT'  => 'Hand Tools',
            'RK'  => 'Rak Komponen',
            'RBK' => 'Rak Bahan Kecil',
            'RBB' => 'Rak Bahan Besar',
            'UK'  => 'Rak Alat Ukur',
            'PPE' => 'Rak PPE',
            default => '-',
        };
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

    // Accessor untuk status berdasarkan kondisi
    public function getStatusAttribute($value)
    {
        // Jika status sudah DIPERBAIKI, tetap DIPERBAIKI (manual admin)
        if ($value === 'DIPERBAIKI') {
            return 'DIPERBAIKI';
        }

        // Jika DIPINJAM, tetap DIPINJAM
        if ($value === 'DIPINJAM') {
            return 'DIPINJAM';
        }

        // Berdasarkan kondisi
        return match ($this->kondisi) {
            'BAIK' => 'TERSEDIA',
            'RUSAK_RINGAN', 'RUSAK_BERAT' => 'RUSAK',
            'HILANG' => 'HILANG',
            default => $value, // fallback
        };
    }
}