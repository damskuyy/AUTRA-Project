<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuks';

    protected $fillable = [
        'nama_barang',
        'jenis_barang',
        'merk',
        'jumlah',
        'satuan',
        'sumber',
        'nomor_dokumen',
        'ruangan_id',
        'tanggal_masuk',
        'catatan',
        'admin_id',

        // SARPRAS
        'kode_unik',
        'foto',
        'spesifikasi',
        'from_sarpras'
    ];

    protected $casts = [
        'tanggal_masuk' => 'datetime',
        'jumlah' => 'integer',
    ];

    // Relasi
    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'barang_masuk_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}