<?php

namespace App\Http\Controllers;

use App\Models\SensorData;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SensorDataExport;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SensorData::query();
        
        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('waktu', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }
        
        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Filter by date range (optional)
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('waktu', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('waktu', '<=', $request->date_to);
        }
        
        // Order by latest
        $query->orderBy('waktu', 'desc');
        
        // Paginate results (10 per page)
        $sensorData = $query->paginate(10)->withQueryString();
        
        return view('laporan.index', compact('sensorData'));
    }

    /**
     * Export to Excel
     */
    public function exportExcel(Request $request)
    {
        $query = $this->applyFilters($request);
        $data = $query->get();
        
        $filename = 'laporan-sensor-' . Carbon::now()->format('Y-m-d') . '.xlsx';
        
        return Excel::download(new SensorDataExport($data), $filename);
    }

    /**
     * Export to PDF
     */
    public function exportPdf(Request $request)
    {
        $query = $this->applyFilters($request);
        $data = $query->get();
        
        $pdf = Pdf::loadView('laporan.pdf', [
            'data' => $data,
            'exportDate' => Carbon::now()->format('d M Y H:i:s')
        ]);
        
        // Set paper size to A4 portrait
        $pdf->setPaper('a4', 'portrait');
        
        // Optional: Set options for better rendering
        $pdf->setOptions([
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'isFontSubsettingEnabled' => true,
        ]);
        
        $filename = 'laporan-sensor-' . Carbon::now()->format('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Apply filters for export
     */
    private function applyFilters(Request $request)
    {
        $query = SensorData::query();
        
        // Apply same filters as index
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('waktu', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('waktu', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('waktu', '<=', $request->date_to);
        }
        
        $query->orderBy('waktu', 'desc');
        
        return $query;
    }

    /**
     * Store sensor data from PLC (API endpoint)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'suhu' => 'required|numeric',
            'cahaya' => 'required|integer',
            'kelembapan' => 'required|numeric',
        ]);

        // Determine status automatically
        $status = SensorData::determineStatus(
            $validated['suhu'],
            $validated['cahaya'],
            $validated['kelembapan']
        );

        $sensorData = SensorData::create([
            'waktu' => Carbon::now(),
            'suhu' => $validated['suhu'],
            'cahaya' => $validated['cahaya'],
            'kelembapan' => $validated['kelembapan'],
            'status' => $status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sensor data saved successfully',
            'data' => $sensorData
        ], 201);
    }

    /**
     * Get statistics
     */
    public function statistics()
    {
        $stats = [
            'total' => SensorData::count(),
            'normal' => SensorData::where('status', 'Normal')->count(),
            'warning' => SensorData::where('status', 'Warning')->count(),
            'danger' => SensorData::where('status', 'Danger')->count(),
            'today' => SensorData::today()->count(),
            'this_week' => SensorData::thisWeek()->count(),
            'this_month' => SensorData::thisMonth()->count(),
            'avg_suhu' => SensorData::avg('suhu'),
            'avg_cahaya' => SensorData::avg('cahaya'),
            'avg_kelembapan' => SensorData::avg('kelembapan'),
        ];

        return response()->json($stats);
    }

    /**
     * Delete old records (cleanup)
     */
    public function cleanup(Request $request)
    {
        $days = $request->input('days', 30); // Default 30 days
        
        $date = Carbon::now()->subDays($days);
        $deleted = SensorData::where('waktu', '<', $date)->delete();

        return response()->json([
            'success' => true,
            'message' => "Deleted {$deleted} records older than {$days} days"
        ]);
    }
}