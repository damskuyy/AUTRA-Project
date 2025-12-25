{{-- @extends('layout.master')
@section('navbar')
    @include('layout.navbar')
@endsection
@section('sidebar')
    @include('layout.sidebar')
@endsection
@section('main')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold text-center mb-6 text-gray-800">Dashboard Monitoring PLC</h1>

    <!-- Sensor Data Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Suhu -->
        <div class="bg-red-500 p-6 rounded-xl shadow-lg text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:bg-red-600">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">Suhu</h3>
                <svg class="w-10 h-10 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.496-.769a1 1 0 011.414 1.414l-.769 1.496L16.677 10H18a1 1 0 110 2h-1.323l-1.582 3.954.769 1.496a1 1 0 01-1.414 1.414l-1.496-.769L10 16.677V18a1 1 0 11-2 0v-1.323l-3.954-1.582-1.496.769a1 1 0 01-1.414-1.414l.769-1.496L3.323 10H2a1 1 0 110-2h1.323l1.582-3.954-.769-1.496a1 1 0 011.414-1.414l1.496.769L10 3.323V2a1 1 0 011-1zM10 8a2 2 0 100 4 2 2 0 000-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-4xl font-bold mb-2" id="suhu-value">25.5°C</p>
            <p class="text-sm opacity-90">Status: <span class="font-semibold">Normal</span></p>
        </div>

        <!-- Tegangan -->
        <div class="bg-yellow-500 p-6 rounded-xl shadow-lg text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:bg-yellow-600">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">Tegangan</h3>
                <svg class="w-10 h-10 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-4xl font-bold mb-2" id="tegangan-value">220V</p>
            <p class="text-sm opacity-90">Status: <span class="font-semibold">Stabil</span></p>
        </div>

        <!-- Volume -->
        <div class="bg-blue-500 p-6 rounded-xl shadow-lg text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:bg-blue-600">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">Volume</h3>
                <svg class="w-10 h-10 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-4xl font-bold mb-2" id="volume-value">500L</p>
            <p class="text-sm opacity-90">Status: <span class="font-semibold">Penuh</span></p>
        </div>

        <!-- Arus -->
        <div class="bg-green-500 p-6 rounded-xl shadow-lg text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:bg-green-600">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">Arus</h3>
                <svg class="w-10 h-10 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-4xl font-bold mb-2" id="arus-value">5.2A</p>
            <p class="text-sm opacity-90">Status: <span class="font-semibold">Normal</span></p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Force sidebar to be visible
    const sidebar = document.getElementById('sidenav-main');
    if (sidebar) {
        sidebar.style.display = 'block !important';
        sidebar.style.position = 'fixed !important';
        sidebar.style.left = '0 !important';
        sidebar.style.top = '0 !important';
        sidebar.style.width = '280px !important';
        sidebar.style.height = '100vh !important';
        sidebar.style.zIndex = '1050 !important';
        sidebar.style.transform = 'translateX(0) !important';
        sidebar.style.opacity = '1 !important';
        sidebar.style.visibility = 'visible !important';
    }

    // Update sensor values randomly for demo
    setInterval(() => {
        document.getElementById('suhu-value').textContent = (25 + Math.random() * 5).toFixed(1) + '°C';
        document.getElementById('tegangan-value').textContent = (215 + Math.random() * 10).toFixed(0) + 'V';        
        document.getElementById('volume-value').textContent = (480 + Math.random() * 40).toFixed(0) + 'L';
        document.getElementById('arus-value').textContent = (4.5 + Math.random() * 1).toFixed(1) + 'A';
    }, 5000); // Update every 5 seconds
});
</script>
@endsection --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Monitoring - Automation System</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo-box">
                <i class="fas fa-layer-group"></i>
            </div>
            <div class="brand-info">
                <h2>Automation</h2>
                <span>Monitoring System</span>
            </div>
        </div>
        <nav class="sidebar-menu">
            <a href="dashboard-v2.html" class="menu-item active">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            <a href="control-v2.html" class="menu-item">
                <i class="fas fa-sliders-h"></i>
                <span>Control</span>
            </a>
            <a href="laporan.html" class="menu-item">
                <i class="fas fa-file-alt"></i>
                <span>Laporan</span>
            </a>
            <a href="notifikasi.html" class="menu-item">
                <i class="fas fa-bell"></i>
                <span>Notifikasi</span>
            </a>
            <a href="manage-user.html" class="menu-item">
                <i class="fas fa-users-cog"></i>
                <span>Manage User</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="copyright">© 2025 Automation System</div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="navbar-left">
                <h1>Dashboard Monitoring</h1>
                <p>Real-time monitoring sensor PLC</p>
            </div>
            <div class="navbar-right">
                <button class="live-indicator">
                    <span class="live-dot"></span>
                    Live
                </button>
                <div class="user-menu">
                    <div class="user-avatar">AU</div>
                    <div class="user-details">
                        <span class="user-name">Admin User</span>
                        <span class="user-role">Administrator</span>
                    </div>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </nav>

        <!-- Dashboard Content -->
        <div class="content">
            <!-- Sensor Cards Grid -->
            <div class="sensor-grid-final">
                <!-- Temperature Card -->
                <div class="sensor-card-final">
                    <div class="card-header-final">
                        <span class="sensor-name">Suhu</span>
                        <i class="fas fa-thermometer-half icon-small"></i>
                    </div>
                    <div class="card-body-final">
                        <div class="sensor-reading">
                            <span class="reading-value orange" id="temp-display">32.9</span>
                            <span class="reading-unit">°C</span>
                        </div>
                        <div class="status-indicator green">
                            <i class="fas fa-chart-line"></i>
                            <span>Normal</span>
                        </div>
                    </div>
                </div>

                <!-- Light Intensity Card -->
                <div class="sensor-card-final">
                    <div class="card-header-final">
                        <span class="sensor-name">Intensitas Cahaya</span>
                        <i class="fas fa-sun icon-small"></i>
                    </div>
                    <div class="card-body-final">
                        <div class="sensor-reading">
                            <span class="reading-value yellow" id="light-display">324</span>
                            <span class="reading-unit">Lux</span>
                        </div>
                        <div class="status-indicator green">
                            <i class="fas fa-chart-line"></i>
                            <span>Normal</span>
                        </div>
                    </div>
                </div>

                <!-- Humidity Card -->
                <div class="sensor-card-final full-width">
                    <div class="card-header-final">
                        <span class="sensor-name">Kelembapan</span>
                        <i class="fas fa-tint icon-small"></i>
                    </div>
                    <div class="card-body-final">
                        <div class="sensor-reading">
                            <span class="reading-value blue" id="humidity-display">59.2</span>
                            <span class="reading-unit">%</span>
                        </div>
                        <div class="status-indicator green">
                            <i class="fas fa-chart-line"></i>
                            <span>Normal</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="chart-section">
                <!-- Temperature Trend Chart -->
                <div class="chart-card-final">
                    <div class="chart-title">
                        <i class="fas fa-thermometer-half chart-icon-title"></i>
                        <span>Trend Suhu</span>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="tempChart"></canvas>
                    </div>
                </div>

                <!-- Light Intensity Trend Chart -->
                <div class="chart-card-final">
                    <div class="chart-title">
                        <i class="fas fa-sun chart-icon-title"></i>
                        <span>Trend Intensitas Cahaya</span>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="lightIntensityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/config.js"></script>
</body>
</html>