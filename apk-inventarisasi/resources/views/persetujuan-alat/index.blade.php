@extends ('be.layout')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')

<style>
    body {
        background: #eef1f7;
    }

    .page-title {
        font-size: 26px;
        font-weight: 700;
        color: #2b3640;
    }

    .card-custom {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.07);
        border: none;
    }

    .table thead {
        background: #0d47a1;
        color: white;
    }

    .badge-status {
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-action {
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 13px;
    }

    .modal-content {
        border-radius: 14px;
        padding: 10px 20px;
    }

    .info-box {
        background: #f4f7fb;
        border-left: 4px solid #1565c0;
        padding: 10px 15px;
        border-radius: 10px;
        font-size: 14px;
    }
</style>

<div class="d-flex justify-content-between mb-3">
    <h2 class="page-title">Persetujuan Peminjaman Alat</h2>
</div>

<div class="card-custom">

    <table id="persetujuanTable" class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Barang</th>
                <th>Waktu Pinjam</th>
                <th>Waktu Kembali</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @for ($i = 1; $i <= 8; $i++)
            <tr>
                <td>{{ $i }}</td>
                <td>Rafi Nugraha</td>
                <td>XI RPL 1</td>
                <td>Proyektor Epson</td>
                <td>2025-02-16 08:00</td>
                <td>2025-02-16 15:00</td>
                <td>Untuk presentasi kelas</td>
                <td>
                    <button class="btn btn-info btn-sm btn-action btnDetail" 
                        data-id="{{ $i }}">Detail</button>

                    <button class="btn btn-success btn-sm btn-action btnApprove"
                        data-id="{{ $i }}">Setujui</button>

                    <button class="btn btn-danger btn-sm btn-action btnReject"
                        data-id="{{ $i }}">Tolak</button>
                </td>
            </tr>
            @endfor
        </tbody>
    </table>

</div>


{{-- ==================== MODAL DETAIL ==================== --}}
<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <h5 class="fw-bold mt-2">Detail Pengajuan</h5> <hr>

            <div class="row">

                <div class="col-md-6">
                    <div class="info-box mb-3">
                        <b>Nama Siswa:</b> <span id="d_nama"></span><br>
                        <b>Kelas:</b> <span id="d_kelas"></span><br>
                        <b>Riwayat Peminjaman:</b> <span class="text-primary">3x peminjaman</span>
                    </div>

                    <h6 class="fw-bold">Barcode Barang</h6>
                    <svg id="barcodePreview"></svg>
                </div>

                <div class="col-md-6">
                    <div class="info-box mb-3">
                        <b>Nama Barang:</b> <span id="d_barang"></span><br>
                        <b>Ketersediaan:</b> <span class="badge bg-success">Tersedia</span><br>
                        <b>Stok Saat Ini:</b> 14
                    </div>

                    <h6 class="fw-bold mb-1">Waktu Peminjaman</h6>
                    <p id="d_waktu_pinjam"></p>

                    <h6 class="fw-bold mb-1">Waktu Pengembalian</h6>
                    <p id="d_waktu_kembali"></p>

                    <h6 class="fw-bold mb-1">Keterangan</h6>
                    <p id="d_keterangan"></p>
                </div>

            </div>

        </div>
    </div>
</div>



{{-- ==================== MODAL TOLAK ==================== --}}
<div class="modal fade" id="modalReject">
    <div class="modal-dialog">
        <div class="modal-content">

            <h5 class="fw-bold mt-2">Tolak Pengajuan</h5> <hr>

            <label>Alasan Penolakan:</label>
            <textarea class="form-control" id="inputAlasan" rows="3" placeholder="Tuliskan alasan..."></textarea>

            <button class="btn btn-danger w-100 mt-3" id="btnKirimTolak">
                Kirim Penolakan (Dummy)
            </button>

        </div>
    </div>
</div>


@endsection




@section('scripts')

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- DataTables --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- JsBarcode --}}
<script src="https://cdn.jsdelivr.net/jsbarcode/3.11.5/JsBarcode.all.min.js"></script>


<script>
$(function () {

    const table = $('#persetujuanTable').DataTable({
        responsive: true,
        lengthChange: false,
        pageLength: 8,
        language: {
            search: "Cari:",
            zeroRecords: "Tidak ada data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
        }
    });


    /* ============================
       BUTTON DETAIL
    ============================ */
    $(".btnDetail").click(function () {

        let nama   = "Rafi Nugraha";
        let kelas  = "XI RPL 1";
        let barang = "Proyektor Epson";

        $("#d_nama").text(nama);
        $("#d_kelas").text(kelas);
        $("#d_barang").text(barang);
        $("#d_waktu_pinjam").text("2025-02-16 08:00");
        $("#d_waktu_kembali").text("2025-02-16 15:00");
        $("#d_keterangan").text("Untuk presentasi kelas");

        // Barcode
        JsBarcode("#barcodePreview", "BRG-001", {
            format: "CODE128",
            width: 2,
            height: 65
        });

        $("#modalDetail").modal("show");
    });




    /* ============================
       APPROVE (Dummy)
    ============================ */
    $(".btnApprove").click(function () {
        Swal.fire({
            icon: "success",
            title: "Berhasil Disetujui",
            text: "Siswa akan menerima notifikasi persetujuan.",
            timer: 1700,
            showConfirmButton: false
        });
    });




    /* ============================
       REJECT (Open Modal)
    ============================ */
    let selectedID = null;

    $(".btnReject").click(function () {
        selectedID = $(this).data("id");
        $("#modalReject").modal("show");
    });




    /* ============================
       SUBMIT REJECTION (Dummy)
    ============================ */
    $("#btnKirimTolak").click(function () {

        if ($("#inputAlasan").val().trim() === "") {
            Swal.fire("Error", "Alasan penolakan wajib diisi.", "error");
            return;
        }

        $("#modalReject").modal("hide");

        Swal.fire({
            icon: "warning",
            title: "Pengajuan Ditolak",
            text: "Siswa akan menerima notifikasi penolakan.",
            timer: 1800,
            showConfirmButton: false
        });
    });

});
</script>

@endsection


@section('footer')
    @include('be.footer')
@endsection
