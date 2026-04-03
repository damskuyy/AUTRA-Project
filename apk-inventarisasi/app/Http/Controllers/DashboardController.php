<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::with(['barangMasuks' => function ($q) {
            $q->select(
                'ruangan_id',
                'nama_barang',
                DB::raw('SUM(jumlah) as total_stok')
            )->groupBy('ruangan_id', 'nama_barang');
        }])->get();

        $bahanTersedia = Inventory::with('barangMasuk')
            ->whereHas('barangMasuk', function ($q) {
                $q->where('jenis_barang', 'bahan');
            })
            ->get()
            ->groupBy(fn ($item) => $item->barangMasuk->nama_barang)
            ->map(function ($items, $nama) {
                return (object) [
                    'nama_barang' => $nama,
                    'total_stok' => $items->sum('stok'),
                ];
            })
            ->values();

        return view('dashboard.index', compact('ruangans', 'bahanTersedia'));
    }
}
