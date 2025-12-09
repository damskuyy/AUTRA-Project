<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'spesifikasi',
        'merk',
        'jenis',
        'foto',
    ];

    protected $casts = [
        'jenis' => 'string',
    ];

    // Relasi
    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'item_id');
    }

    // Helper methods
    public function isAlat()
    {
        return $this->jenis === 'alat';
    }

    public function isBahan()
    {
        return $this->jenis === 'bahan';
    }
}