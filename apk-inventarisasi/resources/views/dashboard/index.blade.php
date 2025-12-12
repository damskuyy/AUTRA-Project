@extends ('be.layout')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')

<div class="row mb-4">

    <!-- Stats: Alat -->
    <div class="col-4">
        <div class="card stats-card">
            <div class="stats-icon blue">
                <i class="fas fa-tools"></i>
            </div>
            <div class="stats-number">42</div>
            <div class="stats-label">Alat Tersedia</div>
        </div>
    </div>

    <!-- Stats: Bahan -->
    <div class="col-4">
        <div class="card stats-card">
            <div class="stats-icon orange">
                <i class="fas fa-box-open"></i>
            </div>
            <div class="stats-number">156</div>
            <div class="stats-label">Stok Bahan</div>
        </div>
    </div>

    <!-- Stats: Peminjaman -->
    <div class="col-4">
        <div class="card stats-card">
            <div class="stats-icon green">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="stats-number">18</div>
            <div class="stats-label">Peminjaman Aktif</div>
        </div>
    </div>
</div>

<!-- Aksi Cepat -->
<div class="card mb-4">
    <div class="card-header d-flex justify-between align-center">
        <h2 class="card-title">Aksi Cepat</h2>
    </div>

    <div class="row px-3 pb-3">

        <!-- Scan QR -->
        <div class="col-6">
            <div class="quick-action">
                <div class="quick-action-icon" style="background-color: rgba(67, 97, 238, 0.1); color: var(--primary);">
                    <i class="fas fa-qrcode fa-lg"></i>
                </div>

                <div class="quick-action-text">
                    <div class="quick-action-title">Scan QR Barang</div>
                    <div class="quick-action-sub">Mulai transaksi peminjaman atau pemakaian</div>
                </div>

                <button class="btn btn-primary ml-auto" id="scanNowBtn">Scan Sekarang</button>
            </div>
        </div>

        <!-- Barang Masuk -->
        <div class="col-6">
            <div class="quick-action">
                <div class="quick-action-icon" style="background-color: rgba(6, 214, 160, 0.1); color: var(--success);">
                    <i class="fas fa-arrow-circle-down fa-lg"></i>
                </div>

                <div class="quick-action-text">
                    <div class="quick-action-title">Barang Masuk</div>
                    <div class="quick-action-sub">Input alat/bahan baru ke inventaris</div>
                </div>

                <button class="btn btn-success ml-auto" id="addItemBtn">Tambah Barang</button>
            </div>
        </div>
    </div>
</div>

<!-- Aktivitas Terbaru -->
<div class="card">
    <div class="card-header d-flex justify-between align-center">
        <h2 class="card-title">Aktivitas Terbaru</h2>
        <a href="#" class="link-primary fw-500">Lihat Semua</a>
    </div>

    <div class="timeline p-3">

        <div class="timeline-item">
            <div class="timeline-time">Hari ini, 10:15</div>
            <div class="timeline-content">
                <strong>Andi Wijaya (XI RPL 2)</strong> memakai bahan <strong>Timah Solder</strong>, jumlah 3 pcs
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-time">Hari ini, 09:45</div>
            <div class="timeline-content">
                <strong>Budi Santoso (X TKJ 1)</strong> meminjam alat <strong>Bor Mini (ALT-002)</strong>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-time">Kemarin, 15:30</div>
            <div class="timeline-content">
                <strong>Budi Santoso</strong> mengembalikan <strong>Bor Mini</strong>, kondisi 
                <span class="badge badge-danger">rusak</span>
            </div>
        </div>

    </div>
</div>

@endsection

@section('footer')
    @include('be.footer')
@endsection
