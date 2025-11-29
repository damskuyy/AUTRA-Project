@extends('be.layout')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')

@section('main')
<div class="container-fluid py-4">
    <!-- Header Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Dashboard Admin</h6>
                            <p class="text-sm mb-0">Selamat datang, Admin! - Sistem Manajemen Inventaris Sekolah</p>
                        </div>
                        <div class="d-flex">
                            <button class="btn btn-sm btn-outline-primary me-2" onclick="refreshDashboard()">
                                <i class="fas fa-sync-alt me-1"></i> Refresh
                            </button>
                            <button class="btn btn-sm btn-primary" onclick="generateReport()">
                                <i class="fas fa-download me-1"></i> Generate Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Utama -->
    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Alat & Bahan Tersedia</p>
                                <h5 class="font-weight-bolder mb-0" id="total-tersedia">156</h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+12</span>
                                    dari bulan lalu
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="fas fa-boxes text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-sm bg-gradient-primary w-100" onclick="viewAvailableItems()">
                            <i class="fas fa-eye me-1"></i> Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Sedang Dipinjam</p>
                                <h5 class="font-weight-bolder mb-0" id="total-dipinjam">23</h5>
                                <p class="mb-0">
                                    <span class="text-warning text-sm font-weight-bolder">5 overdue</span>
                                    perlu perhatian
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="fas fa-clipboard-list text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-sm bg-gradient-warning w-100" onclick="viewBorrowedItems()">
                            <i class="fas fa-list me-1"></i> Kelola Peminjaman
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Barang Rusak/Hilang</p>
                                <h5 class="font-weight-bolder mb-0" id="total-rusak">8</h5>
                                <p class="mb-0">
                                    <span class="text-danger text-sm font-weight-bolder">3 baru</span>
                                    perlu tindakan
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="fas fa-exclamation-triangle text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-sm bg-gradient-danger w-100" onclick="viewDamagedItems()">
                            <i class="fas fa-tools me-1"></i> Tindak Lanjuti
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card hover-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Siswa/Kelas Diblokir</p>
                                <h5 class="font-weight-bolder mb-0" id="total-diblokir">2</h5>
                                <p class="mb-0">
                                    <span class="text-info text-sm font-weight-bolder">1 kelas</span>
                                    XII IPA 3
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                <i class="fas fa-ban text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-sm bg-gradient-info w-100" onclick="viewBlockedUsers()">
                            <i class="fas fa-users me-1"></i> Kelola Blokir
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Grafik Statistik & Notifikasi -->
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Statistik Aktivitas Terkini</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-filter me-1"></i> Periode
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="changeChartPeriod('week')">Minggu Ini</a></li>
                                <li><a class="dropdown-item" href="#" onclick="changeChartPeriod('month')">Bulan Ini</a></li>
                                <li><a class="dropdown-item" href="#" onclick="changeChartPeriod('year')">Tahun Ini</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="activityChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifikasi Terbaru -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Notifikasi Terbaru</h6>
                        <button class="btn btn-sm btn-outline-primary" onclick="markAllAsRead()">
                            <i class="fas fa-check-double me-1"></i> Tandai Semua
                        </button>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="list-group list-group-flush" id="notification-list">
                        <!-- Notifications will be populated by JavaScript -->
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-sm btn-outline-primary w-100" onclick="viewAllNotifications()">
                            <i class="fas fa-bell me-1"></i> Lihat Semua Notifikasi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengajuan Pending & Quick Actions -->
    <div class="row mt-4">
        <!-- Pengajuan Peminjaman Pending -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Pengajuan Peminjaman Pending</h6>
                        <span class="badge bg-gradient-warning" id="pending-borrow-count">5</span>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Siswa</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Waktu</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="pending-borrow-table">
                                <!-- Pending borrow requests will be populated by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-sm bg-gradient-warning w-100" onclick="viewAllPendingBorrows()">
                            <i class="fas fa-clipboard-list me-1"></i> Lihat Semua Pengajuan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengajuan Pemakaian Pending -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Pengajuan Pemakaian Pending</h6>
                        <span class="badge bg-gradient-info" id="pending-usage-count">3</span>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Siswa</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bahan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="pending-usage-table">
                                <!-- Pending usage requests will be populated by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-sm bg-gradient-info w-100" onclick="viewAllPendingUsages()">
                            <i class="fas fa-vial me-1"></i> Lihat Semua Pengajuan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & System Overview -->
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Quick Actions</h6>
                    <p class="text-sm mb-0">Akses cepat ke fitur utama sistem</p>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-3 col-6 mb-3">
                            <button class="btn bg-gradient-primary w-100 h-100 p-3 d-flex flex-column align-items-center justify-content-center" onclick="manageInventory()">
                                <i class="fas fa-boxes fa-2x mb-2"></i>
                                <span class="text-sm">Kelola Inventaris</span>
                            </button>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <button class="btn bg-gradient-success w-100 h-100 p-3 d-flex flex-column align-items-center justify-content-center" onclick="approveRequests()">
                                <i class="fas fa-clipboard-check fa-2x mb-2"></i>
                                <span class="text-sm">Approve Permintaan</span>
                            </button>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <button class="btn bg-gradient-warning w-100 h-100 p-3 d-flex flex-column align-items-center justify-content-center" onclick="manageUsers()">
                                <i class="fas fa-users-cog fa-2x mb-2"></i>
                                <span class="text-sm">Kelola User</span>
                            </button>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <button class="btn bg-gradient-info w-100 h-100 p-3 d-flex flex-column align-items-center justify-content-center" onclick="viewReports()">
                                <i class="fas fa-chart-bar fa-2x mb-2"></i>
                                <span class="text-sm">Laporan & Analitik</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>System Overview</h6>
                </div>
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-sm">Server Status</span>
                        <span class="badge bg-gradient-success">Online</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-sm">Database</span>
                        <span class="badge bg-gradient-success">Connected</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-sm">Last Backup</span>
                        <span class="text-sm">2 hours ago</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-sm">Active Users</span>
                        <span class="text-sm">24 online</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-sm">System Load</span>
                        <div class="progress-wrapper w-50">
                            <div class="progress-info">
                                <div class="progress-percentage">
                                    <span class="text-sm font-weight-bold">42%</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100" style="width: 42%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Detail Notifikasi -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalTitle">Detail Notifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="notificationModalBody">
                <!-- Notification content will be populated by JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="notificationActionBtn">Tindak Lanjuti</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Data dummy untuk dashboard
    const dashboardData = {
        stats: {
            totalAvailable: 156,
            totalBorrowed: 23,
            totalDamaged: 8,
            totalBlocked: 2
        },
        notifications: [
            {
                id: 1,
                type: 'borrow',
                title: 'Pengajuan Peminjaman Baru',
                message: 'Ahmad Rizki (XII IPA 1) mengajukan peminjaman 2 Laptop',
                time: '5 menit lalu',
                read: false,
                priority: 'high'
            },
            {
                id: 2,
                type: 'usage',
                title: 'Pengajuan Pemakaian Bahan',
                message: 'Siti Nurhaliza (XII IPA 2) meminta 5 Tabung Reaksi',
                time: '15 menit lalu',
                read: false,
                priority: 'medium'
            },
            {
                id: 3,
                type: 'return',
                title: 'Pengembalian Barang',
                message: 'Budi Santoso (XII IPA 3) telah mengembalikan Mikroskop',
                time: '1 jam lalu',
                read: true,
                priority: 'low'
            },
            {
                id: 4,
                type: 'damage',
                title: 'Laporan Kerusakan',
                message: 'Monitor di Lab Komputer 1 dilaporkan rusak',
                time: '2 jam lalu',
                read: false,
                priority: 'high'
            },
            {
                id: 5,
                type: 'system',
                title: 'Backup Sistem',
                message: 'Backup harian berhasil dilakukan',
                time: '3 jam lalu',
                read: true,
                priority: 'low'
            }
        ],
        pendingBorrows: [
            {
                id: 1,
                student: 'Ahmad Rizki',
                class: 'XII IPA 1',
                items: '2 Laptop, 1 Proyektor',
                time: '10:00 - 12:00',
                date: '16 Mar 2024'
            },
            {
                id: 2,
                student: 'Siti Nurhaliza',
                class: 'XII IPA 2',
                items: '5 Mikroskop',
                time: '08:00 - 10:00',
                date: '16 Mar 2024'
            },
            {
                id: 3,
                student: 'Budi Santoso',
                class: 'XII IPA 3',
                items: '3 Monitor',
                time: '13:00 - 15:00',
                date: '17 Mar 2024'
            }
        ],
        pendingUsages: [
            {
                id: 1,
                student: 'Dewi Sartika',
                class: 'XI IPA 1',
                material: 'Tabung Reaksi',
                quantity: '10 pcs',
                purpose: 'Praktik Kimia'
            },
            {
                id: 2,
                student: 'Rizki Pratama',
                class: 'XII IPA 2',
                material: 'Asam Sulfat',
                quantity: '200 ml',
                purpose: 'Eksperimen Lab'
            }
        ],
        chartData: {
            week: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                peminjaman: [12, 19, 8, 15, 22, 18, 5],
                pemakaian: [8, 12, 6, 10, 15, 12, 3],
                pengembalian: [10, 14, 7, 12, 18, 15, 4]
            },
            month: {
                labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                peminjaman: [45, 52, 38, 61],
                pemakaian: [32, 41, 28, 48],
                pengembalian: [38, 46, 32, 55]
            },
            year: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                peminjaman: [120, 135, 156, 142, 168, 155, 145, 162, 158, 172, 165, 180],
                pemakaian: [85, 92, 108, 95, 112, 98, 102, 115, 108, 122, 118, 125],
                pengembalian: [105, 118, 132, 125, 142, 128, 135, 148, 140, 155, 145, 160]
            }
        }
    };

    let currentChartPeriod = 'week';
    let activityChart = null;

    document.addEventListener('DOMContentLoaded', function() {
        initializeDashboard();
        renderNotifications();
        renderPendingTables();
        initializeChart();
    });

    function initializeDashboard() {
        // Update statistik
        document.getElementById('total-tersedia').textContent = dashboardData.stats.totalAvailable;
        document.getElementById('total-dipinjam').textContent = dashboardData.stats.totalBorrowed;
        document.getElementById('total-rusak').textContent = dashboardData.stats.totalDamaged;
        document.getElementById('total-diblokir').textContent = dashboardData.stats.totalBlocked;

        // Update pending counts
        document.getElementById('pending-borrow-count').textContent = dashboardData.pendingBorrows.length;
        document.getElementById('pending-usage-count').textContent = dashboardData.pendingUsages.length;
    }

    function renderNotifications() {
        const notificationList = document.getElementById('notification-list');
        notificationList.innerHTML = '';

        const unreadNotifications = dashboardData.notifications.filter(notif => !notif.read);
        
        if (unreadNotifications.length === 0) {
            notificationList.innerHTML = `
                <div class="text-center py-4">
                    <i class="fas fa-bell-slash text-muted fa-2x mb-2"></i>
                    <p class="text-muted mb-0">Tidak ada notifikasi baru</p>
                </div>
            `;
            return;
        }

        unreadNotifications.slice(0, 5).forEach(notification => {
            const notificationElement = document.createElement('a');
            notificationElement.href = '#';
            notificationElement.className = `list-group-item list-group-item-action border-0 ${notification.priority === 'high' ? 'border-start border-3 border-danger' : notification.priority === 'medium' ? 'border-start border-3 border-warning' : 'border-start border-3 border-info'}`;
            notificationElement.innerHTML = `
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas ${getNotificationIcon(notification.type)} ${getNotificationColor(notification.type)}"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="text-sm mb-1">${notification.title}</h6>
                        <p class="text-xs text-secondary mb-0">${notification.message}</p>
                        <p class="text-xs text-muted mb-0">${notification.time}</p>
                    </div>
                    ${!notification.read ? '<span class="badge badge-sm bg-gradient-primary">Baru</span>' : ''}
                </div>
            `;
            notificationElement.addEventListener('click', (e) => {
                e.preventDefault();
                showNotificationDetail(notification);
            });
            notificationList.appendChild(notificationElement);
        });
    }

    function renderPendingTables() {
        // Render pending borrows table
        const borrowTable = document.getElementById('pending-borrow-table');
        borrowTable.innerHTML = '';

        dashboardData.pendingBorrows.forEach(borrow => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <div class="d-flex flex-column">
                        <h6 class="mb-0 text-sm">${borrow.student}</h6>
                        <p class="text-xs text-secondary mb-0">${borrow.class}</p>
                    </div>
                </td>
                <td>
                    <p class="text-xs font-weight-bold mb-0">${borrow.items}</p>
                </td>
                <td>
                    <p class="text-xs font-weight-bold mb-0">${borrow.date}</p>
                    <p class="text-xs text-secondary mb-0">${borrow.time}</p>
                </td>
                <td>
                    <button class="btn btn-sm btn-success me-1" onclick="approveBorrow(${borrow.id})">
                        <i class="fas fa-check"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="rejectBorrow(${borrow.id})">
                        <i class="fas fa-times"></i>
                    </button>
                </td>
            `;
            borrowTable.appendChild(tr);
        });

        // Render pending usages table
        const usageTable = document.getElementById('pending-usage-table');
        usageTable.innerHTML = '';

        dashboardData.pendingUsages.forEach(usage => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <div class="d-flex flex-column">
                        <h6 class="mb-0 text-sm">${usage.student}</h6>
                        <p class="text-xs text-secondary mb-0">${usage.class}</p>
                    </div>
                </td>
                <td>
                    <p class="text-xs font-weight-bold mb-0">${usage.material}</p>
                    <p class="text-xs text-secondary mb-0">${usage.purpose}</p>
                </td>
                <td>
                    <span class="badge badge-sm bg-gradient-info">${usage.quantity}</span>
                </td>
                <td>
                    <button class="btn btn-sm btn-success me-1" onclick="approveUsage(${usage.id})">
                        <i class="fas fa-check"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="rejectUsage(${usage.id})">
                        <i class="fas fa-times"></i>
                    </button>
                </td>
            `;
            usageTable.appendChild(tr);
        });
    }

    function initializeChart() {
        const ctx = document.getElementById('activityChart').getContext('2d');
        const data = dashboardData.chartData[currentChartPeriod];

        if (activityChart) {
            activityChart.destroy();
        }

        activityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [
                    {
                        label: 'Peminjaman',
                        data: data.peminjaman,
                        borderColor: '#e91e63',
                        backgroundColor: 'rgba(233, 30, 99, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Pemakaian',
                        data: data.pemakaian,
                        borderColor: '#00bcd4',
                        backgroundColor: 'rgba(0, 188, 212, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Pengembalian',
                        data: data.pengembalian,
                        borderColor: '#4caf50',
                        backgroundColor: 'rgba(76, 175, 80, 0.1)',
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: `Aktivitas ${currentChartPeriod === 'week' ? 'Minggu Ini' : currentChartPeriod === 'month' ? 'Bulan Ini' : 'Tahun Ini'}`
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    }

    // Utility functions
    function getNotificationIcon(type) {
        const icons = {
            borrow: 'fa-clipboard-list',
            usage: 'fa-vial',
            return: 'fa-undo',
            damage: 'fa-exclamation-triangle',
            system: 'fa-cog'
        };
        return icons[type] || 'fa-bell';
    }

    function getNotificationColor(type) {
        const colors = {
            borrow: 'text-warning',
            usage: 'text-info',
            return: 'text-success',
            damage: 'text-danger',
            system: 'text-secondary'
        };
        return colors[type] || 'text-primary';
    }

    // Action functions
    function refreshDashboard() {
        showNotification('Dashboard berhasil di-refresh', 'success');
        // Simulate data refresh
        setTimeout(() => {
            initializeDashboard();
            renderNotifications();
            renderPendingTables();
        }, 1000);
    }

    function generateReport() {
        showNotification('Sedang meng-generate laporan...', 'info');
        // Simulate report generation
        setTimeout(() => {
            showNotification('Laporan berhasil di-generate dan di-download', 'success');
        }, 2000);
    }

    function changeChartPeriod(period) {
        currentChartPeriod = period;
        initializeChart();
        showNotification(`Menampilkan data ${period === 'week' ? 'minggu ini' : period === 'month' ? 'bulan ini' : 'tahun ini'}`, 'info');
    }

    function markAllAsRead() {
        dashboardData.notifications.forEach(notif => notif.read = true);
        renderNotifications();
        showNotification('Semua notifikasi ditandai sudah dibaca', 'success');
    }

    function viewAllNotifications() {
        showNotification('Membuka halaman semua notifikasi', 'info');
        // Redirect to notifications page would go here
    }

    function showNotificationDetail(notification) {
        document.getElementById('notificationModalTitle').textContent = notification.title;
        document.getElementById('notificationModalBody').innerHTML = `
            <p><strong>Pesan:</strong> ${notification.message}</p>
            <p><strong>Waktu:</strong> ${notification.time}</p>
            <p><strong>Tipe:</strong> ${getNotificationTypeText(notification.type)}</p>
            <p><strong>Prioritas:</strong> <span class="badge ${getPriorityBadgeClass(notification.priority)}">${getPriorityText(notification.priority)}</span></p>
        `;

        const actionBtn = document.getElementById('notificationActionBtn');
        if (notification.type === 'borrow' || notification.type === 'usage') {
            actionBtn.textContent = 'Tinjau Pengajuan';
            actionBtn.className = 'btn btn-primary';
            actionBtn.onclick = function() {
                $('#notificationModal').modal('hide');
                approveRequests();
            };
        } else if (notification.type === 'damage') {
            actionBtn.textContent = 'Tindak Lanjuti Kerusakan';
            actionBtn.className = 'btn btn-warning';
            actionBtn.onclick = function() {
                $('#notificationModal').modal('hide');
                viewDamagedItems();
            };
        } else {
            actionBtn.style.display = 'none';
        }

        $('#notificationModal').modal('show');
        
        // Mark as read
        notification.read = true;
        renderNotifications();
    }

    function getNotificationTypeText(type) {
        const types = {
            borrow: 'Peminjaman',
            usage: 'Pemakaian',
            return: 'Pengembalian',
            damage: 'Kerusakan',
            system: 'Sistem'
        };
        return types[type] || 'Umum';
    }

    function getPriorityBadgeClass(priority) {
        const classes = {
            high: 'bg-gradient-danger',
            medium: 'bg-gradient-warning',
            low: 'bg-gradient-info'
        };
        return classes[priority] || 'bg-gradient-secondary';
    }

    function getPriorityText(priority) {
        const texts = {
            high: 'Tinggi',
            medium: 'Sedang',
            low: 'Rendah'
        };
        return texts[priority] || 'Umum';
    }

    // Approval functions
    function approveBorrow(id) {
        showNotification(`Pengajuan peminjaman #${id} disetujui`, 'success');
        // Remove from pending list
        dashboardData.pendingBorrows = dashboardData.pendingBorrows.filter(borrow => borrow.id !== id);
        renderPendingTables();
        document.getElementById('pending-borrow-count').textContent = dashboardData.pendingBorrows.length;
    }

    function rejectBorrow(id) {
        if (confirm('Apakah Anda yakin ingin menolak pengajuan ini?')) {
            showNotification(`Pengajuan peminjaman #${id} ditolak`, 'warning');
            dashboardData.pendingBorrows = dashboardData.pendingBorrows.filter(borrow => borrow.id !== id);
            renderPendingTables();
            document.getElementById('pending-borrow-count').textContent = dashboardData.pendingBorrows.length;
        }
    }

    function approveUsage(id) {
        showNotification(`Pengajuan pemakaian #${id} disetujui`, 'success');
        dashboardData.pendingUsages = dashboardData.pendingUsages.filter(usage => usage.id !== id);
        renderPendingTables();
        document.getElementById('pending-usage-count').textContent = dashboardData.pendingUsages.length;
    }

    function rejectUsage(id) {
        if (confirm('Apakah Anda yakin ingin menolak pengajuan ini?')) {
            showNotification(`Pengajuan pemakaian #${id} ditolak`, 'warning');
            dashboardData.pendingUsages = dashboardData.pendingUsages.filter(usage => usage.id !== id);
            renderPendingTables();
            document.getElementById('pending-usage-count').textContent = dashboardData.pendingUsages.length;
        }
    }

    // Navigation functions
    function viewAvailableItems() {
        showNotification('Membuka halaman inventaris tersedia', 'info');
        // window.location.href = '/admin/inventory';
    }

    function viewBorrowedItems() {
        showNotification('Membuka halaman kelola peminjaman', 'info');
        // window.location.href = '/admin/borrowings';
    }

    function viewDamagedItems() {
        showNotification('Membuka halaman barang rusak/hilang', 'info');
        // window.location.href = '/admin/damaged-items';
    }

    function viewBlockedUsers() {
        showNotification('Membuka halaman kelola blokir', 'info');
        // window.location.href = '/admin/blocked-users';
    }

    function viewAllPendingBorrows() {
        showNotification('Membuka semua pengajuan peminjaman', 'info');
        // window.location.href = '/admin/pending-borrows';
    }

    function viewAllPendingUsages() {
        showNotification('Membuka semua pengajuan pemakaian', 'info');
        // window.location.href = '/admin/pending-usages';
    }

    function manageInventory() {
        showNotification('Membuka halaman kelola inventaris', 'info');
        // window.location.href = '/admin/inventory';
    }

    function approveRequests() {
        showNotification('Membuka halaman approve permintaan', 'info');
        // window.location.href = '/admin/approvals';
    }

    function manageUsers() {
        showNotification('Membuka halaman kelola user', 'info');
        // window.location.href = '/admin/users';
    }

    function viewReports() {
        showNotification('Membuka halaman laporan & analitik', 'info');
        // window.location.href = '/admin/reports';
    }

    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
            <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle'} me-2"></i>
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