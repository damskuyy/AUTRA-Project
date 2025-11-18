@extends('be.layout')

@section('title', 'Pengembalian - Sistem Inventaris')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Pengembalian Barang</h6>
                            <p class="text-sm mb-0">Proses pengembalian barang yang dipinjam</p>
                        </div>
                        <div class="d-flex">
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#pengembalianModal">
                                <i class="fas fa-undo me-1"></i> Pengembalian Alat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barang yang Perlu Dikembalikan -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Barang yang Perlu Dikembalikan</h6>
                    <p class="text-sm mb-0">Daftar barang yang masih dalam status dipinjam</p>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Pinjam</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Batas Kembali</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="avatar avatar-sm me-3" alt="Laptop">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Laptop</h6>
                                                <p class="text-xs text-secondary mb-0">2 unit - Lab Komputer 1</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">16 Mar 2024</p>
                                        <p class="text-xs text-secondary mb-0">08:00 WIB</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">16 Mar 2024</p>
                                        <p class="text-xs text-secondary mb-0">10:00 WIB</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-warning">Sedang Dipinjam</span>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-sm bg-gradient-success mb-0" onclick="kembalikanBarang(1)">
                                            <i class="fas fa-undo me-1"></i> Kembalikan
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://images.unsplash.com/photo-1616012480717-fd986a4667e0?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="avatar avatar-sm me-3" alt="Mikroskop">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Mikroskop</h6>
                                                <p class="text-xs text-secondary mb-0">1 unit - Lab IPA</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">15 Mar 2024</p>
                                        <p class="text-xs text-secondary mb-0">10:00 WIB</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">15 Mar 2024</p>
                                        <p class="text-xs text-danger mb-0">12:00 WIB <small>(terlambat)</small></p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-danger">Terlambat</span>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-sm bg-gradient-success mb-0" onclick="kembalikanBarang(2)">
                                            <i class="fas fa-undo me-1"></i> Kembalikan
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://images.unsplash.com/photo-1558618666-fcd25856cd63?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="avatar avatar-sm me-3" alt="Monitor">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Monitor</h6>
                                                <p class="text-xs text-secondary mb-0">1 unit - Lab Komputer 1</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">14 Mar 2024</p>
                                        <p class="text-xs text-secondary mb-0">13:00 WIB</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">17 Mar 2024</p>
                                        <p class="text-xs text-success mb-0">13:00 WIB</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-success">Aktif</span>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-sm bg-gradient-success mb-0" onclick="kembalikanBarang(3)">
                                            <i class="fas fa-undo me-1"></i> Kembalikan
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Pengembalian Terbaru -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Riwayat Pengembalian Terbaru</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Kembali</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kondisi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://images.unsplash.com/photo-1586953208448-b95a79798f07?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="avatar avatar-sm me-3" alt="Proyektor">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Proyektor</h6>
                                                <p class="text-xs text-secondary mb-0">1 unit</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">15 Mar 2024</p>
                                        <p class="text-xs text-secondary mb-0">11:30 WIB</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-success">Baik</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-success">Selesai</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://images.unsplash.com/photo-1541140532154-b024d705b90a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="avatar avatar-sm me-3" alt="Keyboard">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Keyboard</h6>
                                                <p class="text-xs text-secondary mb-0">2 unit</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">14 Mar 2024</p>
                                        <p class="text-xs text-secondary mb-0">09:15 WIB</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-warning">Rusak Ringan</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-success">Selesai</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pengembalian -->
<div class="modal fade" id="pengembalianModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Pengembalian Alat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-pengembalian">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">Data Pengembalian</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Pilih Barang yang Dikembalikan <span class="text-danger">*</span></label>
                                        <select class="form-control" id="barang-dikembalikan" required>
                                            <option value="">Pilih Barang</option>
                                            <option value="1">Laptop (2 unit) - Lab Komputer 1</option>
                                            <option value="2">Mikroskop (1 unit) - Lab IPA</option>
                                            <option value="3">Monitor (1 unit) - Lab Komputer 1</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                                        <select class="form-control" id="pengembalian-mapel" required>
                                            <option value="">Pilih Mata Pelajaran</option>
                                            <option value="Fisika">Fisika</option>
                                            <option value="Kimia">Kimia</option>
                                            <option value="Biologi">Biologi</option>
                                            <option value="Informatika">Informatika</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Ruangan <span class="text-danger">*</span></label>
                                        <select class="form-control" id="pengembalian-ruangan" required>
                                            <option value="">Pilih Ruangan</option>
                                            <option value="Lab Komputer 1">Lab Komputer 1</option>
                                            <option value="Lab Komputer 2">Lab Komputer 2</option>
                                            <option value="Lab IPA">Lab IPA</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">Kondisi Barang</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Kondisi Barang <span class="text-danger">*</span></label>
                                        <select class="form-control" id="kondisi-barang" required>
                                            <option value="">Pilih Kondisi</option>
                                            <option value="baik">Baik</option>
                                            <option value="rusak_ringan">Rusak Ringan</option>
                                            <option value="rusak_berat">Rusak Berat</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Keterangan Kondisi</label>
                                        <textarea class="form-control" rows="3" placeholder="Jelaskan kondisi barang jika ada kerusakan..."></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Upload Foto Bukti <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="bukti-foto" accept="image/*" required>
                                        <small class="text-muted">Upload foto barang sebagai bukti pengembalian</small>
                                    </div>
                                    <div id="preview-foto" class="mt-2 d-none">
                                        <img id="preview-image" class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mt-3">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-info-circle text-info"></i>
                            </div>
                            <div>
                                <h6 class="text-info">Informasi Penting</h6>
                                <p class="mb-0 text-sm">• Pastikan barang dalam kondisi baik sebelum dikembalikan<br>
                                • Foto bukti diperlukan untuk dokumentasi<br>
                                • Barang yang rusak akan dikenakan sanksi sesuai ketentuan</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="form-pengembalian" class="btn bg-gradient-success">Konfirmasi Pengembalian</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Preview image upload
        document.getElementById('bukti-foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                    document.getElementById('preview-foto').classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        });

        // Event listener untuk form pengembalian
        document.getElementById('form-pengembalian').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validasi form
            const barang = document.getElementById('barang-dikembalikan').value;
            const mapel = document.getElementById('pengembalian-mapel').value;
            const ruangan = document.getElementById('pengembalian-ruangan').value;
            const kondisi = document.getElementById('kondisi-barang').value;
            const foto = document.getElementById('bukti-foto').files[0];
            
            if (!barang || !mapel || !ruangan || !kondisi || !foto) {
                showNotification('Harap lengkapi semua field yang wajib diisi', 'warning');
                return;
            }
            
            // Simulasi proses pengembalian
            showNotification('Pengembalian berhasil! Barang telah dikembalikan dan status diperbarui.', 'success');
            $('#pengembalianModal').modal('hide');
            
            // Reset form
            document.getElementById('form-pengembalian').reset();
            document.getElementById('preview-foto').classList.add('d-none');
        });
    });

    function kembalikanBarang(barangId) {
        // Set nilai dropdown berdasarkan barang yang dipilih
        document.getElementById('barang-dikembalikan').value = barangId;
        
        // Buka modal pengembalian
        $('#pengembalianModal').modal('show');
    }

    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(notification);
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 3000);
    }
</script>
@endsection

@section('footer')
    @include('be.footer')
@endsection