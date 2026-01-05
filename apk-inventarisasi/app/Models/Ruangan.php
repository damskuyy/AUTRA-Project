<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangans';

    protected $fillable = [
        'kode_ruangan',
        'nama_ruangan',
    ];

    // Relasi
    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'ruangan_id');
    }

    public function pemakaians()
    {
        return $this->hasMany(Pemakaian::class, 'ruangan_id');
    }

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class, 'ruangan_id');
    }
}