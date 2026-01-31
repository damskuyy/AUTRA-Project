@extends('layout.master')
@section('sidebar')
    @include('layout.sidebar')
@endsection
@section('navbar')
    @include('layout.navbar')
@endsection

@section('title', 'Laporan Data Sensor - Automation System')

@section('page-title', 'Laporan Data Sensor')
@section('page-subtitle', 'Riwayat pembacaan sensor PLC')

@section('content')
    <!-- Flash messages -->
    @if(session('success'))
        <div class="notification notification-success" style="margin-bottom:16px">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="notification notification-error" style="margin-bottom:16px">{{ session('error') }}</div>
    @endif

    <!-- Export Buttons & Generate -->
    <div class="export-section">
        <style>
        /* Local Laporan styles: match export buttons and a nicer empty state */
        .btn-export-generate {
            background: #ffffff;
            color: #0f1724;
            border-radius: 10px;
            padding: 10px 18px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 6px 12px rgba(2,6,23,0.12);
            border: none;
            transition: transform .12s ease, box-shadow .12s ease, background .12s ease;
        }
        .btn-export-generate i { color: #0f1724; }
        .btn-export-generate:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(2,6,23,0.18);
            background: #f8fafc;
        }

        .no-report {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(90deg, rgba(59,130,246,0.06), rgba(99,102,241,0.03));
            padding: 8px 12px;
            border-radius: 10px;
            color: #cbd5e1;
            min-width: 240px;
        }
        .no-report-icon {
            font-size: 20px;
            color: #64748b;
            background: rgba(15,23,36,0.06);
            padding: 8px;
            border-radius: 8px;
        }
        .no-report-title { font-weight: 600; color: #e2e8f0; }
        .no-report-sub { font-size: 12px; color: #94a3b8; }
        @media (max-width: 480px) {
            .no-report { min-width: 160px; gap: 8px; padding: 6px 8px; }
            .btn-export-generate { padding:8px 12px; }
        }
        </style>

        <div style="display:flex; gap:12px; align-items:center;">
            <button class="btn-export btn-export-excel" id="exportExcel">
                <i class="fa-solid fa-file-excel"></i>
                <span>Export Excel</span>
            </button>
            <button class="btn-export btn-export-pdf" id="exportPdf">
                <i class="fa-solid fa-file-pdf"></i>
                <span>Export PDF</span>
            </button>

            <form method="POST" action="{{ route('laporan.generate') }}" style="display:inline">
                @csrf
                <button class="btn-export btn-export-generate" type="submit" id="btnGenerate">
                    <i class="fa-solid fa-clock"></i>
                    <span>Generate Now</span>
                </button>
            </form>
        </div>

        <div style="margin-left:auto; text-align:right;">
            @if(isset($lastReport) && $lastReport)
                <div class="small-note">Last report: <strong>{{ $lastReport->waktu->format('d M Y H:i:s') }}</strong></div>
            @else
                <div class="no-report" role="status" aria-live="polite" title="No report generated yet">
                    <i class="fa-solid fa-file-circle-xmark no-report-icon" aria-hidden="true"></i>
                    <div class="no-report-text">
                        <div class="no-report-title">Tidak ada laporan yang digenerate</div>
                        <div class="no-report-sub">Tekan <strong>Generate Now</strong> untuk membuat laporan pertama.</div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="filter-section">
        <div class="search-container">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input 
                type="text" 
                id="searchInput" 
                class="search-input" 
                placeholder="Cari berdasarkan waktu atau status..."
                value="{{ request('search') }}"
            >
        </div>

        <div class="filter-container">
            <i class="fa-solid fa-filter filter-icon"></i>
            <select id="statusFilter" class="status-filter">
                <option value="">Semua Status</option>
                <option value="Normal" {{ request('status') == 'Normal' ? 'selected' : '' }}>Normal</option>
                <option value="Warning" {{ request('status') == 'Warning' ? 'selected' : '' }}>Warning</option>
                <option value="Danger" {{ request('status') == 'Danger' ? 'selected' : '' }}>Danger</option>
            </select>
        </div>
    </div>

    <!-- Data Table Section -->
    <div class="table-section">
        <div class="table-header">
            <div class="table-title">
                <i class="fa-solid fa-table"></i>
                <h3>Data Sensor (<span id="totalRecords">{{ $reports->total() }}</span> records)</h3>
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Waktu</th>
                        <th>Suhu (°C)</th>
                        <th>Cahaya (Lux)</th>
                        <th>Kelembapan (%)</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse($reports as $data)
                    <tr>
                        <td class="id-cell">#{{ $data->id }}</td>
                        <td>{{ $data->waktu ?? $data->received_at }}</td>
                        <td class="temp-cell">{{ $data->suhu }}</td>
                        <td class="light-cell">{{ $data->cahaya }}</td>
                        <td class="humidity-cell">{{ $data->kelembapan }}</td>
                        <td>
                            <span class="status-badge badge-{{ strtolower($data->condition ?? ($data->status ?? 'Unknown')) }}">
                                {{ $data->condition ?? ($data->status ?? 'Unknown') }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class="fa-solid fa-inbox"></i>
                            <p>Tidak ada data yang ditemukan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($reports->hasPages())
        <div class="pagination-container">
            <div class="pagination-info">
                Menampilkan {{ $reports->firstItem() }} - {{ $reports->lastItem() }} dari {{ $reports->total() }} data
            </div>
            
            <div class="pagination-links">
                {{ $reports->links() }}
            </div>
        </div>
        @endif
    </div>
@endsection

{{-- @push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
// Search functionality
let searchTimeout;
const searchInput = document.getElementById('searchInput');
const statusFilter = document.getElementById('statusFilter');

if (searchInput) {
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            applyFilters();
        }, 500);
    });
}

if (statusFilter) {
    statusFilter.addEventListener('change', function() {
        applyFilters();
    });
}

function applyFilters() {
    const search = searchInput.value;
    const status = statusFilter.value;
    
    const url = new URL(window.location.href);
    
    if (search) {
        url.searchParams.set('search', search);
    } else {
        url.searchParams.delete('search');
    }
    
    if (status) {
        url.searchParams.set('status', status);
    } else {
        url.searchParams.delete('status');
    }
    
    url.searchParams.delete('page');
    
    window.location.href = url.toString();
}

// Export Excel
const exportExcelBtn = document.getElementById('exportExcel');
if (exportExcelBtn) {
    exportExcelBtn.addEventListener('click', function() {
        const table = document.querySelector('.data-table');
        if (!table) return;
        
        // Prepare data
        const wb = XLSX.utils.book_new();
        const wsData = [];
        
        // Headers
        const headers = [];
        table.querySelectorAll('thead th').forEach(th => {
            headers.push(th.textContent.trim());
        });
        wsData.push(headers);
        
        // Body data
        table.querySelectorAll('tbody tr').forEach(tr => {
            if (tr.querySelector('.empty-state')) return;
            
            const row = [];
            tr.querySelectorAll('td').forEach(td => {
                let text = td.textContent.trim();
                if (td.querySelector('.status-badge')) {
                    text = td.querySelector('.status-badge').textContent.trim();
                }
                row.push(text);
            });
            
            if (row.length > 0) {
                wsData.push(row);
            }
        });
        
        // Create worksheet
        const ws = XLSX.utils.aoa_to_sheet(wsData);
        
        // Set column widths
        ws['!cols'] = [
            { wch: 8 },  // ID
            { wch: 20 }, // Waktu
            { wch: 12 }, // Suhu
            { wch: 15 }, // Cahaya
            { wch: 16 }, // Kelembapan
            { wch: 12 }  // Status
        ];
        
        // Add worksheet to workbook
        XLSX.utils.book_append_sheet(wb, ws, 'Sensor Data');
        
        // Generate filename with date
        const date = new Date().toISOString().slice(0, 10);
        const filename = `laporan-sensor-${date}.xlsx`;
        
        // Download
        XLSX.writeFile(wb, filename);
        
        showNotification('Data berhasil diexport ke Excel!', 'success');
    });
}

// Export PDF
const exportPdfBtn = document.getElementById('exportPdf');
if (exportPdfBtn) {
    exportPdfBtn.addEventListener('click', function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        
        // Title
        doc.setFontSize(16);
        doc.text('Laporan Data Sensor PLC', 14, 15);
        
        doc.setFontSize(10);
        doc.text('Automation Monitoring System', 14, 22);
        doc.text('Tanggal Export: ' + new Date().toLocaleDateString('id-ID'), 14, 28);
        
        // Table
        const table = document.querySelector('.data-table');
        const rows = [];
        
        // Get headers
        const headers = [];
        table.querySelectorAll('thead th').forEach(th => {
            headers.push(th.textContent.trim());
        });
        
        // Get data
        table.querySelectorAll('tbody tr').forEach(tr => {
            if (tr.querySelector('.empty-state')) return;
            
            const cells = [];
            tr.querySelectorAll('td').forEach(td => {
                let text = td.textContent.trim();
                if (td.querySelector('.status-badge')) {
                    text = td.querySelector('.status-badge').textContent.trim();
                }
                cells.push(text);
            });
            
            if (cells.length > 0) {
                rows.push(cells);
            }
        });
        
        doc.autoTable({
            head: [headers],
            body: rows,
            startY: 35,
            theme: 'grid',
            styles: {
                fontSize: 9,
                cellPadding: 3
            },
            headStyles: {
                fillColor: [249, 115, 22],
                textColor: 255,
                fontStyle: 'bold'
            },
            alternateRowStyles: {
                fillColor: [245, 247, 250]
            }
        });
        
        const date = new Date().toISOString().slice(0, 10);
        doc.save(`laporan-sensor-${date}.pdf`);
        
        showNotification('Data berhasil diexport ke PDF!', 'success');
    });
}
</script>
@endpush --}}