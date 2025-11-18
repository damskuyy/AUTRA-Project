@extends('be.layout')

@section('title', 'Peminjaman - Sistem Inventaris')

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
                            <h6>Peminjaman Barang</h6>
                            <p class="text-sm mb-0">Proses peminjaman inventaris sekolah</p>
                        </div>
                        <div class="d-flex">
                            <button class="btn btn-sm btn-outline-primary me-2" onclick="history.back()">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </button>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#singlePeminjamanModal">
                                <i class="fas fa-plus me-1"></i> Pinjam Single Barang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Multi-Barang Process -->
    <div class="row" id="multi-barang-process">
        <!-- Step 1: Keranjang -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Step 1: Keranjang Peminjaman</h6>
                        <span class="badge bg-gradient-primary">Multi-Barang</span>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div id="cart-empty" class="text-center py-4">
                        <i class="fas fa-shopping-cart text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-2 mb-0">Keranjang masih kosong</p>
                        <p class="text-sm text-muted">Silakan pilih barang dari halaman inventaris</p>
                        <a href="{{ url('/inventaris') }}" class="btn btn-sm bg-gradient-primary mt-2">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Inventaris
                        </a>
                    </div>
                    <div id="cart-items" class="d-none">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Barang</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stok</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="cart-table-body">
                                    <!-- Items will be populated by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                <span class="text-sm">Total Item: <span class="fw-bold" id="total-items">0</span></span>
                            </div>
                            <button class="btn bg-gradient-success mb-0" id="proceed-to-form">
                                <i class="fas fa-clipboard-check me-1"></i> Lanjut ke Form Peminjaman
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 2: Form Peminjaman -->
        <div class="col-12 mb-4 d-none" id="form-peminjaman-step">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Step 2: Form Peminjaman</h6>
                        <span class="badge bg-gradient-info">Menunggu Pengisian</span>
                    </div>
                </div>
                <div class="card-body p-3">
                    <form id="peminjaman-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Data Peminjam</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Siswa</label>
                                            <input type="text" class="form-control" value="Ahmad Rizki" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kelas</label>
                                            <input type="text" class="form-control" value="XII IPA 1" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                                            <select class="form-control" id="mata-pelajaran" required>
                                                <option value="">Pilih Mata Pelajaran</option>
                                                <option value="Fisika">Fisika</option>
                                                <option value="Kimia">Kimia</option>
                                                <option value="Biologi">Biologi</option>
                                                <option value="Matematika">Matematika</option>
                                                <option value="Informatika">Informatika</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Detail Peminjaman</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Ruangan <span class="text-danger">*</span></label>
                                            <select class="form-control" id="ruangan" required>
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Lab Komputer 1">Lab Komputer 1</option>
                                                <option value="Lab Komputer 2">Lab Komputer 2</option>
                                                <option value="Lab IPA">Lab IPA</option>
                                                <option value="Ruang Guru">Ruang Guru</option>
                                                <option value="Kelas XII IPA 1">Kelas XII IPA 1</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Waktu Pinjam <span class="text-danger">*</span></label>
                                            <input type="datetime-local" class="form-control" id="waktu-pinjam" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Waktu Kembali <span class="text-danger">*</span></label>
                                            <input type="datetime-local" class="form-control" id="waktu-kembali" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mt-4">
                            <div class="card-header">
                                <h6 class="mb-0">Detail Barang Dipinjam</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stok Tersedia</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah Dipinjam</th>
                                            </tr>
                                        </thead>
                                        <tbody id="form-items-table">
                                            <!-- Items will be populated by JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    <label class="form-label">Keterangan Tambahan</label>
                                    <textarea class="form-control" rows="3" placeholder="Tambahkan keterangan jika diperlukan..."></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary" id="back-to-cart">
                                <i class="fas fa-arrow-left me-1"></i> Kembali ke Keranjang
                            </button>
                            <button type="submit" class="btn bg-gradient-success">
                                <i class="fas fa-paper-plane me-1"></i> Ajukan Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Step 3: OTP dan Konfirmasi -->
        <div class="col-12 mb-4 d-none" id="otp-confirmation-step">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Step 3: Kode OTP dan Konfirmasi</h6>
                        <span class="badge bg-gradient-warning">Menunggu Persetujuan</span>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row justify-content-center">
                        <div class="col-md-8 text-center">
                            <div class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-lg mb-4">
                                <i class="fas fa-shield-alt text-white opacity-10"></i>
                            </div>
                            <h4 class="text-gradient text-success mb-3">Peminjaman Berhasil Diajukan!</h4>
                            <p class="mb-4">Tunjukkan kode OTP berikut kepada guru/admin untuk konfirmasi peminjaman:</p>
                            
                            <div class="card bg-gradient-dark mb-4">
                                <div class="card-body py-4">
                                    <h1 class="text-white mb-2 otp-code" id="otp-code">- - - - - -</h1>
                                    <p class="text-white text-sm mb-0">Kode OTP berlaku selama <span id="countdown">10:00</span> menit</p>
                                </div>
                            </div>
                            
                            <div class="alert alert-info text-start">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <i class="fas fa-info-circle text-info"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-info">Informasi Penting</h6>
                                        <p class="mb-0 text-sm">• Notifikasi telah dikirim ke guru/admin<br>
                                        • Tunjukkan kode OTP ini saat mengambil barang<br>
                                        • Kode akan expired dalam 10 menit<br>
                                        • Status peminjaman dapat dicek di menu Riwayat</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-center gap-3 mt-4">
                                <button class="btn btn-outline-primary" onclick="printOTP()">
                                    <i class="fas fa-print me-1"></i> Cetak OTP
                                </button>
                                <button class="btn bg-gradient-primary" id="copy-otp">
                                    <i class="fas fa-copy me-1"></i> Salin OTP
                                </button>
                                <a href="{{ url('/inventaris') }}" class="btn bg-gradient-success">
                                    <i class="fas fa-check me-1"></i> Selesai
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Peminjaman Aktif -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Peminjaman Aktif</h6>
                        <a href="{{ url('/peminjaman/riwayat') }}" class="btn btn-sm btn-outline-primary">Lihat Riwayat</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">OTP</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">PMJ-001</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Laptop, Monitor</p>
                                        <p class="text-xs text-secondary mb-0">3 unit</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">16 Mar 2024</p>
                                        <p class="text-xs text-secondary mb-0">08:00 - 10:00</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-warning">Menunggu</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 otp-code">1 2 3 4 5 6</p>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-sm btn-outline-danger mb-0">
                                            Batalkan
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">PMJ-002</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Mikroskop</p>
                                        <p class="text-xs text-secondary mb-0">1 unit</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">15 Mar 2024</p>
                                        <p class="text-xs text-secondary mb-0">10:00 - 12:00</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-success">Disetujui</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 otp-code">7 8 9 0 1 2</p>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-sm bg-gradient-success mb-0">
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
</div>

