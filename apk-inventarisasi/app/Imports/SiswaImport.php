<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class SiswaImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (!isset($row['nama']) || !isset($row['kelas'])) {
                continue;
            }

            Siswa::updateOrCreate(
                [
                    'nis'  => $row['nis'],
                    'nama' => trim($row['nama']),
                    'kelas' => trim($row['kelas']),
                ],
                [
                    'is_active' => true,
                    'is_banned' => false,
                    'total_poin' => 0,
                ]
            );
        }
    }
}

