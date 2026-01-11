<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Inventory;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();
        $ruangans = Ruangan::all();

        $riwayatNamaBahan = BarangMasuk::where('jenis_barang', 'bahan')
            ->pluck('nama_barang')->unique();

        $riwayatNamaAlat = BarangMasuk::where('jenis_barang', 'alat')
            ->pluck('nama_barang')->unique();

        $riwayatSeriAlat = BarangMasuk::where('jenis_barang', 'alat')
            ->pluck('nomor_dokumen')->unique();

        return view('barang-masuk.index', compact(
            'inventories',
            'ruangans',
            'riwayatNamaBahan',
            'riwayatNamaAlat',
            'riwayatSeriAlat'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang'     => 'required|string',
            'jenis_barang'    => 'required|in:alat,bahan',
            'merk'            => 'nullable|string',
            'jumlah'          => 'required|integer|min:1',
            'satuan'          => 'nullable|string',
            'sumber'          => 'required|string',
            'sumber_manual'   => 'nullable|string',
            'nomor_dokumen'   => 'nullable|string',
            'ruangan_id'      => 'required|exists:ruangans,id',
            'tanggal_masuk'   => 'required|date',
            'catatan'         => 'nullable|string',
        ]);

        // handle input manual
        if ($request->nama_barang === '__new') {
            $validated['nama_barang'] = $request->nama_barang_new;
        }

        if ($request->nomor_dokumen === '__new') {
            $validated['nomor_dokumen'] = $request->nomor_dokumen_new;
        }

        if ($request->sumber === '__manual') {
            $validated['sumber'] = $request->sumber_manual;
        }

        $validated['admin_id'] = Auth::id();

        DB::transaction(function () use ($validated) {

            // 1️⃣ simpan histori barang masuk
            $barangMasuk = BarangMasuk::create($validated);

            /*
            |--------------------------------------------------------------------------
            | BAHAN (stok akumulatif)
            |--------------------------------------------------------------------------
            */
            if ($validated['jenis_barang'] === 'bahan') {

                $inventory = Inventory::whereHas('barangMasuk', function ($q) use ($validated) {
                    $q->where('nama_barang', $validated['nama_barang'])
                      ->where('jenis_barang', 'bahan')
                      ->where('ruangan_id', $validated['ruangan_id']);
                })->first();

                if ($inventory) {
                    $inventory->increment('stok', $validated['jumlah']);
                } else {
                    Inventory::create([
                        'barang_masuk_id' => $barangMasuk->id,
                        'stok'            => $validated['jumlah'],
                        'status'          => 'TERSEDIA',
                        'kondisi'         => 'BAIK',
                    ]);
                }

            /*
            |--------------------------------------------------------------------------
            | ALAT (per unit / pcs)
            |--------------------------------------------------------------------------
            */
            } else {

                // jumlah alat = jumlah inventory (1 alat = 1 inventory)
                for ($i = 1; $i <= $validated['jumlah']; $i++) {
                    Inventory::create([
                        'barang_masuk_id' => $barangMasuk->id,
                        'stok'            => 1, // biar konsisten & bisa dihitung
                        'status'          => 'TERSEDIA',
                        'kondisi'         => 'BAIK',
                    ]);
                }
            }
        });

        return back()->with('success', 'Barang masuk berhasil & otomatis masuk ke inventaris.');
    }
}
