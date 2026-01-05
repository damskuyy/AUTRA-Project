<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;
use App\Models\Siswa;
use Carbon\Carbon;


class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        $query = Siswa::query();

        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('kelas', 'like', '%' . $request->search . '%');
        }

        $siswas = $query
            ->orderBy('kelas')
            ->orderBy('nama')
            ->paginate(35)
            ->withQueryString();

        $kelasList = Siswa::select('kelas')
        ->distinct()
        ->orderBy('kelas')
        ->pluck('kelas');

        return view('siswa.index', compact('siswas', 'kelasList'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil diimport');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
        ]);

        Siswa::create([
            'nama'        => $request->nama,
            'kelas'       => $request->kelas,
            'total_poin'  => 0,
            'is_active'   => true,
            'is_banned'   => false,
            'banned_until'=> null,
            'alasan_ban'  => null,
        ]);

        return redirect()->back()->with('success', 'Siswa berhasil ditambahkan');
    }

    
    public function destroy(string $id)
    {
        Siswa::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Siswa berhasil dihapus');
    }

    public function ban(Request $request, Siswa $siswa)
    {
        $request->validate([
            'banned_until' => 'required|date|after:today',
            'alasan_ban'   => 'required|string',
        ]);

        $siswa->update([
            'is_banned'    => true,
            'banned_until' => $request->banned_until,
            'alasan_ban'   => $request->alasan_ban,
        ]);

        return back()->with('success', 'Siswa berhasil dibanned');
    }

    public function unban(Siswa $siswa)
    {
        // 🔥 reset poin HANYA kalau sudah >= 3
        if ($siswa->total_poin >= 3) {
            $siswa->total_poin = 0;
        }

        $siswa->is_banned = false;
        $siswa->banned_until = null;
        $siswa->alasan_ban = null;

        $siswa->save();

        return back()->with('success', 'Siswa berhasil di-unban');
    }




        
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
        ]);

        $siswa = Siswa::findOrFail($id);

        $siswa->update([
            'nama'  => $request->nama,
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    
}
