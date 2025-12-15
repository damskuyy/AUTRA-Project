<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'nama',
        'kelas',
        'total_poin',
        'is_active',
        'is_banned',
        'banned_until',
        'alasan_ban',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_banned' => 'boolean',
        'banned_until' => 'datetime',
        'total_poin' => 'integer',
    ];

    // Relasi
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'siswa_id');
    }

    public function pemakaians()
    {
        return $this->hasMany(Pemakaian::class, 'siswa_id');
    }

    public function pelanggarans()
    {
        return $this->hasMany(Pelanggaran::class, 'siswa_id');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class, 'siswa_id');
    }

    // Helper methods
    public function isBanned()
    {
        if (!$this->is_banned) {
            return false;
        }

        if ($this->banned_until && $this->banned_until->isPast()) {
            $this->update([
                'is_banned' => false,
                'banned_until' => null,
                'alasan_ban' => null,
            ]);
            return false;
        }

        return true;
    }
}
