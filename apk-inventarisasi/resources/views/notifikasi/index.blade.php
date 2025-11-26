@extends ('be.layout')
@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')

<div class="container-fluid">

    {{-- PAGE TITLE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">📢 Notifikasi & Rekap Laporan Inventaris</h4>
            <small class="text-muted">Lihat aktivitas peminjaman, penggunaan bahan, dan catatan pelanggaran.</small>
        </div>
        <div>
            <!-- tempat tombol export default (DataTables akan inject) -->
            <div id="table-buttons" class="d-inline-block"></div>
        </div>
    </div>

    {{-- FILTER CARD --}}
    <div class="card mb-3">
        <div class="card-body">
            <form id="filterForm">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Kelas</label>
                        <select class="form-select" name="kelas">
                            <option value="">Semua</option>
                            <option>X-RPL</option>
                            <option>XI-TKJ</option>
                            <option>XII-MM</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Jenis Barang</label>
                        <select class="form-select" name="jenis">
                            <option value="">Semua</option>
                            <option>Alat</option>
                            <option>Bahan</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="">Semua</option>
                            <option>Dipinjam</option>
                            <option>Dikembalikan</option>
                            <option>Ditolak</option>
                        </select>
                    </div>

                    <div class="col-12 text-end">
                        <button type="button" id="applyFilter" class="btn btn-primary px-4">Filter</button>
                        <button type="button" id="resetFilter" class="btn btn-outline-secondary ms-2">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- DATATABLE --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="laporanTable" class="table table-hover table-custom align-middle mb-0" style="width:100%">
                    <thead>
                        <tr class="text-muted small">
                            <th style="width:60px;">No</th>
                            <th>Kategori</th>
                            <th>Nama Siswa</th>
                            <th style="width:120px;">Kelas</th>
                            <th>Keterangan</th>
                            <th style="width:120px;">Status</th>
                            <th style="width:160px;">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Dummy Data --}}
                        <tr>
                            <td class="text-center">1</td>
                            <td>Peminjaman Alat</td>
                            <td><strong>Budi Santoso</strong></td>
                            <td class="text-center">XII RPL</td>
                            <td>Meminjam Mikrometer</td>
                            <td class="text-center"><span class="badge bg-success">Disetujui</span></td>
                            <td class="text-nowrap">2025-11-17 08:22</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>Pemakaian Bahan</td>
                            <td><strong>Salsa</strong></td>
                            <td class="text-center">XI TKJ</td>
                            <td>Menggunakan Kabel UTP 5m</td>
                            <td class="text-center"><span class="badge bg-warning text-dark">Menunggu</span></td>
                            <td class="text-nowrap">2025-11-17 09:10</td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>Pelanggaran</td>
                            <td><strong>Andi Pratama</strong></td>
                            <td class="text-center">X RPL</td>
                            <td>Terlambat mengembalikan alat</td>
                            <td class="text-center"><span class="badge bg-danger">Sanksi</span></td>
                            <td class="text-nowrap">2025-11-16 15:40</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Minimal styling untuk tampilan tabel --}}
    <style>
        .table-custom thead tr {
            background: linear-gradient(90deg, rgba(2,136,209,0.03), rgba(99,102,241,0.02));
            border-bottom: 1px solid rgba(0,0,0,0.06);
        }
        .table-custom th, .table-custom td { vertical-align: middle; padding: 0.75rem 0.9rem; }
        .table-custom tbody tr:hover { background-color: rgba(99,102,241,0.03); }
        @media (max-width: 576px) {
            .table-custom thead { display: none; }
            .table-custom tbody td { display: block; width: 100%; box-sizing: border-box; }
            .table-custom tbody tr { margin-bottom: .75rem; display: block; border: 1px solid #eee; border-radius: .5rem; padding: .6rem; }
            .table-custom tbody td::before { content: attr(data-label); font-weight:600; display:inline-block; width:110px; color:#6c757d; }
        }
    </style>

</div>

@endsection


{{-- SCRIPTS --}}
@section('scripts')

<!-- jQuery (already included in layout sometimes, keep here safe) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables core -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Buttons extension (export) -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function () {
        const table = $('#laporanTable').DataTable({
            pageLength: 10,
            ordering: true,
            responsive: true,
            dom: "<'row mb-2'<'col-sm-6'l><'col-sm-6 text-end'Bf>>" + "rt" + "<'row mt-2'<'col-sm-6'i><'col-sm-6'p>>",
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                    className: 'btn btn-sm btn-success'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="bi bi-file-earmark-pdf"></i> PDF',
                    className: 'btn btn-sm btn-danger'
                },
                {
                    extend: 'print',
                    text: '<i class="bi bi-printer"></i> Print',
                    className: 'btn btn-sm btn-outline-secondary'
                }
            ],
            language: {
                search: "🔍 Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data"
            }
        });

        // move DataTables buttons to custom container (header)
        table.buttons().container().appendTo('#table-buttons');

        // simple filter handlers (client-side)
        $('#applyFilter').on('click', function () {
            // for simple demo: just redraw table (server filter would need ajax)
            table.draw();
        });
        $('#resetFilter').on('click', function () {
            $('#filterForm')[0].reset();
            table.search('').columns().search('').draw();
        });
    });
</script>

@endsection

@section('footer')
    @include('be.footer')
@endsection
