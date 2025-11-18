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
        <h2 class="mb-0">Data Inventaris</h2>
    </div>

    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Barang</p>
                                <h5 class="font-weight-bolder">15</h5>
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
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Barang Baik</p>
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Barang Rusak</p>
                                <h5 class="font-weight-bolder">2</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="fas fa-exclamation-triangle text-lg opacity-10"></i>
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Tidak Tersedia</p>
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
    </div>

<!-- ========================================================
                          MAIN CARD
======================================================== -->
<div class="card hover-card">
    <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h6 class="mb-0">Daftar Inventaris Barang</h6>
            <div class="d-flex gap-2 flex-wrap">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center mb-3 mb-md-0">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search"></i></span>
                        <input type="text" id="customSearch" class="form-control" placeholder="Cari barang...">
                    </div>
                </div>
                <button class="btn btn-sm bg-gradient-success mb-0" onclick="showAddModal()">
                    <i class="fas fa-plus me-1"></i>Tambah Barang
                </button>
                <button class="btn btn-sm bg-gradient-info mb-0" onclick="generateBarcode()">
                    <i class="fas fa-barcode me-1"></i>Generate Barcode
                </button>
            </div>
        </div>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
            <table id="inventoryTable" class="table align-items-center justify-content-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">Kode Barang</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Barang</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis Barang</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kondisi</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah Stok</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ketersediaan</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-0 text-sm">001</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">Laptop</p>
                        </td>
                        <td>
                            <span class="badge badge-sm bg-gradient-info">Elektronik</span>
                        </td>
                        <td>
                            <span class="badge badge-sm bg-gradient-success">
                                <i class="fas fa-check me-1"></i>Baik
                            </span>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">10</p>
                        </td>
                        <td>
                            <span class="badge badge-sm bg-gradient-success">
                                <i class="fas fa-check-circle me-1"></i>Tersedia
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <button class="btn btn-sm bg-gradient-warning mb-0 btn-update"
                                    data-kode="001"
                                    data-nama="Laptop"
                                    data-jenis="Elektronik"
                                    data-kondisi="Baik"
                                    data-stok="10"
                                    data-ketersediaan="Tersedia">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </button>
                                <button class="btn btn-sm bg-gradient-danger mb-0 btn-delete"
                                    data-kode="001"
                                    data-nama="Laptop">
                                    <i class="fas fa-trash me-1"></i>Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-0 text-sm">002</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">Meja</p>
                        </td>
                        <td>
                            <span class="badge badge-sm bg-gradient-secondary">Furnitur</span>
                        </td>
                        <td>
                            <span class="badge badge-sm bg-gradient-danger">
                                <i class="fas fa-times me-1"></i>Rusak
                            </span>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">5</p>
                        </td>
                        <td>
                            <span class="badge badge-sm bg-gradient-danger">
                                <i class="fas fa-times-circle me-1"></i>Tidak Tersedia
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <button class="btn btn-sm bg-gradient-warning mb-0 btn-update"
                                    data-kode="002"
                                    data-nama="Meja"
                                    data-jenis="Furnitur"
                                    data-kondisi="Rusak"
                                    data-stok="5"
                                    data-ketersediaan="Tidak Tersedia">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </button>
                                <button class="btn btn-sm bg-gradient-danger mb-0 btn-delete"
                                    data-kode="002"
                                    data-nama="Meja">
                                    <i class="fas fa-trash me-1"></i>Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-0 text-sm">003</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">Sempak</p>
                        </td>
                        <td>
                            <span class="badge badge-sm bg-gradient-secondary">Asset</span>
                        </td>
                        <td>
                            <span class="badge badge-sm bg-gradient-danger">
                                <i class="fas fa-times me-1"></i>Rusak
                            </span>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">5</p>
                        </td>
                        <td>
                            <span class="badge badge-sm bg-gradient-danger">
                                <i class="fas fa-times-circle me-1"></i>Tidak Tersedia
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <button class="btn btn-sm bg-gradient-warning mb-0 btn-update"
                                    data-kode="002"
                                    data-nama="Meja"
                                    data-jenis="Furnitur"
                                    data-kondisi="Rusak"
                                    data-stok="5"
                                    data-ketersediaan="Tidak Tersedia">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </button>
                                <button class="btn btn-sm bg-gradient-danger mb-0 btn-delete"
                                    data-kode="002"
                                    data-nama="Meja">
                                    <i class="fas fa-trash me-1"></i>Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="me-3">
                <button class="btn btn-sm bg-gradient-primary mb-0" onclick="exportToExcel()">
                    <i class="fas fa-file-excel me-1"></i>Export Excel
                </button>
                <button class="btn btn-sm bg-gradient-danger mb-0" onclick="exportToPDF()">
                    <i class="fas fa-file-pdf me-1"></i>Export PDF
                </button>
            </div>
            <div class="d-flex align-items-center">
                <span class="text-sm me-3">Import Data:</span>
                <input type="file" id="importFile" accept=".xlsx" class="form-control form-control-sm" style="width: auto;" onchange="importFromExcel()">
            </div>
        </div>
    </div>
