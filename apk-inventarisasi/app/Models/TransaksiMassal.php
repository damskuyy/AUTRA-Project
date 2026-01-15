<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiMassal extends Model
{
    protected $fillable = ['siswa_id','admin_id','jam_transaksi','jam_kembali','catatan','dikembalikan'];

    protected $casts = [
        'jam_transaksi' => 'datetime',
        'dikembalikan' => 'boolean',
    ];

    public function inventaris()
    {
        return $this->belongsToMany(Inventory::class, 'transaksi_massal_inventory', 'transaksi_massal_id', 'inventory_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

}