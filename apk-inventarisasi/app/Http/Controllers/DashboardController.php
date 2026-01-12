<?php

namespace App\Http\Controllers;

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

        return view('dashboard.index', compact('ruangans'));
    }
}