</div>
</div>

<!-- ========================================================
                       MODALS 
======================================================== -->
<!-- Modal Tambah Barang -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Tambah Barang Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addForm">
            <div class="mb-3">
                <label class="form-label fw-bold">Kode Barang</label>
                <input type="text" class="form-control" id="addKode" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Barang</label>
                <input type="text" class="form-control" id="addNama" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Jenis Barang</label>
                <input type="text" class="form-control" id="addJenis" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Kondisi</label>
                <select class="form-control" id="addKondisi" required>
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Perbaikan">Perbaikan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Jumlah Stok</label>
                <input type="number" class="form-control" id="addStok" required min="0">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Ketersediaan</label>
                <select class="form-control" id="addKetersediaan" required>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Tidak Tersedia">Tidak Tersedia</option>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn bg-gradient-success" onclick="addItem()">Tambah Barang</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Barang -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Edit Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updateForm">
            <input type="hidden" id="updateKode">
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Barang</label>
                <p id="updateNama" class="form-control-static"></p>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Jenis Barang</label>
                <p id="updateJenis" class="form-control-static"></p>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Kondisi</label>
                <select class="form-control" id="updateKondisi" required>
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Perbaikan">Perbaikan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Jumlah Stok</label>
                <input type="number" class="form-control" id="updateStok" required min="0">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Ketersediaan</label>
                <select class="form-control" id="updateKetersediaan" required>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Tidak Tersedia">Tidak Tersedia</option>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn bg-gradient-primary" onclick="updateItem()">Update Barang</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="deleteKode">
        <div class="mb-3">
            <label class="form-label fw-bold">Nama Barang:</label>
            <p id="deleteNama" class="form-control-static"></p>
        </div>
        <p class="text-muted">Apakah Anda yakin ingin menghapus barang ini? Tindakan ini tidak dapat dibatalkan.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn bg-gradient-danger" onclick="confirmDelete()">Ya, Hapus</button>
      </div>
    </div>
  </div>
</div>

<!-- Barcode viewer: muncul terpusat & rapi saat generate -->
<div id="barcodeWrapper" class="barcode-wrapper" style="display:none;">
  <div class="barcode-inner">
    <canvas id="barcodeCanvas"></canvas>
    <div class="barcode-actions">
      <button id="closeBarcode" class="btn btn-sm bg-gradient-secondary">Tutup</button>
      <a id="downloadBarcode" class="btn btn-sm bg-gradient-primary" href="#" download>Download PNG</a>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<style>
/* pastikan konten ikon benar-benar ter-center di dalam lingkaran */
.icon.icon-shape {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 48px !important;        /* sesuaikan ukuran lingkaran */
    height: 48px !important;
    padding: 0 !important;         /* pastikan tidak ada padding yg mendorong ikon */
    margin: 0 !important;
    border-radius: 50% !important;
    box-sizing: border-box !important;
    flex: 0 0 auto !important;
}

/* pastikan semua jenis ikon (font-awesome / svg) disejajarkan */
.icon.icon-shape i,
.icon.icon-shape .fa,
.icon.icon-shape svg {
    font-size: 18px !important;
    line-height: 1 !important;
    margin: 0 !important;
    transform: none !important;
    vertical-align: middle !important;
    display: inline-block !important;
}

/* parent row: pastikan semua baris tabel rata tengah vertikal */
.table td, .table th {
    vertical-align: middle !important;
}

/* jika ada spacing helper (me-3) yang membuat posisi bergeser, paksa align center di wrapper */
.d-flex.align-items-center {
    align-items: center !important;
}

/* Geser teks "Menampilkan ..." sedikit ke kanan supaya tidak nempel di kiri */
#inventoryTable_info {
    padding-left: 18px;      /* ubah nilainya sesuai selera (mis. 12-24px) */
    color: #6c757d;
    font-size: .95rem;
}

/* Di layar kecil, kurangi padding supaya tidak keluar layout */
@media (max-width: 576px) {
    #inventoryTable_info {
        padding-left: 8px;
        font-size: .9rem;
    }
}

