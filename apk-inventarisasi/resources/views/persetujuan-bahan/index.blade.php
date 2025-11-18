@extends ('be.layout')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<style>
    .page-title {
        font-size: 26px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 25px;
    }

    .card-custom {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    table.dataTable thead tr {
        background: #1e3c72;
        color: #fff;
        text-transform: uppercase;
        font-size: 13px;
    }

    .badge-status {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-pending { background: #f39c12; color: white; }
    .badge-ditolak { background: #e74c3c; color: white; }
    .badge-selesai { background: #2ecc71; color: white; }
</style>

<div class="page-title">Persetujuan Pemakaian Bahan</div>

<div class="card card-custom p-4">
    <table id="tabelPersetujuanBahan" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Nama Bahan</th>
                <th>Jumlah</th>
                <th>Waktu Pemakaian</th>
                <th>Status</th>
                <th style="width:120px;">Aksi</th>
            </tr>
        </thead>

        <tbody>
            {{-- Dummy Data --}}
            @for($i = 1; $i <= 8; $i++)
            <tr>
                <td>{{ $i }}</td>
                <td>Nama Siswa {{ $i }}</td>
                <td>XII RPL {{ $i }}</td>
                <td>Bahan Kimia {{ $i }}</td>
                <td>{{ rand(1,5) }} botol</td>
                <td>{{ now()->subDays($i)->format('d M Y - H:i') }}</td>
                <td><span class="badge badge-status badge-pending">Pending</span></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-sm btn-info detailBtn"
                            data-bs-toggle="modal"
                            data-bs-target="#detailModal"
                            data-nama="Nama Siswa {{ $i }}"
                            data-kelas="XII RPL {{ $i }}"
                            data-bahan="Bahan Kimia {{ $i }}"
                            data-jumlah="{{ rand(1,5) }}"
                            data-waktu="{{ now()->subDays($i)->format('d M Y - H:i') }}">
                            Detail
                        </button>

                        <button class="btn btn-sm btn-success setujuiBtn"
                            data-bs-toggle="modal"
                            data-bs-target="#setujuiModal"
                            data-id="{{ $i }}">
                            Setujui
                        </button>

                        <button class="btn btn-sm btn-danger tolakBtn"
                            data-bs-toggle="modal"
                            data-bs-target="#tolakModal"
                            data-id="{{ $i }}">
                            Tolak
                        </button>
                    </div>
                </td>
            </tr>
            @endfor
        </tbody>
    </table>
</div>


{{-- ========================= --}}
{{-- Modal DETAIL --}}
{{-- ========================= --}}
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Detail Pemakaian Bahan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered">
                    <tr><th>Nama Siswa</th><td id="detailNama"></td></tr>
                    <tr><th>Kelas</th><td id="detailKelas"></td></tr>
                    <tr><th>Nama Bahan</th><td id="detailBahan"></td></tr>
                    <tr><th>Jumlah</th><td id="detailJumlah"></td></tr>
                    <tr><th>Waktu Pemakaian</th><td id="detailWaktu"></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>


{{-- ========================= --}}
{{-- Modal SETUJUI --}}
{{-- ========================= --}}
<div class="modal fade" id="setujuiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Setujui Pemakaian Bahan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>Yakin ingin menyetujui pemakaian bahan ini?</p>
                <div class="alert alert-info">
                    Stok bahan akan otomatis <strong>berkurang</strong> sesuai jumlah pemakaian.
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-success">Setujui</button>
            </div>
        </div>
    </div>
</div>


{{-- ========================= --}}
{{-- Modal TOLAK --}}
{{-- ========================= --}}
<div class="modal fade" id="tolakModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Tolak Pemakaian Bahan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label>Alasan Penolakan:</label>
                <textarea class="form-control" rows="3" placeholder="Tulis alasan..."></textarea>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-danger">Tolak</button>
            </div>
        </div>
    </div>
</div>

@endsection



@section('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi DataTables
    $('#tabelPersetujuanBahan').DataTable({
        responsive: true,
        pageLength: 10,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Tidak ada data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: { previous: "‹", next: "›" }
        },
        dom: '<"row mb-3"<"col-md-6"l><"col-md-6 text-end"f>>rtip'
    });

    // Detail modal handler
    $('.detailBtn').on('click', function() {
        $('#detailNama').text($(this).data('nama'));
        $('#detailKelas').text($(this).data('kelas'));
        $('#detailBahan').text($(this).data('bahan'));
        $('#detailJumlah').text($(this).data('jumlah'));
        $('#detailWaktu').text($(this).data('waktu'));
    });
});
</script>
@endsection



@section('footer')
    @include('be.footer')
@endsection