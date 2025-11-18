@extends ('be.layout')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')

<!-- ===================== DATATABLES CSS ===================== -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- ===================== PAGE STYLE ===================== -->
<style>
    body { background: #f4f6f9; }

    .page-title {
        font-size: 26px;
        font-weight: 700;
        color: #333;
    }

    .card-custom {
        background: #ffffff;
        border-radius: 14px;
        padding: 25px;
        border: none;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    }

    .badge-status {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }

    .badge-wait { background: #f7c948; color: #222; }
    .badge-done { background: #3bb273; color:white; }
    .badge-problem { background: #d64545; color:white; }

    .btn-action {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
    }

    .table thead tr {
        background: #4f6bed !important;
        color: #fff !important;
    }

    .dataTables_filter input {
        border-radius: 10px !important;
        padding: 8px 12px !important;
        border: 1px solid #ccc !important;
    }

    .dataTables_length select {
        border-radius: 10px !important;
        padding: 6px !important;
    }

    .preview-img {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #eee;
    }

    .modal-img-preview {
        width: 100%;
        border-radius: 12px;
    }
</style>

<!-- ===================== TITLE ===================== -->
<div class="d-flex justify-content-between mb-3">
    <h2 class="page-title">Verifikasi Pengembalian Alat</h2>
</div>

<!-- ===================== MAIN TABLE CARD ===================== -->
<div class="card-custom">

    <table id="pengembalianTable" class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Barang Dikembalikan</th>
                <th>Waktu Pengembalian</th>
                <th>Bukti Foto</th>
                <th>Status</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @for ($i = 1; $i <= 6; $i++)
            <tr>
                <td>{{ $i }}</td>
                <td>Fauzan Alfarel</td>
                <td>Proyektor Epson X300</td>
                <td>2025-02-17 14:25</td>
                <td>
                    <img src="https://images.unsplash.com/photo-1594007654729-407eedc4be65?w=600"
                         class="preview-img" alt="Bukti">
                </td>
                <td><span class="badge-status badge-wait">Menunggu Verifikasi</span></td>

                <td>
                    <button class="btn btn-info btn-action detailBtn"
                        data-bs-toggle="modal" data-bs-target="#modalDetail"
                        data-nama="Fauzan Alfarel"
                        data-barang="Proyektor Epson X300"
                        data-waktu="2025-02-17 14:25"
                        data-foto="https://images.unsplash.com/photo-1594007654729-407eedc4be65?w=1200">
                        Detail
                    </button>

                    <button class="btn btn-success btn-action verifyBtn"
                        data-bs-toggle="modal" data-bs-target="#modalVerify"
                        data-barang="Proyektor Epson X300">
                        Verifikasi
                    </button>

                    <button class="btn btn-danger btn-action rejectBtn"
                        data-bs-toggle="modal" data-bs-target="#modalReject">
                        Tolak
                    </button>
                </td>
            </tr>
            @endfor
        </tbody>
    </table>

</div>


<!-- ===================== MODAL DETAIL ===================== -->
<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Detail Pengembalian</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nama Siswa</strong><br> <span id="d_nama"></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Barang</strong><br> <span id="d_barang"></span>
                    </div>
                </div>

                <div class="mb-3">
                    <strong>Waktu Pengembalian</strong><br>
                    <span id="d_waktu"></span>
                </div>

                <div class="mb-3">
                    <strong>Bukti Foto</strong><br>
                    <img id="d_foto" class="modal-img-preview">
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ===================== MODAL VERIFIKASI ===================== -->
<div class="modal fade" id="modalVerify">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Verifikasi Pengembalian</h5>
            </div>

            <div class="modal-body">

                <label class="fw-bold mb-1">Kondisi Barang:</label>
                <select id="kondisiSelect" class="form-control mb-3">
                    <option value="baik">Baik (Normal)</option>
                    <option value="rusak">Rusak</option>
                    <option value="hilang">Hilang</option>
                </select>

                <div id="sanksiBox" style="display:none;">
                    <label class="fw-bold mb-1">Sanksi:</label>
                    <input type="text" id="sanksiInput" class="form-control"
                           placeholder="Misal: Ganti alat, blokir 7 hari, dll">
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-success">Simpan</button>
            </div>

        </div>
    </div>
</div>

<!-- ===================== MODAL REJECT ===================== -->
<div class="modal fade" id="modalReject">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Tolak Pengembalian</h5>
            </div>

            <div class="modal-body">
                <label class="mb-2">Alasan Penolakan:</label>
                <textarea class="form-control" rows="3"
                    placeholder="Contoh: Bukti tidak sesuai / Foto tidak jelas"></textarea>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-danger">Tolak</button>
            </div>

        </div>
    </div>
</div>


{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- DataTables --}}
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<script>
$(function () {

    /* ============================================================
       DataTables Initialization
    ============================================================ */
    const table = $('#pengembalianTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthChange: false,
        language: {
            search: "Cari:",
            zeroRecords: "Tidak ada data pengembalian",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            paginate: {
                previous: "‹",
                next: "›"
            }
        }
    });


    /* ============================================================
       Function : Fill modal detail
    ============================================================ */
    function fillDetailModal(data) {
        $('#d_nama').text(data.nama);
        $('#d_barang').text(data.barang);
        $('#d_waktu').text(data.waktu);
        $('#d_status').text(data.status);

        // Foto pengembalian
        $('#d_foto').attr("src", data.foto);
    }


    /* ============================================================
       Event: DETAIL button click
    ============================================================ */
    $(document).on('click', '.btn-detail', function () {
        const data = {
            nama: $(this).data('nama'),
            barang: $(this).data('barang'),
            waktu: $(this).data('waktu'),
            foto: $(this).data('foto'),
            status: $(this).data('status')
        };

        fillDetailModal(data);

        new bootstrap.Modal('#modalDetail').show();
    });


    /* ============================================================
       Event: VALIDASI button click
    ============================================================ */
    $(document).on('click', '.btn-validasi', function () {

        // Isi field modal validasi
        $('#v_id').val($(this).data('id'));
        $('#v_barang').text($(this).data('barang'));
        $('#v_nama').text($(this).data('nama'));

        new bootstrap.Modal('#modalValidasi').show();
    });


    /* ============================================================
       Event: TOLAK button click
    ============================================================ */
    $(document).on('click', '.btn-tolak', function () {

        // Isi field modal tolak
        $('#t_id').val($(this).data('id'));
        $('#t_nama').text($(this).data('nama'));
        $('#t_barang').text($(this).data('barang'));

        new bootstrap.Modal('#modalTolak').show();
    });

});
</script>

@endsection

@section('footer')
    @include('be.footer')
@endsection
