<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'waktu',
        'aktivitas',
        'detail',
        'admin_id',
        'siswa_id',
        'subject_id',
        'subject_type',
    ];

    protected $casts = [
        'waktu' => 'datetime',
    ];

    // Relasi
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function subject()
    {
        return $this->morphTo();
    }
}