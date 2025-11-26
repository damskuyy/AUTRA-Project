@extends ('be.layout')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<!-- ========================================================
                       PAGE TITLE & STATS
======================================================== -->
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Verifikasi Pengembalian Alat</h2>
    </div>

    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Tunggu Verifikasi</p>
                                <h5 class="font-weight-bolder">6</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="fas fa-clock text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Terverifikasi</p>
                                <h5 class="font-weight-bolder">12</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="fas fa-check-circle text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Ditolak</p>
                                <h5 class="font-weight-bolder">3</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="fas fa-times-circle text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pengembalian</p>
                                <h5 class="font-weight-bolder">21</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="fas fa-boxes text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- ========================================================
                          MAIN CARD
======================================================== -->
<div class="card hover-card">
    <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h6 class="mb-0">Daftar Pengembalian Alat</h6>
            <div class="ms-md-auto pe-md-3 d-flex align-items-center mb-3 mb-md-0">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search"></i></span>
                    <input type="text" id="customSearch" class="form-control" placeholder="Cari pengembalian...">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
            <table id="pengembalianTable" class="table align-items-center justify-content-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">Nama Siswa</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Barang Dikembalikan</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Waktu Pengembalian</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bukti Foto</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 6; $i++)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-0 text-sm">Fauzan Alfarel</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">Proyektor Epson X300</p>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">2025-02-17 14:25</p>
                        </td>
                        <td>
                            <img src="https://images.unsplash.com/photo-1594007654729-407eedc4be65?w=600"
                                 class="rounded" style="width: 60px; height: 45px; object-fit: cover;" 
                                 alt="Bukti">
                        </td>
                        <td>
                            <span class="badge badge-sm bg-gradient-warning">
                                <i class="fas fa-clock me-1"></i>Menunggu Verifikasi
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <button class="btn btn-sm bg-gradient-info mb-0 btn-detail"
                                    data-nama="Fauzan Alfarel"
                                    data-barang="Proyektor Epson X300"
                                    data-waktu="2025-02-17 14:25"
                                    data-foto="https://images.unsplash.com/photo-1594007654729-407eedc4be65?w=1200">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </button>
                                <button class="btn btn-sm bg-gradient-success mb-0 btn-verify"
                                    data-nama="Fauzan Alfarel"
                                    data-barang="Proyektor Epson X300">
                                    <i class="fas fa-check me-1"></i>Verifikasi
                                </button>
                                <button class="btn btn-sm bg-gradient-danger mb-0 btn-reject"
                                    data-nama="Fauzan Alfarel"
                                    data-barang="Proyektor Epson X300">
                                    <i class="fas fa-times me-1"></i>Tolak
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<!-- ========================================================
                       MODALS 
======================================================== -->
<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailLabel">Detail Pengembalian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Nama Siswa:</label>
                <p id="d_nama" class="form-control-static"></p>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Barang Dikembalikan:</label>
                <p id="d_barang" class="form-control-static"></p>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Waktu Pengembalian:</label>
            <p id="d_waktu" class="form-control-static"></p>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Bukti Foto:</label>
            <div class="text-center">
                <img id="d_foto" class="img-fluid rounded" style="max-height: 300px;">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Verifikasi -->
<div class="modal fade" id="modalVerify" tabindex="-1" role="dialog" aria-labelledby="modalVerifyLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalVerifyLabel">Verifikasi Pengembalian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="v_id">
        <div class="mb-3">
            <label class="form-label fw-bold">Nama Siswa:</label>
            <p id="v_nama" class="form-control-static"></p>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Barang:</label>
            <p id="v_barang" class="form-control-static"></p>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Kondisi Barang:</label>
            <select class="form-control" id="v_kondisi">
                <option value="baik">Baik (Normal)</option>
                <option value="rusak">Rusak</option>
                <option value="hilang">Hilang</option>
            </select>
        </div>
        <div class="mb-3" id="sanksiSection" style="display: none;">
            <label class="form-label fw-bold">Sanksi:</label>
            <input type="text" class="form-control" id="v_sanksi" placeholder="Misal: Ganti alat, blokir 7 hari, dll">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn bg-gradient-success">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tolak -->
<div class="modal fade" id="modalReject" tabindex="-1" role="dialog" aria-labelledby="modalRejectLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalRejectLabel">Tolak Pengembalian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="r_id">
        <div class="mb-3">
            <label class="form-label fw-bold">Nama Siswa:</label>
            <p id="r_nama" class="form-control-static"></p>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Barang:</label>
            <p id="r_barang" class="form-control-static"></p>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Alasan Penolakan:</label>
            <textarea class="form-control" id="r_alasan" rows="3" placeholder="Contoh: Bukti tidak sesuai / Foto tidak jelas"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn bg-gradient-danger">Tolak</button>
      </div>
    </div>
  </div>
</div>

<style>
/* Pastikan semua sel tabel rata tengah vertikal */
#pengembalianTable th, #pengembalianTable td {
    vertical-align: middle !important;
}

/* Lingkaran avatar: ukur, center ikon, hapus padding yg bikin bergeser */
.icon.icon-shape {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 48px !important;
    height: 48px !important;
    padding: 0 !important;
    margin: 0 !important;
    border-radius: 50% !important;
    box-sizing: border-box !important;
    flex: 0 0 auto !important;
}
.icon.icon-shape i {
    font-size: 18px !important;
    line-height: 1 !important;
    margin: 0 !important;
}

/* Pastikan wrapper nama siswa tetap di tengah vertikal */
#pengembalianTable td .d-flex.align-items-center {
    height: 100%;
    align-items: center !important;
}

