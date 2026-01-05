<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RiwayatExport;
use App\Services\RiwayatService;

class ExportController extends Controller
{
    public function pdf(Request $request)
    {
        $data = RiwayatService::get($request);

        $pdf = Pdf::loadView('riwayat-aktivitas.export', $data)
            ->setPaper('A4', 'portrait');

        return $pdf->download('riwayat-aktivitas.pdf');
    }

    public function excel(Request $request)
    {
        return Excel::download(
            new RiwayatExport($request),
            'riwayat-aktivitas.xlsx'
        );
    }
}
