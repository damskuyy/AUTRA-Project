@extends ('be.layout')

@section('title', 'Persetujuan Pemakaian Bahan - Sistem Inventaris')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')

<div class="container-fluid py-4">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Persetujuan Pemakaian Bahan</h5>
                        <small class="text-muted">Kelola permintaan pemakaian bahan dari siswa</small>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary btn-sm" onclick="history.back()">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </button>
                        <button class="btn btn-primary btn-sm" id="refreshTable">
                            <i class="fas fa-sync-alt me-1"></i> Refresh
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Persetujuan --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="persetujuanTable" class="table table-hover align-middle w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Bahan</th>
                                    <th>Jumlah</th>
                                    <th>Waktu Pemakaian</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1; $i <= 8; $i++)
                                <tr>
                                    <td class="text-center">{{ $i }}</td>
                                    <td>
                                        <div>
                                            <h6 class="mb-0 text-sm">Nama Siswa {{ $i }}</h6>
                                            <small class="text-muted">Siswa</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-gradient-secondary">XII RPL {{ $i }}</span>
                                    </td>
                                    <td>
                                        <div>
                                            <h6 class="mb-0 text-sm">Bahan Kimia {{ $i }}</h6>
                                            <small class="text-muted">Bahan Praktikum</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ rand(1,5) }} botol</span>
                                    </td>
                                    <td>
                                        <small class="fw-bold">{{ now()->subDays($i)->format('d M Y') }}</small><br>
                                        <small class="text-muted">{{ now()->subDays($i)->format('H:i') }} WIB</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-info btn-sm btn-action btnDetail" 
                                                data-id="{{ $i }}">
                                                <i class="fas fa-eye me-1"></i> Detail
                                            </button>

                                            <button class="btn btn-success btn-sm btn-action btnApprove"
                                                data-id="{{ $i }}">
                                                <i class="fas fa-check me-1"></i> Setujui
                                            </button>

                                            <button class="btn btn-danger btn-sm btn-action btnReject"
                                                data-id="{{ $i }}">
                                                <i class="fas fa-times me-1"></i> Tolak
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
    </div>
</div>

{{-- ==================== MODAL DETAIL ==================== --}}
<div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pengajuan Pemakaian Bahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <h6 class="mb-3">Informasi Pemohon</h6>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Nama Siswa:</span>
                                    <span class="fw-bold" id="d_nama">-</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Kelas:</span>
                                    <span class="fw-bold" id="d_kelas">-</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Riwayat Pemakaian:</span>
                                    <span class="badge bg-gradient-primary">2x pemakaian</span>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h6 class="mb-3">Informasi Stok</h6>
                                <div class="border rounded p-3 bg-light">
                                    <h4 class="text-primary mb-2" id="d_stok_tersedia">15 botol</h4>
                                    <small class="text-muted">Stok tersedia saat ini</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <h6 class="mb-3">Informasi Bahan</h6>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Nama Bahan:</span>
                                    <span class="fw-bold" id="d_bahan">-</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Jumlah Diminta:</span>
                                    <span class="fw-bold" id="d_jumlah">-</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Ketersediaan:</span>
                                    <span class="badge bg-gradient-success">Tersedia</span>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <h6 class="mb-3">Waktu Pemakaian</h6>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Tanggal:</span>
                                    <span class="fw-bold" id="d_tanggal">-</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Jam:</span>
                                    <span class="fw-bold" id="d_waktu">-</span>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h6 class="mb-2">Keterangan</h6>
                                <p class="text-sm" id="d_keterangan">-</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- ==================== MODAL SETUJUI ==================== --}}
<div class="modal fade" id="modalApprove" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Setujui Pemakaian Bahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menyetujui pemakaian bahan ini?</p>
                <div class="alert alert-info text-sm">
                    <i class="fas fa-info-circle me-2"></i>
                    Stok bahan akan otomatis <strong>berkurang</strong> sesuai jumlah pemakaian.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="btnKirimSetujui">
                    <i class="fas fa-check me-1"></i> Setujui
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ==================== MODAL TOLAK ==================== --}}
<div class="modal fade" id="modalReject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tolak Pengajuan Pemakaian Bahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Alasan Penolakan</label>
                    <textarea class="form-control" id="inputAlasan" rows="4" placeholder="Tuliskan alasan penolakan pengajuan pemakaian bahan..."></textarea>
                </div>
                <div class="alert alert-warning text-sm">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Siswa akan menerima notifikasi penolakan beserta alasan yang diberikan.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="btnKirimTolak">
                    <i class="fas fa-paper-plane me-1"></i> Kirim Penolakan
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Toast container --}}
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
    <div id="toast-container"></div>
</div>

@endsection

