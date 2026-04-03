<?php

namespace App\Http\Controllers;

use App\Models\Inventory;

class NotificationController extends Controller
{
    public function index()
    {
        $lowStockNotifications = Inventory::with('barangMasuk')
            ->whereHas('barangMasuk', function ($query) {
                $query->where('jenis_barang', 'bahan');
            })
            ->where('stok', '<=', 10)
            ->get()
            ->groupBy(fn ($item) => $item->barangMasuk->nama_barang)
            ->map(function ($items, $nama) {
                return (object) [
                    'nama_barang' => $nama,
                    'total_stok' => $items->sum('stok'),
                    'satuan' => $items->first()->barangMasuk->satuan ?? 'pcs',
                ];
            })
            ->values();

        $title = 'Notifikasi Stok';
        $breadcrumb = 'Notifikasi Stok';

        return view('notifications.index', compact('lowStockNotifications', 'title', 'breadcrumb'));
    }
}
