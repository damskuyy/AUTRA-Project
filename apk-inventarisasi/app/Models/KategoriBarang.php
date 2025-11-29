<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    protected $table = 'kategori_barang';

    protected $fillable = ['nama_kategori', 'jenis'];

    public function alat()
    {
        return $this->hasMany(Alat::class, 'kategori_id');
    }

    public function bahan()
    {
        return $this->hasMany(Bahan::class, 'kategori_id');
    }
}
