<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Validation\Rule;


class SiswaController extends Controller
{
    /**
     * LIST SISWA
     */
    public function index(Request $request)
    {
        $query = Siswa::where('is_active', true);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('kelas', 'like', '%' . $request->search . '%')
                  ->orWhere('nis', 'like', '%' . $request->search . '%');
            });
        }

        $siswas = $query
            ->orderBy('kelas')
            ->orderBy('nama')
            ->paginate(35)
            ->withQueryString();

        $kelasList = Siswa::where('is_active', true)
            ->select('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        return view('siswa.index', compact('siswas', 'kelasList'));
    }

    /**
     * ==============================
     * KENAIKAN KELAS MASSAL
     * ==============================
     */
    public function naikKelasMassal()
    {   
        DB::transaction(function () {

            $siswas = Siswa::where('is_active', true)->get();

            foreach ($siswas as $siswa) {

                $kelas = trim(strtoupper($siswa->kelas));

                // =====================
                // XII → LULUS
                // =====================
                if (preg_match('/^XII\b/', $kelas)) {
                    $siswa->update([
                        'is_active' => false,
                        'kelas' => 'LULUS',
                    ]);
                    continue;
                }

                // =====================
                // XI → XII
                // =====================
                if (preg_match('/^XI\b/', $kelas)) {
                    $siswa->update([
                        'kelas' => preg_replace('/^XI\b/', 'XII', $kelas),
                    ]);
                    continue;
                }

                // =====================
                // X → XI
                // =====================
                if (preg_match('/^X\b/', $kelas)) {
                    $siswa->update([
                        'kelas' => preg_replace('/^X\b/', 'XI', $kelas),
                    ]);
                }
            }
        });

        return back()->with(
            'success',
            'Kenaikan kelas berhasil. Siswa kelas XII telah diluluskan.'
        );
    }




    /**
     * IMPORT EXCEL
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil diimport');
    }

    /**
     * TAMBAH SISWA
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
        ]);

        Siswa::create([
            'nis'          => $request->nis,
            'nama'         => $request->nama,
            'kelas'        => $request->kelas,
            'is_active'    => true,
            'is_banned'    => false,
            'banned_until' => null,
            'alasan_ban'   => null,
        ]);

        return back()->with('success', 'Siswa berhasil ditambahkan');
    }

    /**
     * UPDATE SISWA
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'nis' => [
            'required',
            'string',
            'max:30',
            Rule::unique('siswas', 'nis')->ignore($id),
        ],
        'nama'  => 'required|string|max:255',
        'kelas' => 'required|string|max:100',
    ]);

    $siswa = Siswa::findOrFail($id);

    $siswa->update([
        'nis'   => $request->nis,
        'nama'  => $request->nama,
        'kelas' => $request->kelas,
    ]);

    return redirect()
        ->route('siswa.index')
        ->with('success', 'Data siswa berhasil diperbarui');
    }

    /**
     * HAPUS SISWA
     */
    public function destroy(string $id)
    {
        Siswa::findOrFail($id)->delete();

        return back()->with('success', 'Siswa berhasil dihapus');
    }

    /**
     * BAN MANUAL (DEFAULT 3 HARI)
     */
    public function ban(Siswa $siswa)
    {
        $siswa->update([
            'is_banned'    => true,
            'banned_until' => now()->addDays(3),
            'alasan_ban'   => 'Dibanned manual oleh admin',
        ]);

        return back()->with('success', 'Siswa berhasil dibanned selama 3 hari');
    }

    /**
     * UNBAN MANUAL
     */
    public function unban(Siswa $siswa)
    {
        DB::transaction(function () use ($siswa) {
            $siswa->update([
                'is_banned'    => false,
                'banned_until' => null,
                'alasan_ban'   => null,
                'total_poin'   => 0,
            ]);
        });

        return back()->with('success', 'Siswa berhasil di-unban');
    }
}