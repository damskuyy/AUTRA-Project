<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemakaianBahan extends Model
{
    use HasFactory;

    protected $table = 'pemakaians';

    protected $fillable = [
        'siswa_id',
        'inventory_id',
        'admin_id',
        'jumlah',
        'waktu_pakai',
        'ruangan_id',
        'catatan',
    ];

    protected $casts = [
        'waktu_pakai' => 'datetime',
        'jumlah' => 'integer',
    ];

    // Relasi
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function activityLogs()
    {
        return $this->morphMany(ActivityLog::class, 'subject');
    }
}