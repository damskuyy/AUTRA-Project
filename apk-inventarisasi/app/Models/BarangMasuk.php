<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';

    protected $fillable = [
        'inventory_id',
        'nama_barang',
        'jenis_barang',
        'jumlah',
        'satuan',
        'sumber',
        'nomor_dokumen',
        'tanggal_masuk',
        'catatan',
        'admin_id',
    ];

    protected $casts = [
        'tanggal_masuk' => 'datetime',
        'jumlah' => 'integer',
    ];

    // Relasi
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}