/* Ukuran gambar bukti konsisten */
#pengembalianTable td img {
    width: 60px;
    height: 45px;
    object-fit: cover;
    display: block;
}

/* Group tombol aksi: jangan membungkus, center, dan beri gap konsisten */
#pengembalianTable td .d-flex.justify-content-center.align-items-center {
    display: flex !important;
    gap: 10px;
    justify-content: center !important;
    align-items: center !important;
    flex-wrap: nowrap !important;
}

/* Samakan ukuran tombol aksi agar rapi */
#pengembalianTable .btn {
    padding: .45rem .9rem !important;
    line-height: 1 !important;
    border-radius: .5rem;
}

/* Header "Aksi" pastikan center */
#pengembalianTable thead th.text-center {
    text-align: center !important;
}

/* Hilangkan efek pembesaran/animasi pada tombol saat diklik */
button.btn, a.btn, .btn {
    -webkit-transform: none !important;
    -ms-transform: none !important;
    transform: none !important;
    -webkit-transition: none !important;
    -moz-transition: none !important;
    transition: none !important;
    -webkit-animation: none !important;
    animation: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline: none !important;
}

/* Geser teks "Menampilkan ..." sedikit ke kanan supaya tidak menempel kiri */
#pengembalianTable_info {
    padding-left: 18px;
    color: #6c757d;
    font-size: .95rem;
}

/* Responsive tweaks */
@media (max-width: 576px) {
    .icon.icon-shape { width: 40px !important; height: 40px !important; }
    #pengembalianTable_info { padding-left: 8px; font-size: .9rem; }
    #pengembalianTable td .d-flex.justify-content-center.align-items-center { gap: 6px; }
}
</style>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    // Initialize DataTable
    const table = $('#pengembalianTable').DataTable({
        responsive: true,
        lengthChange: false,
        pageLength: 10,
        language: {
            search: "Cari:",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            zeroRecords: "Tidak ditemukan data",
            paginate: { 
                previous: "‹",
                next: "›"
            }
        },
        dom: '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        order: []
    });

    // Custom search functionality
    $('#customSearch').on('keyup', function() {
        table.search(this.value).draw();
    });

    /* ===============================
       BUTTON: DETAIL
    =============================== */
    $(document).on("click", ".btn-detail", function () {
        const nama = $(this).data("nama");
        const barang = $(this).data("barang");
        const waktu = $(this).data("waktu");
        const foto = $(this).data("foto");
        
        $("#d_nama").text(nama);
        $("#d_barang").text(barang);
        $("#d_waktu").text(waktu);
        $("#d_foto").attr("src", foto);
        
        const modal = new bootstrap.Modal(document.getElementById('modalDetail'));
        modal.show();
    });

    /* ===============================
       BUTTON: VERIFIKASI
    =============================== */
    $(document).on("click", ".btn-verify", function () {
        const nama = $(this).data("nama");
        const barang = $(this).data("barang");
        
        $("#v_nama").text(nama);
        $("#v_barang").text(barang);
        
        // Reset form
        $("#v_kondisi").val("baik");
        $("#v_sanksi").val("");
        $("#sanksiSection").hide();
        
        const modal = new bootstrap.Modal(document.getElementById('modalVerify'));
        modal.show();
    });

    /* ===============================
       BUTTON: TOLAK
    =============================== */
    $(document).on("click", ".btn-reject", function () {
        const nama = $(this).data("nama");
        const barang = $(this).data("barang");
        
        $("#r_nama").text(nama);
        $("#r_barang").text(barang);
        $("#r_alasan").val("");
        
        const modal = new bootstrap.Modal(document.getElementById('modalReject'));
        modal.show();
    });

    // Tampilkan sanksi jika kondisi rusak atau hilang
    $(document).on("change", "#v_kondisi", function() {
        if ($(this).val() === "rusak" || $(this).val() === "hilang") {
            $("#sanksiSection").show();
        } else {
            $("#sanksiSection").hide();
        }
    });

    // Simpan Verifikasi
    $(document).on("click", "#modalVerify .btn-success", function() {
        const nama = $("#v_nama").text();
        const kondisi = $("#v_kondisi").val();
        const sanksi = $("#v_sanksi").val();
        
        if ((kondisi === "rusak" || kondisi === "hilang") && !sanksi) {
            alert("Harap isi sanksi untuk kondisi " + kondisi);
            return;
        }
        
        // Simulasi penyimpanan
        console.log("Verifikasi:", { nama, kondisi, sanksi });
        alert("Pengembalian " + nama + " berhasil diverifikasi!");
        
        bootstrap.Modal.getInstance(document.getElementById('modalVerify')).hide();
        
        // Reload halaman untuk update data
        setTimeout(() => {
            location.reload();
        }, 1000);
    });

    // Konfirmasi Tolak
    $(document).on("click", "#modalReject .btn-danger", function() {
        const nama = $("#r_nama").text();
        const alasan = $("#r_alasan").val();
        
        if (!alasan) {
            alert("Harap isi alasan penolakan!");
            return;
        }
        
        // Simulasi penolakan
        console.log("Tolak:", { nama, alasan });
        alert("Pengembalian " + nama + " berhasil ditolak!");
        
        bootstrap.Modal.getInstance(document.getElementById('modalReject')).hide();
        
        // Reload halaman untuk update data
        setTimeout(() => {
            location.reload();
        }, 1000);
    });
});
</script>

@endsection

@section('footer')
    @include('be.footer')
@endsection