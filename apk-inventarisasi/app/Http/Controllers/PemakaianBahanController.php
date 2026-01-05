<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\PemakaianBahan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PemakaianBahanController extends Controller
{
    public function index()
    {
    $pemakaians = PemakaianBahan::with('inventory.barangMasuk')
        ->whereDate('created_at', Carbon::today())
        ->latest()
        ->get();

        return view('pemakaian-bahan.index', compact('pemakaians'));
    }

    public function form(Inventory $inventory)
    {
        // 🔥 AMBIL JENIS DARI BARANG MASUK
        if (
            !$inventory->barangMasuk ||
            $inventory->barangMasuk->jenis_barang !== 'bahan'
        ) {
            abort(404);
        }

        // 🔥 AMBIL DATA SISWA
        $siswas = Siswa::where('is_active', true)
            ->where('is_banned', false)
            ->orderBy('nama')
            ->get();

        // ⚠️ SESUAI STRUKTUR FOLDER KAMU
        return view(
            'form.pemakaian-bahan-form',
            compact('inventory', 'siswas')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'siswa_id'   => 'required|exists:siswas,id',
            'jumlah'       => 'required|integer|min:1',
        ]);

        $inventory = Inventory::findOrFail($request->inventory_id);

        if ($request->jumlah > $inventory->stok) {
            return back()->withErrors(['jumlah' => 'Stok tidak mencukupi']);
        }

        DB::transaction(function () use ($request, $inventory) {
            PemakaianBahan::create([
                'inventory_id' => $inventory->id,
                'ruangan_id'   => $inventory->barangMasuk->ruangan_id,
                'siswa_id'      => $request->siswa_id,
                'admin_id'     => auth()->id(),
                'jumlah'       => $request->jumlah,
            ]);

            $inventory->decrement('stok', $request->jumlah);
        });

        return redirect()
            ->route('pemakaian-bahan.index')
            ->with('success', 'Pemakaian bahan berhasil dicatat');
    }
}
