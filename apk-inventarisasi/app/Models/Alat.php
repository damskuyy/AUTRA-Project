<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alat';

    protected $fillable = [
        'kode_alat',
        'nama_alat',
        'kategori_id',
        'jumlah_total',
        'jumlah_tersedia',
        'kondisi',
        'lokasi',
        'deskripsi',
        'barcode_path',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_id');
    }

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    public function keranjang()
    {
        return $this->hasMany(KeranjangPeminjaman::class);
    }
}
