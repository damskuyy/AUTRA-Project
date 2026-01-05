<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Ruangan;

class DashboardController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::all();

        return view('dashboard.index', compact('ruangans'));
    }
}
