{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Automation Monitoring System</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-industry"></i>
            </div>
            <h2>Automation Monitoring</h2>
        </div>
        <nav class="sidebar-menu">
            <a href="dashboard.html" class="menu-item">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="control.html" class="menu-item">
                <i class="fas fa-sliders-h"></i>
                <span>Control</span>
            </a>
            <a href="laporan.html" class="menu-item active">
                <i class="fas fa-file-alt"></i>
                <span>Laporan</span>
            </a>
            <a href="notifikasi.html" class="menu-item">
                <i class="fas fa-bell"></i>
                <span>Notifikasi</span>
            </a>
            <a href="manage-user.html" class="menu-item">
                <i class="fas fa-users-cog"></i>
                <span>Manage User</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="navbar-left">
                <h1>Laporan Data Sensor</h1>
            </div>
            <div class="navbar-right">
                <div class="user-profile">
                    <div class="avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info">
                        <span class="user-name">Admin User</span>
                        <span class="user-role">Administrator</span>
                    </div>
                    <div class="dropdown">
                        <button class="dropdown-toggle">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-user-circle"></i> Profile
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <hr>
                            <a href="#" class="dropdown-item logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Report Content -->
        <div class="content">
            <div class="page-header">
                <h2>Data Sensor Historis</h2>
                <p>Riwayat pembacaan sensor dari PLC</p>
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <div class="filter-group">
                    <label><i class="fas fa-calendar"></i> Dari Tanggal</label>
                    <input type="date" class="form-control" value="2024-12-01">
                </div>
                <div class="filter-group">
                    <label><i class="fas fa-calendar"></i> Sampai Tanggal</label>
                    <input type="date" class="form-control" value="2024-12-18">
                </div>
                <div class="filter-group">
                    <label><i class="fas fa-filter"></i> Status</label>
                    <select class="form-control">
                        <option value="">Semua Status</option>
                        <option value="normal">Normal</option>
                        <option value="warning">Warning</option>
                        <option value="critical">Critical</option>
                    </select>
                </div>
                <div class="filter-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <button class="btn btn-success">
                        <i class="fas fa-download"></i> Export Excel
                    </button>
                </div>
            </div>

            <!-- Report Table -->
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>Suhu (°C)</th>
                            <th>Cahaya (Lux)</th>
                            <th>Kelembapan (%)</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>18 Dec 2024 14:30:25</td>
                            <td>28.5</td>
                            <td>450</td>
                            <td>65</td>
                            <td><span class="badge badge-success">Normal</span></td>
                            <td>
                                <button class="btn-action btn-view" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>18 Dec 2024 14:25:20</td>
                            <td>29.2</td>
                            <td>445</td>
                            <td>67</td>
                            <td><span class="badge badge-success">Normal</span></td>
                            <td>
                                <button class="btn-action btn-view" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>18 Dec 2024 14:20:15</td>
                            <td>31.8</td>
                            <td>420</td>
                            <td>70</td>
                            <td><span class="badge badge-warning">Warning</span></td>
                            <td>
                                <button class="btn-action btn-view" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>18 Dec 2024 14:15:10</td>
                            <td>27.3</td>
                            <td>460</td>
                            <td>62</td>
                            <td><span class="badge badge-success">Normal</span></td>
                            <td>
                                <button class="btn-action btn-view" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>18 Dec 2024 14:10:05</td>
                            <td>26.9</td>
                            <td>455</td>
                            <td>64</td>
                            <td><span class="badge badge-success">Normal</span></td>
                            <td>
                                <button class="btn-action btn-view" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>18 Dec 2024 14:05:00</td>
                            <td>35.2</td>
                            <td>380</td>
                            <td>75</td>
                            <td><span class="badge badge-danger">Critical</span></td>
                            <td>
                                <button class="btn-action btn-view" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>18 Dec 2024 14:00:55</td>
                            <td>28.1</td>
                            <td>440</td>
                            <td>66</td>
                            <td><span class="badge badge-success">Normal</span></td>
                            <td>
                                <button class="btn-action btn-view" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>18 Dec 2024 13:55:50</td>
                            <td>27.8</td>
                            <td>465</td>
                            <td>63</td>
                            <td><span class="badge badge-success">Normal</span></td>
                            <td>
                                <button class="btn-action btn-view" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>18 Dec 2024 13:50:45</td>
                            <td>30.5</td>
                            <td>410</td>
                            <td>68</td>
                            <td><span class="badge badge-warning">Warning</span></td>
                            <td>
                                <button class="btn-action btn-view" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>18 Dec 2024 13:45:40</td>
                            <td>28.7</td>
                            <td>448</td>
                            <td>65</td>
                            <td><span class="badge badge-success">Normal</span></td>
                            <td>
                                <button class="btn-action btn-view" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <button class="btn-page" disabled>
                    <i class="fas fa-chevron-left"></i> Previous
                </button>
                <div class="page-numbers">
                    <button class="btn-page active">1</button>
                    <button class="btn-page">2</button>
                    <button class="btn-page">3</button>
                    <button class="btn-page">4</button>
                    <button class="btn-page">5</button>
                </div>
                <button class="btn-page">
                    Next <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; 2024 Automation Monitoring System. All rights reserved.</p>
        </footer>
    </div>

    <script src="script.js"></script>
</body>
</html> --}}

@extends('layout.master')

@section('title', 'Laporan Data Sensor - Automation System')

@section('page-title', 'Laporan Data Sensor')
@section('page-subtitle', 'Riwayat pembacaan sensor PLC')

@section('content')
    <!-- Export Buttons -->
    <div class="export-section">
        <button class="btn-export btn-export-excel" id="exportExcel">
            <i class="fa-solid fa-file-excel"></i>
            <span>Export Excel</span>
        </button>
        <button class="btn-export btn-export-pdf" id="exportPdf">
            <i class="fa-solid fa-file-pdf"></i>
            <span>Export PDF</span>
        </button>
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
                <h3>Data Sensor (<span id="totalRecords">{{ $sensorData->total() }}</span> records)</h3>
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
                    @forelse($sensorData as $data)
                    <tr>
                        <td class="id-cell">#{{ $data->id }}</td>
                        <td>{{ $data->waktu }}</td>
                        <td class="temp-cell">{{ $data->suhu }}</td>
                        <td class="light-cell">{{ $data->cahaya }}</td>
                        <td class="humidity-cell">{{ $data->kelembapan }}</td>
                        <td>
                            <span class="status-badge badge-{{ strtolower($data->status) }}">
                                {{ $data->status }}
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
        @if($sensorData->hasPages())
        <div class="pagination-container">
            <div class="pagination-info">
                Menampilkan {{ $sensorData->firstItem() }} - {{ $sensorData->lastItem() }} dari {{ $sensorData->total() }} data
            </div>
            
            <div class="pagination-links">
                {{ $sensorData->links() }}
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