/* Styling barcode viewer supaya rapi dan centered */
.barcode-wrapper {
    position: fixed;
    left: 0;
    right: 0;
    bottom: 24px;                /* jarak dari bawah */
    display: flex;
    justify-content: center;
    pointer-events: auto;
    z-index: 1055;
}
.barcode-inner {
    background: #fff;
    padding: 12px;
    border-radius: 8px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    max-width: 360px;
}
#barcodeCanvas {
    display: block;
    max-width: 320px;
    width: 100%;
    height: auto;
    background: #fff;
}
.barcode-actions {
    display: flex;
    gap: 8px;
    align-items: center;
}
</style>

<script>
$(document).ready(function () {
    // Initialize DataTable
    const table = $('#inventoryTable').DataTable({
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
       BUTTON: EDIT
    =============================== */
    $(document).on("click", ".btn-update", function () {
        const kode = $(this).data("kode");
        const nama = $(this).data("nama");
        const jenis = $(this).data("jenis");
        const kondisi = $(this).data("kondisi");
        const stok = $(this).data("stok");
        const ketersediaan = $(this).data("ketersediaan");
        
        $("#updateKode").val(kode);
        $("#updateNama").text(nama);
        $("#updateJenis").text(jenis);
        $("#updateKondisi").val(kondisi);
        $("#updateStok").val(stok);
        $("#updateKetersediaan").val(ketersediaan);
        
        const modal = new bootstrap.Modal(document.getElementById('updateModal'));
        modal.show();
    });

    /* ===============================
       BUTTON: DELETE
    =============================== */
    $(document).on("click", ".btn-delete", function () {
        const kode = $(this).data("kode");
        const nama = $(this).data("nama");
        
        $("#deleteKode").val(kode);
        $("#deleteNama").text(nama);
        
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    });
});

function showAddModal() {
    $('#addModal').modal('show');
}

function addItem() {
    const kode = document.getElementById('addKode').value;
    const nama = document.getElementById('addNama').value;
    const jenis = document.getElementById('addJenis').value;
    const kondisi = document.getElementById('addKondisi').value;
    const stok = document.getElementById('addStok').value;
    const ketersediaan = document.getElementById('addKetersediaan').value;
    
    if (kode && nama && jenis && kondisi && stok && ketersediaan) {
        const table = $('#inventoryTable').DataTable();
        table.row.add([
            `<div class="d-flex align-items-center">
                <div class="d-flex flex-column">
                    <h6 class="mb-0 text-sm">${kode}</h6>
                </div>
            </div>`,
            nama,
            `<span class="badge badge-sm bg-gradient-info">${jenis}</span>`,
            `<span class="badge badge-sm bg-gradient-${kondisi === 'Baik' ? 'success' : 'danger'}">
                <i class="fas fa-${kondisi === 'Baik' ? 'check' : 'times'} me-1"></i>${kondisi}
            </span>`,
            stok,
            `<span class="badge badge-sm bg-gradient-${ketersediaan === 'Tersedia' ? 'success' : 'danger'}">
                <i class="fas fa-${ketersediaan === 'Tersedia' ? 'check-circle' : 'times-circle'} me-1"></i>${ketersediaan}
            </span>`,
            `<div class="d-flex justify-content-center align-items-center gap-2">
                <button class="btn btn-sm bg-gradient-warning mb-0 btn-update"
                    data-kode="${kode}" data-nama="${nama}" data-jenis="${jenis}"
                    data-kondisi="${kondisi}" data-stok="${stok}" data-ketersediaan="${ketersediaan}">
                    <i class="fas fa-edit me-1"></i>Edit
                </button>
                <button class="btn btn-sm bg-gradient-danger mb-0 btn-delete"
                    data-kode="${kode}" data-nama="${nama}">
                    <i class="fas fa-trash me-1"></i>Hapus
                </button>
            </div>`
        ]).draw();
        
        $('#addModal').modal('hide');
        document.getElementById('addForm').reset();
    }
}

function updateItem() {
    const kode = $("#updateKode").val();
    const kondisi = $("#updateKondisi").val();
    const stok = $("#updateStok").val();
    const ketersediaan = $("#updateKetersediaan").val();
    
    const table = $('#inventoryTable').DataTable();
    const data = table.data();
    
    for (let i = 0; i < data.length; i++) {
        const row = data[i];
        if (row[0].includes(kode)) {
            // Update row data
            table.cell(i, 3).data(
                `<span class="badge badge-sm bg-gradient-${kondisi === 'Baik' ? 'success' : 'danger'}">
                    <i class="fas fa-${kondisi === 'Baik' ? 'check' : 'times'} me-1"></i>${kondisi}
                </span>`
            );
            table.cell(i, 4).data(stok);
            table.cell(i, 5).data(
                `<span class="badge badge-sm bg-gradient-${ketersediaan === 'Tersedia' ? 'success' : 'danger'}">
                    <i class="fas fa-${ketersediaan === 'Tersedia' ? 'check-circle' : 'times-circle'} me-1"></i>${ketersediaan}
                </span>`
            );
            table.draw();
            break;
        }
    }
    
    $('#updateModal').modal('hide');
}

function confirmDelete() {
    const kode = $("#deleteKode").val();
    const nama = $("#deleteNama").text();
    
    const table = $('#inventoryTable').DataTable();
    const data = table.data();
    
    for (let i = 0; i < data.length; i++) {
        const row = data[i];
        if (row[0].includes(kode)) {
            table.row(i).remove().draw();
            break;
        }
    }
    
    $('#deleteModal').modal('hide');
    alert(`Barang ${nama} berhasil dihapus!`);
}

function generateBarcode() {
    const kode = prompt('Masukkan Kode Barang untuk generate barcode:');
    if (!kode) return;

    const canvas = document.getElementById('barcodeCanvas');

    // Set canvas real pixel size untuk hasil tajam saat di-download
    const displayWidth = 300;   // lebar tampilan (px)
    const displayHeight = 100;  // tinggi tampilan (px)
    const scale = 2;            // scale untuk meningkatkan kualitas (retina)
    canvas.width = displayWidth * scale;
    canvas.height = displayHeight * scale;
    canvas.style.width = displayWidth + 'px';
    canvas.style.height = displayHeight + 'px';

    // Generate barcode (sesuaikan options jika perlu)
    JsBarcode(canvas, kode, {
        format: "CODE128",
        width: 2,
        height: 60 * scale,
        displayValue: true,
        fontSize: 16 * scale,
        margin: 10 * scale
    });

    // Tampilkan wrapper rapi
    document.getElementById('barcodeWrapper').style.display = 'flex';

    // Siapkan link download
    const link = document.getElementById('downloadBarcode');
    link.href = canvas.toDataURL('image/png');
    link.download = `barcode-${kode}.png`;
}

// close handler
document.addEventListener('click', function (e) {
    if (e.target && e.target.id === 'closeBarcode') {
        document.getElementById('barcodeWrapper').style.display = 'none';
    }
});

function exportToExcel() {
    const table = document.getElementById('inventoryTable');
    const wb = XLSX.utils.table_to_book(table, {sheet: "Inventaris"});
    XLSX.writeFile(wb, 'inventaris.xlsx');
}

function exportToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    doc.text('Data Inventaris', 20, 20);
    const table = document.getElementById('inventoryTable');
    doc.autoTable({ html: table });
    doc.save('inventaris.pdf');
}

function importFromExcel() {
    const file = document.getElementById('importFile').files[0];
    if (!file) return;
    
    const reader = new FileReader();
    reader.onload = function(e) {
        const data = new Uint8Array(e.target.result);
        const workbook = XLSX.read(data, {type: 'array'});
        const sheet = workbook.Sheets[workbook.SheetNames[0]];
        const json = XLSX.utils.sheet_to_json(sheet);
        const table = $('#inventoryTable').DataTable();
        
        table.clear();
        json.forEach(row => {
            const kondisi = row['Kondisi'] || 'Baik';
            const ketersediaan = row['Ketersediaan'] || 'Tersedia';
            
            table.row.add([
                `<div class="d-flex align-items-center">
                    <div class="d-flex flex-column">
                        <h6 class="mb-0 text-sm">${row['Kode Barang'] || ''}</h6>
                    </div>
                </div>`,
                row['Nama Barang'] || '',
                `<span class="badge badge-sm bg-gradient-info">${row['Jenis Barang'] || ''}</span>`,
                `<span class="badge badge-sm bg-gradient-${kondisi === 'Baik' ? 'success' : 'danger'}">
                    <i class="fas fa-${kondisi === 'Baik' ? 'check' : 'times'} me-1"></i>${kondisi}
                </span>`,
                row['Jumlah Stok'] || '',
                `<span class="badge badge-sm bg-gradient-${ketersediaan === 'Tersedia' ? 'success' : 'danger'}">
                    <i class="fas fa-${ketersediaan === 'Tersedia' ? 'check-circle' : 'times-circle'} me-1"></i>${ketersediaan}
                </span>`,
                `<div class="d-flex justify-content-center align-items-center gap-2">
                    <button class="btn btn-sm bg-gradient-warning mb-0 btn-update">
                        <i class="fas fa-edit me-1"></i>Edit
                    </button>
                    <button class="btn btn-sm bg-gradient-danger mb-0 btn-delete">
                        <i class="fas fa-trash me-1"></i>Hapus
                    </button>
                </div>`
            ]);
        });
        table.draw();
        alert('Data berhasil diimport dari Excel!');
    };
    reader.readAsArrayBuffer(file);
}
</script>

@endsection

@section('footer')
    @include('be.footer')
@endsection