<?php

namespace App\Http\Controllers;

use App\Models\SensorReading;
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
        // Only use summary rows from SensorReading
        $query = SensorReading::where('is_summary', true);
        
        // Search functionality (search waktu or condition)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('received_at', 'like', "%{$search}%")
                  ->orWhere('condition', 'like', "%{$search}%");
            });
        }
        
        // Filter by condition (Normal/Warning/Danger)
        if ($request->has('status') && $request->status != '') {
            $query->where('condition', $request->status);
        }
        
        // Filter by date range (optional)
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('received_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('received_at', '<=', $request->date_to);
        }
        
        // Order by latest
        $query->orderBy('received_at', 'desc');
        
        // Paginate results (10 per page)
        $reports = $query->paginate(10)->withQueryString();
        
        // last generated report
        $lastReport = \App\Models\SensorReading::where('is_summary', true)->latest('received_at')->first();

        return view('laporan.index', compact('reports', 'lastReport'));
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
        $query = SensorReading::where('is_summary', true);
        
        // Apply same filters as index
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('received_at', 'like', "%{$search}%")
                  ->orWhere('condition', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('status') && $request->status != '') {
            $query->where('condition', $request->status);
        }
        
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('received_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('received_at', '<=', $request->date_to);
        }
        
        $query->orderBy('received_at', 'desc');
        
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

        // Map to sensor_readings fields: sensor1=kelembapan, sensor2=suhu, sensor3=cahaya
        $condition = SensorReading::determineCondition(
            $validated['suhu'],
            $validated['cahaya'],
            $validated['kelembapan']
        );

        $reading = SensorReading::create([
            'sensor1' => $validated['kelembapan'],
            'sensor2' => $validated['suhu'],
            'sensor3' => $validated['cahaya'],
            'status' => 'ONLINE',
            'received_at' => Carbon::now(),
            'is_summary' => false,
            'condition' => $condition,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sensor reading saved successfully',
            'data' => $reading
        ], 201);
    }

    /**
     * Get statistics
     */
    public function statistics()
    {
        $stats = [
            'total' => SensorReading::where('is_summary', true)->count(),
            'normal' => SensorReading::where('condition', 'Normal')->count(),
            'warning' => SensorReading::where('condition', 'Warning')->count(),
            'danger' => SensorReading::where('condition', 'Danger')->count(),
            'today' => SensorReading::whereDate('received_at', Carbon::today())->count(),
            'this_week' => SensorReading::whereBetween('received_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count(),
            'this_month' => SensorReading::whereMonth('received_at', Carbon::now()->month)->whereYear('received_at', Carbon::now()->year)->count(),
            'avg_suhu' => SensorReading::where('is_summary', true)->avg('sensor2'),
            'avg_cahaya' => SensorReading::where('is_summary', true)->avg('sensor3'),
            'avg_kelembapan' => SensorReading::where('is_summary', true)->avg('sensor1'),
        ];

        return response()->json($stats);
    }

    /**
     * Manually trigger report generation (for UI button)
     */
    public function generateNow(Request $request)
    {
        $report = SensorReading::generateHourlySummary();

        if (! $report) {
            return back()->with('error', 'Tidak ada laporan dibuat: PLC mungkin offline atau tidak ada data pada periode terakhir.');
        }

        // Create notification if Danger
        try {
            if (class_exists(\App\Models\Notification::class) && ($report->condition ?? null) === 'Danger') {
                \App\Models\Notification::create([
                    'title' => 'Danger detected in manual summary',
                    'message' => 'A manual hourly summary was generated with condition Danger. Please review the Laporan page.',
                    'type' => 'danger',
                    'is_read' => false,
                ]);
            }
        } catch (\Exception $e) {
            // ignore
        }

        return back()->with('success', 'Laporan berhasil dibuat pada ' . $report->received_at->format('d M Y H:i:s'));
    }

    /**
     * Delete old records (cleanup)
     */
    public function cleanup(Request $request)
    {
        $days = $request->input('days', 30); // Default 30 days
        
        $date = Carbon::now()->subDays($days);
        $deleted = SensorReading::where('waktu', '<', $date)->delete();

        return response()->json([
            'success' => true,
            'message' => "Deleted {$deleted} records older than {$days} days"
        ]);
    }
}