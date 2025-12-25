@extends('be.layout')

@php
  $title = 'Dashboard';
  $breadcrumb = 'Dashboard';
@endphp

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">
    
    <!-- Stats Cards Row -->
    <div class="row">
        <!-- Alat Tersedia -->
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Alat Tersedia</p>
                                <h5 class="font-weight-bolder mb-0">
                                    42
                                    <span class="text-success text-sm font-weight-bolder">+5%</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-screwdriver-wrench text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stok Bahan -->
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Stok Bahan</p>
                                <h5 class="font-weight-bolder mb-0">
                                    156
                                    <span class="text-warning text-sm font-weight-bolder">-2%</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                                <i class="fas fa-boxes-stacked text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peminjaman Aktif -->
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Peminjaman Aktif</p>
                                <h5 class="font-weight-bolder mb-0">
                                    18
                                    <span class="text-success text-sm font-weight-bolder">+12%</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                                <i class="fas fa-hand-holding-hand text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Transaksi</p>
                                <h5 class="font-weight-bolder mb-0">
                                    234
                                    <span class="text-success text-sm font-weight-bolder">+8%</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                <i class="fas fa-chart-line text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aksi Cepat -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Aksi Cepat</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row px-4 py-3">
                        <!-- Scan QR -->
                        <div class="col-lg-6 col-md-12 mb-3">
                            <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row hover-card">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md me-3">
                                    <i class="fas fa-qrcode text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Scan QR Barang</h6>
                                    <p class="text-sm mb-0">Mulai transaksi peminjaman atau pemakaian</p>
                                </div>
                                <button class="btn btn-primary btn-sm mb-0" id="scanNowBtn">
                                    <i></i> Scan Sekarang
                                </button>
                            </div>
                        </div>

                        <!-- Barang Masuk -->
                        <div class="col-lg-6 col-md-12 mb-3">
                            <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row hover-card">
                                <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md me-3">
                                    <i class="fas fa-plus-circle text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Barang Masuk</h6>
                                    <p class="text-sm mb-0">Input alat/bahan baru ke inventaris</p>
                                </div>
                                <button class="btn btn-success btn-sm mb-0" id="addItemBtn">
                                    <i></i> Tambah Barang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mt-4">
        <!-- Grafik Peminjaman -->
        <div class="col-lg-7 mb-4">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Statistik Peminjaman</h6>
                    <p class="text-sm">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">12% lebih banyak</span> dari minggu lalu
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chartPinjam" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Pemakaian -->
        <div class="col-lg-5 mb-4">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Pemakaian Bahan</h6>
                    <p class="text-sm">
                        <i class="fa fa-arrow-down text-danger"></i>
                        <span class="font-weight-bold">2% lebih sedikit</span> dari minggu lalu
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chartPakai" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Aktivitas Terbaru</h6>
                    <a href="#" class="btn btn-sm btn-outline-primary mb-0">Lihat Semua</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aktivitas</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Hari ini</h6>
                                                <p class="text-xs text-secondary mb-0">10:15</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">Andi Wijaya (XI RPL 2)</p>
                                        <p class="text-xs text-secondary mb-0">memakai bahan <strong>Timah Solder</strong>, jumlah 3 pcs</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Selesai</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Hari ini</h6>
                                                <p class="text-xs text-secondary mb-0">09:45</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">Budi Santoso (X TKJ 1)</p>
                                        <p class="text-xs text-secondary mb-0">meminjam alat <strong>Bor Mini (ALT-002)</strong></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-warning">Dipinjam</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Kemarin</h6>
                                                <p class="text-xs text-secondary mb-0">15:30</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">Budi Santoso</p>
                                        <p class="text-xs text-secondary mb-0">mengembalikan <strong>Bor Mini</strong></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-danger">Rusak</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Kemarin</h6>
                                                <p class="text-xs text-secondary mb-0">14:20</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">Citra Dewi (XII MM 1)</p>
                                        <p class="text-xs text-secondary mb-0">memakai bahan <strong>Kabel Jumper</strong>, jumlah 10 pcs</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Selesai</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">2 hari lalu</h6>
                                                <p class="text-xs text-secondary mb-0">11:00</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">Dedi Kurniawan (XI TKR 2)</p>
                                        <p class="text-xs text-secondary mb-0">meminjam alat <strong>Multimeter Digital (ALT-015)</strong></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Dikembalikan</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
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

@push('scripts')
<script>
    // Chart Configuration
    var ctx1 = document.getElementById("chartPinjam").getContext("2d");
    var ctx2 = document.getElementById("chartPakai").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

    new Chart(ctx1, {
        type: "line",
        data: {
            labels: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"],
            datasets: [{
                label: "Peminjaman",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#5e72e4",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: [5, 9, 6, 8, 10, 7, 12],
                maxBarThickness: 6
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#b2b9bf',
                        font: {
                            size: 11,
                            family: "Inter",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#b2b9bf',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Inter",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke2.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
    gradientStroke2.addColorStop(0, 'rgba(251, 99, 64, 0)');

    new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"],
            datasets: [{
                label: "Pemakaian",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#fb6340",
                backgroundColor: gradientStroke2,
                borderWidth: 3,
                fill: true,
                data: [3, 4, 5, 3, 6, 4, 5],
                maxBarThickness: 6
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#b2b9bf',
                        font: {
                            size: 11,
                            family: "Inter",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#b2b9bf',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Inter",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });

    // Button Actions
    document.getElementById('scanNowBtn').addEventListener('click', function() {
        alert('Fitur Scan QR akan segera tersedia!');
    });

    document.getElementById('addItemBtn').addEventListener('click', function() {
        alert('Fitur Tambah Barang akan segera tersedia!');
    });
</script>
@endpush
