<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiMassal extends Model
{
    protected $fillable = ['siswa','jam_transaksi','jam_kembali','catatan','dikembalikan'];

    public function inventaris()
    {
        return $this->belongsToMany(Inventory::class, 'transaksi_massal_inventory');
    }
}