<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $table = 'bahan';

    protected $fillable = [
        'kode_bahan',
        'nama_bahan',
        'kategori_id',
        'stok',
        'satuan',
        'lokasi',
        'deskripsi',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_id');
    }

    public function pemakaianBahan()
    {
        return $this->hasMany(PemakaianBahan::class);
    }

    public function keranjang()
    {
        return $this->hasMany(KeranjangPeminjaman::class);
    }
}
