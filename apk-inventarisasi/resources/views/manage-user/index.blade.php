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
        background: #f1f5f9 !important;
    }

    .page-title {
        font-size: 26px;
        font-weight: 700;
        color: #1e293b;
    }

    .card-custom {
        background: #ffffff;
        border-radius: 14px;
        padding: 25px;
        border: none;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    }

    /* DATA TABLE CUSTOM */
    #userManageTable_filter {
        float: left !important;
        text-align: left !important;
    }

    #userManageTable_filter input {
        border-radius: 10px !important;
        padding: 8px 12px !important;
    }

    .table thead {
        background: #1e293b;
        color: white;
    }

    .badge {
        font-size: 12px;
        padding: 6px 10px;
        border-radius: 8px;
    }

    .btn {
        border-radius: 8px;
        font-size: 12px;
        padding: 6px 10px;
    }
</style>



<!-- ========================================================
                       PAGE TITLE
======================================================== -->
<div class="d-flex justify-content-between mb-3">
    <h2 class="page-title">Manajemen Pelanggaran & Sanksi</h2>
</div>



<!-- ========================================================
                          CARD
======================================================== -->
<div class="card-custom">

    <table id="userManageTable" class="table table-striped table-hover align-middle" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Pelanggaran</th>
                <th>Status Akun</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>

            {{-- DUMMY DATA --}}
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
                <td>{{ $loop->iteration }}</td>

                <td>{{ $u['nama'] }}</td>

                <td>{{ $u['kelas'] }}</td>

                <td>
                    <span class="badge bg-danger">{{ $u['pelanggaran'] }} Pelanggaran</span>
                </td>

                <td>
                    @if($u['status'] == 'blocked')
                        <span class="badge bg-warning text-dark">Diblokir</span>
                    @else
                        <span class="badge bg-success">Aktif</span>
                    @endif
                </td>

                <td class="text-center">

                    <button class="btn btn-info btn-sm btn-detail"
                        data-nama="{{ $u['nama'] }}"
                        data-kelas="{{ $u['kelas'] }}"
                        data-pelanggaran="{{ $u['pelanggaran'] }}"
                        data-status="{{ $u['status'] }}"
                        data-alasan="{{ $u['alasan'] }}">
                        📄 Detail
                    </button>

                    @if($u['status'] == 'active')
                    <button class="btn btn-warning btn-sm btn-sanksi"
                        data-id="{{ $u['id'] }}"
                        data-nama="{{ $u['nama'] }}"
                        data-kelas="{{ $u['kelas'] }}">
                        ⚠ Beri Sanksi
                    </button>
                    @endif

                    @if($u['status'] == 'blocked')
                    <button class="btn btn-success btn-sm btn-unblock"
                        data-id="{{ $u['id'] }}"
                        data-nama="{{ $u['nama'] }}">
                        🔓 Buka Blokir
                    </button>
                    @endif

                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

</div>






<!-- ========================================================
                       MODAL DETAIL
======================================================== -->
<div class="modal fade" id="modalDetail">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Detail Pengguna</h5>
      </div>

      <div class="modal-body">
        <p><b>Nama:</b> <span id="d_nama"></span></p>
        <p><b>Kelas:</b> <span id="d_kelas"></span></p>
        <p><b>Total Pelanggaran:</b> <span id="d_pelanggaran"></span></p>
        <p><b>Status Akun:</b> <span id="d_status"></span></p>
        <p><b>Alasan Blokir:</b> <span id="d_alasan"></span></p>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>



<!-- ========================================================
                       MODAL SANKSI
======================================================== -->
<div class="modal fade" id="modalSanksi">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header bg-warning">
        <h5 class="modal-title text-dark">Beri Sanksi</h5>
      </div>

      <div class="modal-body">

        <input type="hidden" id="s_id">

        <p><b>Nama:</b> <span id="s_nama"></span></p>
        <p><b>Kelas:</b> <span id="s_kelas"></span></p>

        <label class="mt-2">Jenis Sanksi:</label>
        <select class="form-select" id="s_jenis">
            <option value="">-- Pilih --</option>
            <option value="blokir">Pemblokiran Akun</option>
            <option value="ganti_alat">Penggantian Alat Hilang</option>
        </select>

        <label class="mt-2">Catatan:</label>
        <textarea class="form-control" id="s_catatan" rows="3"></textarea>

        <label class="mt-2">Lama Blokir (Hari):</label>
        <input type="number" class="form-control" id="s_hari" min="1" max="30">

      </div>

      <div class="modal-footer">
        <button class="btn btn-success">Simpan</button>
      </div>

    </div>
  </div>
</div>




<!-- ========================================================
                       MODAL BUKA BLOKIR
======================================================== -->
<div class="modal fade" id="modalUnblock">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Buka Blokir Akun</h5>
      </div>

      <div class="modal-body">

        <input type="hidden" id="u_id">

        <p><b>Nama:</b> <span id="u_nama"></span></p>
        <p class="text-muted">Akun siswa ini akan dibuka blokirnya.</p>

      </div>

      <div class="modal-footer">
        <button class="btn btn-success">Ya, Buka Blokir</button>
      </div>

    </div>
  </div>
</div>







<!-- ========================================================
                       SCRIPTS
======================================================== -->

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- DataTables --}}
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>


<script>
$(function () {

    /* ===============================
       DATATABLES INIT
    =============================== */
    $('#userManageTable').DataTable({
        responsive: true,
        lengthChange: false,
        pageLength: 10,
        language: {
            search: "Cari:",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            zeroRecords: "Tidak ditemukan data",
            paginate: { previous: "‹", next: "›" }
        }
    });


    /* ===============================
       BUTTON: DETAIL
    =============================== */
    $(document).on("click", ".btn-detail", function () {
        $("#d_nama").text($(this).data("nama"));
        $("#d_kelas").text($(this).data("kelas"));
        $("#d_pelanggaran").text($(this).data("pelanggaran"));
        $("#d_status").text($(this).data("status"));
        $("#d_alasan").text($(this).data("alasan") || "-");

        new bootstrap.Modal("#modalDetail").show();
    });


    /* ===============================
       BUTTON: SANKSI
    =============================== */
    $(document).on("click", ".btn-sanksi", function () {
        $("#s_id").val($(this).data("id"));
        $("#s_nama").text($(this).data("nama"));
        $("#s_kelas").text($(this).data("kelas"));

        new bootstrap.Modal("#modalSanksi").show();
    });


    /* ===============================
       BUTTON: UNBLOCK
    =============================== */
    $(document).on("click", ".btn-unblock", function () {
        $("#u_id").val($(this).data("id"));
        $("#u_nama").text($(this).data("nama"));

        new bootstrap.Modal("#modalUnblock").show();
    });

});
</script>


@endsection

@section('footer')
    @include('be.footer')
@endsection