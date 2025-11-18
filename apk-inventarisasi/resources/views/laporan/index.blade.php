@extends ('be.layout')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<!-- ======================= STYLE ======================= -->
<style>
    body {
        background: #eef1f7;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #2b2f42;
    }

    .card-custom {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        border: none;
    }

    .filter-label {
        font-weight: 600;
        font-size: 14px;
        color: #2f3b52;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 10px;
        padding: 6px 12px;
        border: 1px solid #bfc3d4;
    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 8px;
    }

    .badge-status {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }

    .badge-pinjam { background: #4f6bed; color: #fff; }
    .badge-pakai { background: #28c76f; color: #fff; }
    .badge-rusak { background: #ea5455; color: #fff; }
    .badge-hilang { background: #ff9f43; color: #fff; }
</style>


<!-- ======================= TITLE ======================== -->
<div class="d-flex justify-content-between mb-4">
    <h2 class="page-title">Laporan Inventaris</h2>
</div>


<!-- ================= FILTER ==================== -->
<div class="card-custom mb-4">
    <div class="row g-3">

        <div class="col-md-3">
            <label class="filter-label">Tanggal</label>
            <input type="date" id="filterTanggal" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="filter-label">Kelas</label>
            <select id="filterKelas" class="form-select">
                <option value="">Semua</option>
                <option>XI RPL 1</option>
                <option>XI RPL 2</option>
                <option>X TKJ 1</option>
                <option>XII DKV</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="filter-label">Jenis Barang</label>
            <select id="filterJenis" class="form-select">
                <option value="">Semua</option>
                <option>Proyektor</option>
                <option>Kabel</option>
                <option>Komputer</option>
                <option>Alat Praktikum</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="filter-label">Status</label>
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


<!-- ======================= TABEL LAPORAN ======================= -->
<div class="card-custom">

    <table id="laporanTable" class="table table-bordered table-striped align-middle" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Jenis Barang</th>
                <th>Kegiatan</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>
            @for ($i = 1; $i <= 12; $i++)
            <tr>
                <td>{{ $i }}</td>
                <td>2025-02-15</td>
                <td>Rafi Nur</td>
                <td>XI RPL 1</td>
                <td>Proyektor</td>
                <td>
                    <span class="badge-status badge-pinjam">Peminjaman</span>
                </td>
                <td>Untuk presentasi kelas</td>
            </tr>
            @endfor
        </tbody>
    </table>

</div>



<!-- ======================= JS & DATATABLES ======================= -->

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

    /* ================================================
       INIT DATATABLE
    ================================================= */
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


    /* ================================================
       FILTER: TANGGAL, KELAS, JENIS, STATUS
    ================================================= */
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

            if (matchTanggal && matchKelas && matchJenis && matchStatus) {
                $(this.node()).show();
            } else {
                $(this.node()).hide();
            }
        });
    });

});
</script>

@endsection

@section('footer')
    @include('be.footer')
@endsection