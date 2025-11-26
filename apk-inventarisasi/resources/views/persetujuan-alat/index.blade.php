@extends ('be.layout')

@section('title', 'Persetujuan Peminjaman - Sistem Inventaris')

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
                        <h5 class="mb-0">Persetujuan Peminjaman Alat</h5>
                        <small class="text-muted">Kelola permintaan peminjaman barang dari siswa</small>
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
                                    <th>Barang</th>
                                    <th>Waktu Pinjam</th>
                                    <th>Waktu Kembali</th>
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
                                            <h6 class="mb-0 text-sm">Rafi Nugraha</h6>
                                            <small class="text-muted">Siswa</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-gradient-secondary">XI RPL 1</span>
                                    </td>
                                    <td>
                                        <div>
                                            <h6 class="mb-0 text-sm">Proyektor Epson</h6>
                                            <small class="text-muted">Elektronik</small>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="fw-bold">16 Feb 2025</small><br>
                                        <small class="text-muted">08:00 WIB</small>
                                    </td>
                                    <td>
                                        <small class="fw-bold">16 Feb 2025</small><br>
                                        <small class="text-muted">15:00 WIB</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-warning">Menunggu</span>
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
                <h5 class="modal-title">Detail Pengajuan Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <h6 class="mb-3">Informasi Peminjam</h6>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Nama Siswa:</span>
                                    <span class="fw-bold" id="d_nama">-</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Kelas:</span>
                                    <span class="fw-bold" id="d_kelas">-</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Riwayat Peminjaman:</span>
                                    <span class="badge bg-gradient-primary">3x peminjaman</span>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h6 class="mb-3">Barcode Barang</h6>
                                <div class="border rounded p-3 bg-light">
                                    <svg id="barcodePreview"></svg>
                                </div>
                                <small class="text-muted mt-2">Scan barcode untuk verifikasi</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <h6 class="mb-3">Informasi Barang</h6>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Nama Barang:</span>
                                    <span class="fw-bold" id="d_barang">-</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Ketersediaan:</span>
                                    <span class="badge bg-gradient-success">Tersedia</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Stok Saat Ini:</span>
                                    <span class="fw-bold">14 unit</span>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <h6 class="mb-3">Waktu Peminjaman</h6>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Pinjam:</span>
                                    <span class="fw-bold" id="d_waktu_pinjam">-</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Kembali:</span>
                                    <span class="fw-bold" id="d_waktu_kembali">-</span>
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

{{-- ==================== MODAL TOLAK ==================== --}}
<div class="modal fade" id="modalReject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tolak Pengajuan Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Alasan Penolakan</label>
                    <textarea class="form-control" id="inputAlasan" rows="4" placeholder="Tuliskan alasan penolakan pengajuan peminjaman..."></textarea>
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

{{-- JsBarcode --}}
<script src="https://cdn.jsdelivr.net/jsbarcode/3.11.5/JsBarcode.all.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi DataTable
    const table = $('#persetujuanTable').DataTable({
        responsive: true,
        lengthChange: false,
        pageLength: 8,
        language: {
            search: "Cari:",
            zeroRecords: "Tidak ada data pengajuan peminjaman",
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
            nama: "Rafi Nugraha",
            kelas: "XI RPL 1",
            barang: "Proyektor Epson",
            waktu_pinjam: "16 Februari 2025 - 08:00 WIB",
            waktu_kembali: "16 Februari 2025 - 15:00 WIB",
            keterangan: "Digunakan untuk presentasi mata pelajaran Teknologi Informasi dan Komunikasi di kelas XI RPL 1"
        };

        $("#d_nama").text(data.nama);
        $("#d_kelas").text(data.kelas);
        $("#d_barang").text(data.barang);
        $("#d_waktu_pinjam").text(data.waktu_pinjam);
        $("#d_waktu_kembali").text(data.waktu_kembali);
        $("#d_keterangan").text(data.keterangan);

        // Generate barcode
        JsBarcode("#barcodePreview", `BRG-${String(id).padStart(3, '0')}`, {
            format: "CODE128",
            width: 2,
            height: 60,
            displayValue: true,
            fontOptions: "bold",
            fontSize: 12
        });

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
            text: "Pengajuan peminjaman akan disetujui dan siswa akan menerima notifikasi",
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
                        text: "Pengajuan peminjaman telah disetujui",
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