<!-- Modal Single Peminjaman -->
<div class="modal fade" id="singlePeminjamanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Peminjaman Single Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6 mb-4">
                        <div class="card card-blog card-plain border hover-card text-center">
                            <div class="card-body p-4">
                                <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg mb-3">
                                    <i class="fas fa-barcode text-white opacity-10"></i>
                                </div>
                                <h5 class="text-dark mb-3">Dengan Barcode</h5>
                                <p class="mb-4">Scan barcode barang menggunakan kamera perangkat</p>
                                <button class="btn bg-gradient-primary mb-0" data-bs-toggle="modal" data-bs-target="#barcodeModal">
                                    <i class="fas fa-camera me-1"></i> Scan Barcode
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-5 col-md-6 mb-4">
                        <div class="card card-blog card-plain border hover-card text-center">
                            <div class="card-body p-4">
                                <div class="icon icon-shape icon-lg bg-gradient-info shadow text-center border-radius-lg mb-3">
                                    <i class="fas fa-keyboard text-white opacity-10"></i>
                                </div>
                                <h5 class="text-dark mb-3">Dengan Kode Manual</h5>
                                <p class="mb-4">Input kode barang secara manual</p>
                                <button class="btn bg-gradient-info mb-0" data-bs-toggle="modal" data-bs-target="#manualModal">
                                    <i class="fas fa-keyboard me-1"></i> Input Kode
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Barcode -->
<div class="modal fade" id="barcodeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Peminjaman dengan Barcode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Data Peminjaman</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control" value="Ahmad Rizki" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kelas</label>
                                    <input type="text" class="form-control" value="XII IPA 1" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mata Pelajaran</label>
                                    <select class="form-control">
                                        <option value="">Pilih Mata Pelajaran</option>
                                        <option value="Fisika">Fisika</option>
                                        <option value="Kimia">Kimia</option>
                                        <option value="Biologi">Biologi</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ruangan</label>
                                    <select class="form-control">
                                        <option value="">Pilih Ruangan</option>
                                        <option value="Lab Komputer 1">Lab Komputer 1</option>
                                        <option value="Lab IPA">Lab IPA</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Scan Barcode</h6>
                            </div>
                            <div class="card-body text-center">
                                <div id="barcode-scanner" class="border rounded p-4 mb-3" style="height: 200px; background: #f8f9fa;">
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <div class="text-center">
                                            <i class="fas fa-camera text-muted" style="font-size: 3rem;"></i>
                                            <p class="text-muted mt-2 mb-0">Kamera siap untuk scan</p>
                                            <button class="btn btn-sm btn-primary mt-2" onclick="startBarcodeScanner()">
                                                <i class="fas fa-play me-1"></i> Aktifkan Kamera
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-muted mb-0">Arahkan kamera ke barcode barang</p>
                                
                                <div class="card mt-3 d-none" id="scanned-item">
                                    <div class="card-body">
                                        <h6 class="mb-2" id="scanned-item-name">-</h6>
                                        <p class="text-sm mb-1" id="scanned-item-type">-</p>
                                        <p class="text-sm mb-0">Stok: <span id="scanned-item-stock" class="badge bg-success">-</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn bg-gradient-success" id="submit-barcode">Ajukan Peminjaman</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Manual -->
