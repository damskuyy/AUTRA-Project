@extends ('be.layout')
@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')

{{-- ==================== STYLE ==================== --}}
<style>
    body {
        background: #f5f6fa;
    }

    .page-title {
        font-size: 24px;
        font-weight: 800;
        color: #2c3e50;
    }

    .filter-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #e3e3e3;
        box-shadow: 0 3px 8px rgba(0,0,0,0.04);
    }

    .filter-card label {
        font-weight: 600;
        font-size: 14px;
        color: #374151;
    }

    .table-wrapper {
        background: #ffffff;
        padding: 22px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 3px 8px rgba(0,0,0,0.05);
    }

    .export-btn {
        font-size: 14px;
        font-weight: 600;
        border-radius: 8px;
        padding: 7px 14px;
    }

    .badge-status {
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 6px;
    }

    .badge-success {
        background: #e8fdf2;
        color: #0b6b43;
    }

    .badge-warning {
        background: #fff7d6;
        color: #9a7110;
    }

    .badge-danger {
        background: #ffe4e4;
        color: #b21a1a;
    }

    table thead {
        background: #f8fafc;
        font-size: 14px;
    }

    .dt-search {
        float: left !important;
        margin-bottom: 10px;
    }
</style>


{{-- ==================== PAGE TITLE ==================== --}}
<div class="page-title mb-3">📢 Notifikasi & Rekap Laporan Inventaris</div>


{{-- ==================== FILTER CARD ==================== --}}
<div class="filter-card mb-4">
    <form>
        <div class="row g-3">

            <div class="col-md-3">
                <label class="form-label">Tanggal</label>
                <input type="date" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Kelas</label>
                <select class="form-select">
                    <option value="">Semua</option>
                    <option>X-RPL</option>
                    <option>XI-TKJ</option>
                    <option>XII-MM</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Jenis Barang</label>
                <select class="form-select">
                    <option value="">Semua</option>
                    <option>Alat</option>
                    <option>Bahan</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select class="form-select">
                    <option value="">Semua</option>
                    <option>Dipinjam</option>
                    <option>Dikembalikan</option>
                    <option>Ditolak</option>
                </select>
            </div>

            <div class="col-12 text-end">
                <button class="btn btn-primary export-btn">Filter</button>
            </div>

        </div>
    </form>
</div>


{{-- ==================== EXPORT BUTTONS ==================== --}}
<div class="mb-3 text-end">
    <a href="#" class="btn btn-success export-btn">📄 Export Excel</a>
    <a href="#" class="btn btn-danger export-btn">📕 Export PDF</a>
</div>


{{-- ==================== DATATABLE ==================== --}}
<div class="table-wrapper">
    <table id="laporanTable" class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>Waktu</th>
        </tr>
        </thead>

        <tbody>

        {{-- Dummy Data --}}
        <tr>
            <td>1</td>
            <td>Peminjaman Alat</td>
            <td>Budi Santoso</td>
            <td>XII RPL</td>
            <td>Meminjam Mikrometer</td>
            <td><span class="badge-status badge-success">Disetujui</span></td>
            <td>2025-11-17 08:22</td>
        </tr>

        <tr>
            <td>2</td>
            <td>Pemakaian Bahan</td>
            <td>Salsa</td>
            <td>XI TKJ</td>
            <td>Menggunakan Kabel UTP 5m</td>
            <td><span class="badge-status badge-warning">Menunggu</span></td>
            <td>2025-11-17 09:10</td>
        </tr>

        <tr>
            <td>3</td>
            <td>Pelanggaran</td>
            <td>Andi Pratama</td>
            <td>X RPL</td>
            <td>Terlambat mengembalikan alat</td>
            <td><span class="badge-status badge-danger">Sanksi</span></td>
            <td>2025-11-16 15:40</td>
        </tr>

        </tbody>
    </table>
</div>

@endsection



{{-- ==================== SCRIPT ==================== --}}
@section('scripts')

{{-- Datatable CDN --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script>
    $(document).ready(function () {
        $('#laporanTable').DataTable({
            pageLength: 10,
            ordering: true,
            responsive: true,
            language: {
                search: "🔍 Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data"
            },
            initComplete: function () {
                // Pindahkan search ke kiri
                $('.dataTables_filter').addClass('dt-search');
            }
        });
    });
</script>

@endsection

@section('footer')
    @include('be.footer')
@endsection