@section('scripts')

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- DataTables --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi DataTable
    const table = $('#persetujuanTable').DataTable({
        responsive: true,
        lengthChange: false,
        pageLength: 8,
        language: {
            search: "Cari:",
            zeroRecords: "Tidak ada data pengajuan pemakaian bahan",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ pengajuan",
            infoEmpty: "Menampilkan 0 - 0 dari 0 pengajuan",
            infoFiltered: "(disaring dari _MAX_ total pengajuan)",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Berikutnya",
                previous: "Sebelumnya"
            }
        },
        order: [[0, 'asc']],
        columnDefs: [
            { orderable: false, targets: [7] } // Non-aktifkan sorting untuk kolom aksi
        ]
    });

    // Refresh table
    document.getElementById('refreshTable').addEventListener('click', function() {
        table.ajax.reload();
        showToast('Tabel diperbarui', 'success');
    });

    // Toast helper
    function showToast(message, type = 'info', timeout = 3000) {
        const bg = type === 'success' ? 'bg-success' : 
                   type === 'warning' ? 'bg-warning' : 
                   type === 'danger' ? 'bg-danger' : 'bg-secondary';
        
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-white ${bg} border-0`;
        toast.style.minWidth = '250px';
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        
        document.getElementById('toast-container').appendChild(toast);
        const bsToast = new bootstrap.Toast(toast, { delay: timeout });
        bsToast.show();
        
        // Hapus dari DOM setelah toast hilang
        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });
    }

    /* ============================
       BUTTON DETAIL
    ============================ */
    $(".btnDetail").click(function () {
        const id = $(this).data("id");
        
        // Data dummy - dalam aplikasi nyata data ini akan dari AJAX
        const data = {
            nama: "Nama Siswa " + id,
            kelas: "XII RPL " + id,
            bahan: "Bahan Kimia " + id,
            jumlah: id + " botol",
            tanggal: new Date().toLocaleDateString('id-ID', { 
                day: 'numeric', 
                month: 'long', 
                year: 'numeric' 
            }),
            waktu: new Date().toLocaleTimeString('id-ID', { 
                hour: '2-digit', 
                minute: '2-digit' 
            }) + " WIB",
            stok: (15 - id) + " botol",
            keterangan: "Digunakan untuk praktikum kimia materi reaksi asam basa di laboratorium"
        };

        $("#d_nama").text(data.nama);
        $("#d_kelas").text(data.kelas);
        $("#d_bahan").text(data.bahan);
        $("#d_jumlah").text(data.jumlah);
        $("#d_tanggal").text(data.tanggal);
        $("#d_waktu").text(data.waktu);
        $("#d_stok_tersedia").text(data.stok);
        $("#d_keterangan").text(data.keterangan);

        const modal = new bootstrap.Modal(document.getElementById('modalDetail'));
        modal.show();
    });

    /* ============================
       APPROVE
    ============================ */
    $(".btnApprove").click(function () {
        const id = $(this).data("id");
        
        Swal.fire({
            title: 'Setujui Pengajuan?',
            text: "Pengajuan pemakaian bahan akan disetujui dan stok akan dikurangi",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Setujui!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Simulasi AJAX request
                setTimeout(() => {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil Disetujui",
                        text: "Pengajuan pemakaian bahan telah disetujui",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    // Dalam aplikasi nyata, update status di tabel
                    showToast('Pengajuan berhasil disetujui', 'success');
                }, 500);
            }
        });
    });

    /* ============================
       REJECT
    ============================ */
    let selectedID = null;

    $(".btnReject").click(function () {
        selectedID = $(this).data("id");
        $("#inputAlasan").val(''); // Reset textarea
        const modal = new bootstrap.Modal(document.getElementById('modalReject'));
        modal.show();
    });

    /* ============================
       SUBMIT REJECTION
    ============================ */
    $("#btnKirimTolak").click(function () {
        const alasan = $("#inputAlasan").val().trim();

        if (alasan === "") {
            Swal.fire({
                icon: "error",
                title: "Alasan Required",
                text: "Harap isi alasan penolakan",
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        // Tutup modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('modalReject'));
        modal.hide();

        // Simulasi proses penolakan
        setTimeout(() => {
            Swal.fire({
                icon: "warning",
                title: "Pengajuan Ditolak",
                text: "Siswa akan menerima notifikasi penolakan",
                timer: 2000,
                showConfirmButton: false
            });
            
            showToast('Pengajuan berhasil ditolak', 'warning');
        }, 500);
    });

    // Auto-focus textarea ketika modal reject dibuka
    $('#modalReject').on('shown.bs.modal', function () {
        $('#inputAlasan').focus();
    });
});
</script>

@endsection

@section('footer')
    @include('be.footer')
@endsection