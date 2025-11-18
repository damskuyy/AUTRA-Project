@extends('be.layout')

@section('title', 'Dashboard - Sistem Inventaris')

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
                            <h6>Dashboard Siswa</h6>
                            <p class="text-sm mb-0">Selamat datang, Ahmad Rizki (XII IPA 1)</p>
                        </div>
                        <div class="d-flex">
                            <span class="badge bg-gradient-success me-2">Status: Aktif</span>
                            <span class="badge bg-gradient-info">Kelas: XII IPA 1</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Peminjaman</p>
                                <h5 class="font-weight-bolder mb-0">5 Active</h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+2 baru</span>
                                    minggu ini
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="fas fa-clipboard-list text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('/peminjaman') }}" class="btn btn-sm bg-gradient-primary w-100 mt-3">
                        <i class="fas fa-arrow-right me-1"></i> Klik di sini
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Pemakaian</p>
                                <h5 class="font-weight-bolder mb-0">3 Active</h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+1 baru</span>
                                    hari ini
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="fas fa-vial text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('/pemakaian') }}" class="btn btn-sm bg-gradient-success w-100 mt-3">
                        <i class="fas fa-arrow-right me-1"></i> Klik di sini
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Pengembalian</p>
                                <h5 class="font-weight-bolder mb-0">2 Pending</h5>
                                <p class="mb-0">
                                    <span class="text-warning text-sm font-weight-bolder">Due soon</span>
                                    besok
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="fas fa-undo text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('/pengembalian') }}" class="btn btn-sm bg-gradient-warning w-100 mt-3">
                        <i class="fas fa-arrow-right me-1"></i> Klik di sini
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Inventaris</p>
                                <h5 class="font-weight-bolder mb-0">45+ Items</h5>
                                <p class="mb-0">
                                    <span class="text-info text-sm font-weight-bolder">Available</span>
                                    untuk dipinjam
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                <i class="fas fa-boxes text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('/inventaris') }}" class="btn btn-sm bg-gradient-info w-100 mt-3">
                        <i class="fas fa-arrow-right me-1"></i> Klik di sini
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Peminjaman Terbaru -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Riwayat Peminjaman Terbaru</h6>
                        <a href="{{ url('/peminjaman/riwayat') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ruangan</th>
                                    <th class="text-secondary opacity-7"></th>
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
                                                <p class="text-xs text-secondary mb-0">2 unit</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">15 Mar 2024</p>
                                        <p class="text-xs text-secondary mb-0">08:00 - 10:00</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-success">Selesai</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Lab Komputer 1</p>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
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
                                                <p class="text-xs text-secondary mb-0">1 unit</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">14 Mar 2024</p>
                                        <p class="text-xs text-secondary mb-0">10:00 - 12:00</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-warning">Disetujui</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Lab IPA</p>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
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

    <!-- Riwayat Pemakaian Terbaru -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Riwayat Pemakaian Terbaru</h6>
                        <a href="{{ url('/pemakaian/riwayat') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bahan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mapel</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Tabung Reaksi</h6>
                                                <p class="text-xs text-secondary mb-0">Bahan Kimia</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">5 pcs</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">15 Mar 2024</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-success">Disetujui</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Kimia</p>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Beker Gelas</h6>
                                                <p class="text-xs text-secondary mb-0">Alat Lab</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">3 pcs</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">14 Mar 2024</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-warning">Menunggu</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Fisika</p>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
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
@endsection

@section('footer')
    @include('be.footer')
@endsection