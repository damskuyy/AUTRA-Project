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

    {{-- HEADER --}}
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">Riwayat Aktivitas</h4>
            <p class="text-muted small">Semua aktivitas dicatat sebagai log transaksi</p>
        </div>
    </div>

    {{-- FILTER --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h6 class="mb-0"><i class="fas fa-filter me-2"></i>Filter Riwayat</h6>
        </div>
        <div class="card-body">

            <div class="row g-3">

                {{-- Rentang tanggal --}}
                <div class="col-md-3">
                    <label class="form-label">Dari Tanggal</label>
                    <input type="date" class="form-control">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Sampai Tanggal</label>
                    <input type="date" class="form-control">
                </div>

                {{-- Nama siswa --}}
                <div class="col-md-3">
                    <label class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" placeholder="Cari nama siswa...">
                </div>

                {{-- Kelas --}}
                <div class="col-md-3">
                    <label class="form-label">Kelas</label>
                    <select class="form-control">
                        <option>Semua</option>
                        <option>X TKJ 1</option>
                        <option>XI RPL 2</option>
                        <option>XII RPL 3</option>
                    </select>
                </div>

                {{-- Jenis Transaksi --}}
                <div class="col-md-4">
                    <label class="form-label">Jenis Transaksi</label>
                    <select class="form-control">
                        <option>Semua</option>
                        <option>Pemasukan Barang/Bahan</option>
                        <option>Pemakaian Bahan</option>
                        <option>Peminjaman Alat</option>
                        <option>Pengembalian Alat</option>
                        <option>Kerusakan Alat</option>
                        <option>Banned Siswa</option>
                    </select>
                </div>

                {{-- Nama Barang --}}
                <div class="col-md-4">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" placeholder="Cari barang...">
                </div>

                {{-- Tombol Filter --}}
                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-primary w-100">
                        <i class="fas fa-search me-1"></i> Terapkan Filter
                    </button>
                </div>

            </div>

        </div>
    </div>

    {{-- EXPORT --}}
    <div class="mb-4 d-flex gap-2">
        <button class="btn btn-danger">
            <i class="fas fa-file-pdf me-1"></i> Export PDF
        </button>
        <button class="btn btn-success">
            <i class="fas fa-file-excel me-1"></i> Export Excel
        </button>
    </div>

    {{-- TIMELINE LOG --}}
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h6 class="mb-0"><i class="fas fa-clock me-2"></i>Log Riwayat Aktivitas</h6>
        </div>

        <div class="card-body">

            <ul class="list-group list-group-flush">

                {{-- 1. Contoh Log: Pemakaian Bahan --}}
                <li class="list-group-item py-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong>[10:15]</strong>
                            <span class="ms-1 fw-bold text-primary">Andi (XI RPL 2)</span>
                            <span class="text-muted">memakai bahan</span>
                            <span class="fw-bold">Timah Solder</span>,
                            jumlah <span class="fw-bold text-danger">3 pcs</span>
                        </div>
                        <div class="text-muted small">Diproses oleh Admin A</div>
                    </div>
                </li>

                {{-- 2. Contoh Log: Peminjaman --}}
                <li class="list-group-item py-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong>[11:00]</strong>
                            <span class="ms-1 fw-bold text-primary">Budi (X TKJ 1)</span>
                            <span class="text-muted">meminjam alat</span>
                            <span class="fw-bold">Bor Mini</span> (ALT-002)
                        </div>
                        <div class="text-muted small">Diproses oleh Admin B</div>
                    </div>
                </li>

                {{-- 3. Contoh Log: Pengembalian Alat --}}
                <li class="list-group-item py-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong>[15:30]</strong>
                            <span class="ms-1 fw-bold text-primary">Budi</span>
                            <span class="text-muted">mengembalikan</span>
                            <span class="fw-bold">Bor Mini</span>,
                            kondisi <span class="fw-bold text-danger">Rusak</span>
                        </div>
                        <div class="text-muted small">Diproses oleh Admin C</div>
                    </div>
                </li>

                {{-- 4. Contoh Log: Kerusakan --}}
                <li class="list-group-item py-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong>[16:00]</strong>
                            <span class="fw-bold text-danger">Kerusakan alat</span>:
                            Multimeter Digital (ALT-011)
                        </div>
                        <div class="text-muted small">Dilaporkan oleh Admin A</div>
                    </div>
                </li>

                {{-- 5. Contoh Log: Banned Siswa --}}
                <li class="list-group-item py-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong>[16:30]</strong>
                            <span class="fw-bold text-danger">Siswa DIBANNED:</span>
                            Budi (X TKJ 1)
                        </div>
                        <div class="text-muted small">Diproses oleh Admin A</div>
                    </div>
                </li>

            </ul>

        </div>
    </div>

</div>
@endsection

@section('footer')
    @include('be.footer')
@endsection