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
        <h2 class="mb-0">Manajemen Pelanggaran & Sanksi</h2>
    </div>

    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Siswa</p>
                                <h5 class="font-weight-bolder">4</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="fas fa-users text-lg opacity-10"></i>
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Pelanggaran</p>
                                <h5 class="font-weight-bolder">10</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="fas fa-exclamation-triangle text-lg opacity-10"></i>
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Akun Diblokir</p>
                                <h5 class="font-weight-bolder">2</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="fas fa-lock text-lg opacity-10"></i>
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Akun Aktif</p>
                                <h5 class="font-weight-bolder">2</h5>
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
    </div>

<!-- ========================================================
                          MAIN CARD
======================================================== -->
<div class="card hover-card">
    <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h6 class="mb-0">Daftar Pelanggaran Siswa</h6>
            <div class="ms-md-auto pe-md-3 d-flex align-items-center mb-3 mb-md-0">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search"></i></span>
                    <input type="text" id="customSearch" class="form-control" placeholder="Cari siswa...">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
            <table id="userManageTable" class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Siswa</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelas</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pelanggaran</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status Akun</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center aksi-col">Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     @php
                        $users = [
                            ['id'=>1,'nama'=>'Rafi','kelas'=>'X TKJ 1','pelanggaran'=>1,'status'=>'active','alasan'=>''],
                            ['id'=>2,'nama'=>'Lutfi','kelas'=>'XI RPL 2','pelanggaran'=>3,'status'=>'blocked','alasan'=>'Terlambat pengembalian 3x'],
                            ['id'=>3,'nama'=>'Bagas','kelas'=>'XII MM 1','pelanggaran'=>2,'status'=>'active','alasan'=>''],
                            ['id'=>4,'nama'=>'Dinda','kelas'=>'XI TKJ 3','pelanggaran'=>4,'status'=>'blocked','alasan'=>'Hilang alat solder'],
                        ];
                    @endphp

                    @foreach($users as $u)
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="fas fa-user text-lg opacity-10"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-center ms-4">
                                    <h6 class="mb-0 text-sm">{{ $u['nama'] }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $u['kelas'] }}</p>
                        </td>
                        <td>
                            <span class="badge badge-sm bg-gradient-danger">
                                {{ $u['pelanggaran'] }} Pelanggaran
                            </span>
                        </td>
                        <td>
                            @if($u['status'] == 'blocked')
                                <span class="badge badge-sm bg-gradient-warning">
                                    Diblokir
                                </span>
                            @else
                                <span class="badge badge-sm bg-gradient-success">
                                    Aktif
                                </span>
                            @endif
                        </td>
                        <td class="align-middle">
                            <div class="action-buttons">
                                 <button class="btn btn-link text-info mb-0 me-2 btn-detail"
                                    data-nama="{{ $u['nama'] }}"
                                    data-kelas="{{ $u['kelas'] }}"
                                    data-pelanggaran="{{ $u['pelanggaran'] }}"
                                    data-status="{{ $u['status'] }}"
                                    data-alasan="{{ $u['alasan'] }}">
                                    <i class="fas fa-eye me-1"></i>Detail
                                 </button>

                                @if($u['status'] == 'active')
                                <button class="btn btn-link text-warning mb-0 me-2 btn-sanksi"
                                    data-id="{{ $u['id'] }}"
                                    data-nama="{{ $u['nama'] }}"
                                    data-kelas="{{ $u['kelas'] }}">
                                    <i class="fas fa-gavel me-1"></i>Sanksi
                                </button>
                                @endif

                                @if($u['status'] == 'blocked')
                                <button class="btn btn-link text-success mb-0 btn-unblock"
                                    data-id="{{ $u['id'] }}"
                                    data-nama="{{ $u['nama'] }}">
                                    <i class="fas fa-lock-open me-1"></i>Buka
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
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
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailLabel">Detail Pengguna</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label class="form-label fw-bold">Nama:</label>
            <p id="d_nama" class="form-control-static"></p>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Kelas:</label>
            <p id="d_kelas" class="form-control-static"></p>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Total Pelanggaran:</label>
            <p id="d_pelanggaran" class="form-control-static"></p>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Status Akun:</label>
            <p id="d_status" class="form-control-static"></p>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Alasan Blokir:</label>
            <p id="d_alasan" class="form-control-static"></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Sanksi -->
<div class="modal fade" id="modalSanksi" tabindex="-1" role="dialog" aria-labelledby="modalSanksiLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSanksiLabel">Beri Sanksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="s_id">
        <div class="mb-3">
            <label class="form-label fw-bold">Nama:</label>
            <p id="s_nama" class="form-control-static"></p>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Kelas:</label>
            <p id="s_kelas" class="form-control-static"></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Sanksi:</label>
            <select class="form-control" id="s_jenis">
                <option value="">-- Pilih --</option>
                <option value="blokir">Pemblokiran Akun</option>
                <option value="ganti_alat">Penggantian Alat Hilang</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Catatan:</label>
            <textarea class="form-control" id="s_catatan" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Lama Blokir (Hari):</label>
            <input type="number" class="form-control" id="s_hari" min="1" max="30">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn bg-gradient-success">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Unblock -->
<div class="modal fade" id="modalUnblock" tabindex="-1" role="dialog" aria-labelledby="modalUnblockLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalUnblockLabel">Buka Blokir Akun</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="u_id">
        <div class="mb-3">
            <label class="form-label fw-bold">Nama:</label>
            <p id="u_nama" class="form-control-static"></p>
        </div>
        <p class="text-muted">Akun siswa ini akan dibuka blokirnya.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn bg-gradient-success">Ya, Buka Blokir</button>
      </div>
    </div>
  </div>
