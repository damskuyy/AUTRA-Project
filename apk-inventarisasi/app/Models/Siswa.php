<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'is_active',
        'is_banned',
        'banned_until',
        'alasan_ban',
        'total_poin',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_banned' => 'boolean',
        'banned_until' => 'datetime',
    ];

    /* =====================
       RELATIONS
    ===================== */
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function pelanggarans()
    {
        return $this->hasMany(Pelanggaran::class);
    }

    /* =====================
       HELPER
    ===================== */
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