<div class="modal fade" id="manualModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Peminjaman dengan Kode Manual</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Data Peminjaman</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control" value="Ahmad Rizki" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kelas</label>
                                    <input type="text" class="form-control" value="XII IPA 1" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mata Pelajaran</label>
                                    <select class="form-control" id="manual-mapel">
                                        <option value="">Pilih Mata Pelajaran</option>
                                        <option value="Fisika">Fisika</option>
                                        <option value="Kimia">Kimia</option>
                                        <option value="Biologi">Biologi</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ruangan</label>
                                    <select class="form-control" id="manual-ruangan">
                                        <option value="">Pilih Ruangan</option>
                                        <option value="Lab Komputer 1">Lab Komputer 1</option>
                                        <option value="Lab IPA">Lab IPA</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Input Kode Barang</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Kode Barang</label>
                                    <input type="text" class="form-control" placeholder="Masukkan kode barang" id="kode-barang">
                                </div>
                                <button class="btn bg-gradient-primary w-100" id="cari-barang">
                                    <i class="fas fa-search me-1"></i> Cari Barang
                                </button>
                                
                                <div class="card mt-3 d-none" id="barang-info">
                                    <div class="card-body">
                                        <h6 class="mb-2" id="nama-barang">-</h6>
                                        <p class="text-sm mb-1" id="jenis-barang">-</p>
                                        <p class="text-sm mb-0">Stok: <span id="stok-barang" class="badge bg-success">-</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn bg-gradient-success" id="submit-manual">Ajukan Peminjaman</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data dummy untuk keranjang (simulasi dari halaman inventaris)
        let cart = JSON.parse(localStorage.getItem('inventoryCart')) || {};

        // Data dummy stok barang
        const stockData = {
            1: { nama: 'Laptop', stok: 15, kategori: 'elektronik' },
            2: { nama: 'Monitor', stok: 8, kategori: 'elektronik' },
            3: { nama: 'Keyboard', stok: 20, kategori: 'elektronik' },
            4: { nama: 'Proyektor', stok: 0, kategori: 'elektronik' },
            6: { nama: 'Mikroskop', stok: 12, kategori: 'alat_lab' },
            7: { nama: 'Tabung Reaksi', stok: 5, kategori: 'bahan_kimia' },
            8: { nama: 'Beker Gelas', stok: 25, kategori: 'alat_lab' }
        };

        // Mapping kode barang
        const kodeBarangMap = {
            'LP001': 1,
            'MN002': 2,
            'KB003': 3,
            'PJ004': 4,
            'MK006': 6,
            'TR007': 7,
            'BG008': 8
        };

        // Inisialisasi tampilan
        updateCartDisplay();
        
        // Fungsi untuk memperbarui tampilan keranjang
        function updateCartDisplay() {
            const cartEmpty = document.getElementById('cart-empty');
            const cartItems = document.getElementById('cart-items');
            const cartTableBody = document.getElementById('cart-table-body');
            const totalItemsElement = document.getElementById('total-items');
            const formItemsTable = document.getElementById('form-items-table');
            
            cartTableBody.innerHTML = '';
            formItemsTable.innerHTML = '';
            
            let totalItems = 0;
            
            for (const itemId in cart) {
                const item = stockData[itemId];
                if (item) {
                    totalItems += cart[itemId];
                    // Table untuk keranjang
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                    <div class="icon icon-shape icon-sm bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="fas fa-box text-white opacity-10"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-center ms-4">
                                    <h6 class="mb-0 text-sm">${item.nama}</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-sm ${item.stok > 5 ? 'bg-gradient-success' : item.stok > 0 ? 'bg-gradient-warning' : 'bg-gradient-danger'}">${item.stok}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-outline-primary btn-xs px-2 py-1 me-1" onclick="updateQuantity(${itemId}, -1)">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="mx-2 fw-bold">${cart[itemId]}</span>
                                <button class="btn btn-outline-primary btn-xs px-2 py-1 ms-1" onclick="updateQuantity(${itemId}, 1)">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-danger" onclick="removeFromCart(${itemId})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    cartTableBody.appendChild(tr);

                    // Table untuk form
                    const formTr = document.createElement('tr');
                    formTr.innerHTML = `
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">${item.nama}</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-sm ${item.stok > 5 ? 'bg-gradient-success' : item.stok > 0 ? 'bg-gradient-warning' : 'bg-gradient-danger'}">${item.stok}</span>
                        </td>
                        <td>
                            <span class="text-sm fw-bold">${cart[itemId]} unit</span>
                        </td>
                    `;
                    formItemsTable.appendChild(formTr);
                }
            }
            
            totalItemsElement.textContent = totalItems;
            
            if (totalItems > 0) {
                cartEmpty.classList.add('d-none');
                cartItems.classList.remove('d-none');
            } else {
                cartEmpty.classList.remove('d-none');
                cartItems.classList.add('d-none');
            }
        }
        
        // Fungsi untuk memperbarui jumlah barang
        window.updateQuantity = function(itemId, change) {
            const currentQty = cart[itemId] || 0;
            const item = stockData[itemId];
            
            if (!item) return;

            const newQty = currentQty + change;
            
            if (newQty >= 0 && newQty <= item.stok) {
                if (newQty === 0) {
                    delete cart[itemId];
                } else {
                    cart[itemId] = newQty;
                }
                localStorage.setItem('inventoryCart', JSON.stringify(cart));
                updateCartDisplay();
            } else if (newQty > item.stok) {
                showNotification(`Stok ${item.nama} hanya tersedia ${item.stok} unit`, 'warning');
            }
        }
        
        // Fungsi untuk menghapus barang dari keranjang
        window.removeFromCart = function(itemId) {
            delete cart[itemId];
            localStorage.setItem('inventoryCart', JSON.stringify(cart));
            updateCartDisplay();
            showNotification('Item dihapus dari keranjang', 'info');
        }
        
        // Event listener untuk tombol lanjut ke form
        document.getElementById('proceed-to-form').addEventListener('click', function() {
            document.getElementById('form-peminjaman-step').classList.remove('d-none');
            document.getElementById('form-peminjaman-step').scrollIntoView({ behavior: 'smooth' });
        });
        
        // Event listener untuk tombol kembali ke keranjang
        document.getElementById('back-to-cart').addEventListener('click', function() {
            document.getElementById('form-peminjaman-step').classList.add('d-none');
        });
        
        // Event listener untuk form peminjaman
        document.getElementById('peminjaman-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validasi form
            const mataPelajaran = document.getElementById('mata-pelajaran').value;
            const ruangan = document.getElementById('ruangan').value;
            const waktuPinjam = document.getElementById('waktu-pinjam').value;
            const waktuKembali = document.getElementById('waktu-kembali').value;
            
            if (!mataPelajaran || !ruangan || !waktuPinjam || !waktuKembali) {
                showNotification('Harap lengkapi semua field yang wajib diisi', 'warning');
                return;
            }
            
            // Generate OTP
            const otp = generateOTP();
            document.getElementById('otp-code').textContent = otp;
            
            // Tampilkan step OTP
            document.getElementById('form-peminjaman-step').classList.add('d-none');
            document.getElementById('otp-confirmation-step').classList.remove('d-none');
            document.getElementById('otp-confirmation-step').scrollIntoView({ behavior: 'smooth' });
            
            // Start countdown
            startCountdown(10 * 60); // 10 menit
            
            // Simpan data peminjaman
            const peminjamanData = {
                items: cart,
                mataPelajaran: mataPelajaran,
                ruangan: ruangan,
                waktuPinjam: waktuPinjam,
                waktuKembali: waktuKembali,
                otp: otp,
                timestamp: new Date().toISOString()
            };
            
            localStorage.setItem('lastPeminjaman', JSON.stringify(peminjamanData));
            
            // Kosongkan keranjang
            cart = {};
            localStorage.setItem('inventoryCart', JSON.stringify(cart));
            
            showNotification('Peminjaman berhasil diajukan! OTP telah dikirim ke guru/admin', 'success');
        });
        
        // Fungsi untuk generate OTP
        function generateOTP() {
            return Math.floor(100000 + Math.random() * 900000).toString().split('').join(' ');
        }
        
        // Fungsi untuk countdown OTP
        function startCountdown(duration) {
            let timer = duration, minutes, seconds;
            const countdownElement = document.getElementById('countdown');
            
            const interval = setInterval(function() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);
                
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                
                countdownElement.textContent = minutes + ":" + seconds;
                
                if (--timer < 0) {
                    clearInterval(interval);
                    countdownElement.textContent = "00:00";
                    showNotification('Kode OTP telah expired', 'warning');
                }
            }, 1000);
        }
        
        // Fungsi untuk copy OTP
        document.getElementById('copy-otp').addEventListener('click', function() {
            const otpText = document.getElementById('otp-code').textContent.replace(/\s/g, '');
            navigator.clipboard.writeText(otpText).then(function() {
                showNotification('Kode OTP berhasil disalin', 'success');
            });
        });
        
        // Fungsi untuk print OTP
        window.printOTP = function() {
            const printContent = `
                <div style="text-align: center; padding: 20px;">
                    <h2>Kode OTP Peminjaman</h2>
                    <h1 style="font-size: 48px; letter-spacing: 10px; margin: 20px 0;">${document.getElementById('otp-code').textContent}</h1>
                    <p>Berlaku hingga: ${document.getElementById('countdown').textContent} menit</p>
                    <p><small>${new Date().toLocaleString()}</small></p>
                </div>
            `;
            
            const printWindow = window.open('', '_blank');
            printWindow.document.write(printContent);
            printWindow.document.close();
            printWindow.print();
        }

        // Fungsi untuk mencari barang dengan kode manual
        document.getElementById('cari-barang').addEventListener('click', function() {
            const kodeBarang = document.getElementById('kode-barang').value.toUpperCase();
            const barangInfo = document.getElementById('barang-info');
            
            if (!kodeBarang) {
                showNotification('Masukkan kode barang terlebih dahulu', 'warning');
                return;
            }
            
            const itemId = kodeBarangMap[kodeBarang];
            
            if (itemId && stockData[itemId]) {
                const item = stockData[itemId];
                document.getElementById('nama-barang').textContent = item.nama;
                document.getElementById('jenis-barang').textContent = getJenisBarang(item.kategori);
                document.getElementById('stok-barang').textContent = item.stok;
                document.getElementById('stok-barang').className = `badge ${item.stok > 0 ? 'bg-success' : 'bg-danger'}`;
                barangInfo.classList.remove('d-none');
                showNotification('Barang ditemukan', 'success');
            } else {
                barangInfo.classList.add('d-none');
                showNotification('Kode barang tidak ditemukan', 'error');
            }
        });

        // Fungsi untuk mendapatkan jenis barang
        function getJenisBarang(kategori) {
            const jenis = {
                'elektronik': 'Elektronik',
                'alat_lab': 'Alat Laboratorium',
                'bahan_kimia': 'Bahan Kimia',
                'perlengkapan': 'Perlengkapan'
            };
            return jenis[kategori] || 'Lainnya';
        }

        // Simulasi barcode scanner
        window.startBarcodeScanner = function() {
            const scanner = document.getElementById('barcode-scanner');
            scanner.innerHTML = `
                <div class="text-center">
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-muted mb-3">Mengaktifkan kamera...</p>
                    <p class="text-sm text-muted">Arahkan kamera ke barcode barang</p>
                </div>
            `;

            // Simulasi scan setelah 2 detik
            setTimeout(() => {
                // Random item untuk simulasi
                const randomItems = [1, 2, 6, 8];
                const itemId = randomItems[Math.floor(Math.random() * randomItems.length)];
                const item = stockData[itemId];
                
                scanner.innerHTML = `
                    <div class="text-center">
                        <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                        <p class="text-success mt-2 mb-0">Barang berhasil di-scan!</p>
                    </div>
                `;
                
                document.getElementById('scanned-item-name').textContent = item.nama;
                document.getElementById('scanned-item-type').textContent = getJenisBarang(item.kategori);
                document.getElementById('scanned-item-stock').textContent = item.stok;
                document.getElementById('scanned-item-stock').className = `badge ${item.stok > 0 ? 'bg-success' : 'bg-danger'}`;
                document.getElementById('scanned-item').classList.remove('d-none');
                
                showNotification(`${item.nama} berhasil di-scan`, 'success');
            }, 2000);
        }

        // Submit barcode peminjaman
        document.getElementById('submit-barcode').addEventListener('click', function() {
            const scannedItem = document.getElementById('scanned-item');
            if (scannedItem.classList.contains('d-none')) {
                showNotification('Scan barang terlebih dahulu', 'warning');
                return;
            }
            
            const mapel = document.querySelector('#barcodeModal select').value;
            const ruangan = document.querySelectorAll('#barcodeModal select')[1].value;
            
            if (!mapel || !ruangan) {
                showNotification('Lengkapi data peminjaman terlebih dahulu', 'warning');
                return;
            }
            
            showNotification('Peminjaman single barang berhasil diajukan', 'success');
            $('#barcodeModal').modal('hide');
            $('#singlePeminjamanModal').modal('hide');
        });

        // Submit manual peminjaman
        document.getElementById('submit-manual').addEventListener('click', function() {
            const barangInfo = document.getElementById('barang-info');
            if (barangInfo.classList.contains('d-none')) {
                showNotification('Cari barang terlebih dahulu', 'warning');
                return;
            }
            
            const mapel = document.getElementById('manual-mapel').value;
            const ruangan = document.getElementById('manual-ruangan').value;
            
            if (!mapel || !ruangan) {
                showNotification('Lengkapi data peminjaman terlebih dahulu', 'warning');
                return;
            }
            
            showNotification('Peminjaman single barang berhasil diajukan', 'success');
            $('#manualModal').modal('hide');
            $('#singlePeminjamanModal').modal('hide');
        });
        
        // Fungsi untuk menampilkan notifikasi
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
    });
</script>
@endsection

@section('footer')
    @include('be.footer')
@endsection