</div>

<style>
/* Center icon inside the circle and make circle perfectly centered with row content */
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
}

/* Sesuaikan ukuran ikon supaya rapi di tengah */
.icon.icon-shape i {
    font-size: 18px !important;
    line-height: 1 !important;
    transform: none !important;
}

/* Pastikan seluruh sel tabel meratakan konten secara vertikal */
.table th, .table td {
    vertical-align: middle !important;
}

/* Header Aksi di tengah */
.aksi-col {
    text-align: center !important;
    vertical-align: middle !important;
    width: 220px; /* sesuaikan lebar kolom aksi jika perlu */
}

/* Pastikan kolom aksi (last td) men-center isinya */
#userManageTable tbody td:last-child {
    text-align: center !important;
    padding-right: 1.5rem; /* beri sedikit ruang kanan agar tidak terlalu mepet */
}

/* Wrapper tombol: tetap satu baris, ukurannya tetap, dan berada di tengah kolom */
.action-buttons {
    display: inline-flex !important;
    gap: 12px;
    align-items: center !important;
    justify-content: center !important;
    white-space: nowrap;
    width: 160px;          /* tetapkan lebar group tombol supaya posisinya konsisten */
    max-width: 100%;
    margin: 0 auto !important; /* center di dalam td */
}

/* Paksa tombol tidak punya margin/offset tambahan sehingga benar-benar sejajar */
.action-buttons .btn {
    margin: 0 !important;
    padding: .35rem .8rem !important;
    line-height: 1 !important;
    vertical-align: middle !important;
}

/* Non-aktifkan scale/transform/animation pada tombol */
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

/* untuk geser sedikit teks "Menampilkan ..." ke kanan supaya tidak nempel kiri */
#userManageTable_info {
    padding-left: 18px;      
    color: #6c757d;          
    font-size: .95rem;
}

/* di layar kecil, kurangi padding supaya tidak melebihi layout */
@media (max-width: 576px) {
    #userManageTable_info {
        padding-left: 8px;
        font-size: .9rem;
    }
}

/* jika butuh penyesuaian untuk layar kecil, kurangi lebar group tombol */
@media (max-width: 576px) {
    .aksi-col { width: 140px; }
    .action-buttons { width: 120px; gap:8px; }
    .action-buttons .btn { padding: .3rem .6rem !important; font-size: 0.95rem; }
}
</style>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function () {
      // Initialize DataTable
      const table = $('#userManageTable').DataTable({
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
              '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
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
          const kelas = $(this).data("kelas");
          const pelanggaran = $(this).data("pelanggaran");
          const status = $(this).data("status");
          const alasan = $(this).data("alasan");
          
          $("#d_nama").text(nama);
          $("#d_kelas").text(kelas);
          $("#d_pelanggaran").text(pelanggaran + " Pelanggaran");
          
          let statusText = status === "blocked" ? "Diblokir" : "Aktif";
          let statusClass = status === "blocked" ? "badge bg-gradient-warning" : "badge bg-gradient-success";
          $("#d_status").html(`<span class="${statusClass}">${statusText}</span>`);
          
          $("#d_alasan").text(alasan || "-");
          
          const modal = new bootstrap.Modal(document.getElementById('modalDetail'));
          modal.show();
      });

      /* ===============================
        BUTTON: SANKSI
      =============================== */
      $(document).on("click", ".btn-sanksi", function () {
          const id = $(this).data("id");
          const nama = $(this).data("nama");
          const kelas = $(this).data("kelas");
          
          $("#s_id").val(id);
          $("#s_nama").text(nama);
          $("#s_kelas").text(kelas);
          
          // Reset form
          $("#s_jenis").val("");
          $("#s_catatan").val("");
          $("#s_hari").val("");
          
          const modal = new bootstrap.Modal(document.getElementById('modalSanksi'));
          modal.show();
      });

      /* ===============================
        BUTTON: UNBLOCK
      =============================== */
      $(document).on("click", ".btn-unblock", function () {
          const id = $(this).data("id");
          const nama = $(this).data("nama");
          
          $("#u_id").val(id);
          $("#u_nama").text(nama);
          
          const modal = new bootstrap.Modal(document.getElementById('modalUnblock'));
          modal.show();
      });

      // Simpan Sanksi
      $(document).on("click", "#modalSanksi .btn-success", function() {
          const id = $("#s_id").val();
          const jenis = $("#s_jenis").val();
          const catatan = $("#s_catatan").val();
          const hari = $("#s_hari").val();
          
          if (!jenis) {
              alert("Pilih jenis sanksi terlebih dahulu!");
              return;
          }
          
          // Simulasi penyimpanan data
          console.log("Simpan sanksi:", { id, jenis, catatan, hari });
          alert("Sanksi berhasil disimpan!");
          
          // Tutup modal
          bootstrap.Modal.getInstance(document.getElementById('modalSanksi')).hide();
      });

      // Konfirmasi Unblock
      $(document).on("click", "#modalUnblock .btn-success", function() {
          const id = $("#u_id").val();
          const nama = $("#u_nama").text();
          
          // Simulasi unblock
          console.log("Unblock user:", { id, nama });
          alert("Akun " + nama + " berhasil dibuka blokirnya!");
          
          // Tutup modal
          bootstrap.Modal.getInstance(document.getElementById('modalUnblock')).hide();
          
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