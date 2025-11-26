@extends ('be.layout')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')

<div class="container-fluid">

    <!-- TITLE -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Laporan Inventaris</h3>
    </div>

    <!-- FILTER SECTION -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">

                <div class="col-md-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" id="filterTanggal" class="form-control">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Kelas</label>
                    <select id="filterKelas" class="form-select">
                        <option value="">Semua</option>
                        <option>XI RPL 1</option>
                        <option>XI RPL 2</option>
                        <option>X TKJ 1</option>
                        <option>XII DKV</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Jenis Barang</label>
                    <select id="filterJenis" class="form-select">
                        <option value="">Semua</option>
                        <option>Proyektor</option>
                        <option>Kabel</option>
                        <option>Komputer</option>
                        <option>Alat Praktikum</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select id="filterStatus" class="form-select">
                        <option value="">Semua</option>
                        <option>Peminjaman</option>
                        <option>Pemakaian</option>
                        <option>Rusak</option>
                        <option>Hilang</option>
                        <option>Pengembalian</option>
                        <option>Pelanggaran</option>
                    </select>
                </div>

            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <div>
                <h5 class="mb-0">Laporan Inventaris</h5>
                <small class="text-muted">Ringkasan kegiatan & status barang</small>
            </div>
            <div class="d-flex gap-2">
                <button id="exportExcel" class="btn btn-sm btn-success d-none">Excel</button>
                <button id="exportPdf" class="btn btn-sm btn-danger d-none">PDF</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="laporanTable" class="table table-hover table-custom align-middle mb-0">
                    <thead>
                        <tr class="text-muted small">
                            <th style="width:60px;">No</th>
                            <th style="width:120px;">Tanggal</th>
                            <th>Nama Siswa</th>
                            <th style="width:120px;">Kelas</th>
                            <th style="width:150px;">Jenis Barang</th>
                            <th style="width:150px;">Kegiatan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 12; $i++)
                        <tr>
                            <td class="text-center">{{ $i }}</td>
                            <td class="text-nowrap">2025-02-15</td>
                            <td><strong>Rafi Nur</strong></td>
                            <td class="text-center">XI RPL 1</td>
                            <td>Proyektor</td>
                            <td class="text-center">
                                <span class="badge bg-primary">Peminjaman</span>
                            </td>
                            <td>Untuk presentasi kelas</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        /* table visual improvements */
        .table-custom thead tr {
            background: linear-gradient(90deg, rgba(2,136,209,0.06), rgba(99,102,241,0.03));
            border-bottom: 2px solid rgba(0,0,0,0.05);
        }
        .table-custom tbody tr:hover {
            background-color: rgba(99,102,241,0.03);
        }
        .table-custom th, .table-custom td {
            vertical-align: middle;
            padding: 0.85rem;
        }
        .table-custom td small { color: #6c757d; }
        @media (max-width: 576px) {
            .table-custom thead { display: none; }
            .table-custom tbody td { display: block; width: 100%; }
            .table-custom tbody tr { margin-bottom: 0.75rem; display: block; border: 1px solid #eee; border-radius: .5rem; padding: .5rem; }
            .table-custom tbody td::before { font-weight: 600; content: attr(data-label); display: inline-block; width: 110px; color: #6c757d; }
        }
    </style>

</div>


{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- DataTables + Buttons --}}
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
$(function () {

    const table = $('#laporanTable').DataTable({
        responsive: true,
        lengthChange: false,
        pageLength: 10,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Laporan Inventaris',
                className: 'btn btn-success mb-3'
            },
            {
                extend: 'pdfHtml5',
                title: 'Laporan Inventaris',
                className: 'btn btn-danger mb-3',
                orientation: 'landscape',
                pageSize: 'A4'
            }
        ],
        language: {
            search: "Cari:",
            zeroRecords: "Tidak ada data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
                previous: "‹",
                next: "›"
            }
        }
    });

    // FILTERING
    $('#filterTanggal, #filterKelas, #filterJenis, #filterStatus').on('change', function () {

        const tanggal = $('#filterTanggal').val();
        const kelas = $('#filterKelas').val();
        const jenis = $('#filterJenis').val();
        const status = $('#filterStatus').val();

        table.rows().every(function () {
            const row = this.data();

            const matchTanggal = !tanggal || row[1] === tanggal;
            const matchKelas = !kelas || row[3] === kelas;
            const matchJenis = !jenis || row[4] === jenis;
            const matchStatus = !status || row[5].includes(status);

            $(this.node()).toggle(matchTanggal && matchKelas && matchJenis && matchStatus);
        });
    });

});
</script>

@endsection

@section('footer')
    @include('be.footer')
@endsection
