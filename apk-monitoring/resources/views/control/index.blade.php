{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Panel - Automation Monitoring System</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-heartbeat"></i>
            </div>
            <div class="brand-info">
                <h2>Automation</h2>
                <span>Monitoring System</span>
            </div>
        </div>
        <nav class="sidebar-menu">
            <a href="/" class="menu-item">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            <a href="control-v2.html" class="menu-item active">
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

        <div class="system-status">
            <div class="status-indicator">
                <span class="status-dot"></span>
                <span class="status-text">System Online</span>
            </div>
            <div class="status-info">PLC Connected • 3 Sensors Active</div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="navbar-left">
                <div class="welcome-text">
                    <span class="welcome-label">Welcome back,</span>
                    <h1>Industrial Monitoring</h1>
                </div>
            </div>
            <div class="navbar-right">
                <div class="user-profile">
                    <div class="avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info">
                        <span class="user-name">Admin User</span>
                        <span class="user-role">Administrator</span>
                    </div>
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
            </div>
        </nav>

        <!-- Control Content -->
        <div class="content">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2>Control Panel</h2>
                    <p>Kontrol dan kelola perangkat otomasi industri</p>
                </div>
            </div>

            <!-- Control Cards Grid -->
            <div class="control-grid">
                <!-- Cooling System -->
                <div class="control-device-card">
                    <div class="device-header">
                        <div class="device-icon cooling">
                            <i class="fas fa-temperature-low"></i>
                        </div>
                        <div class="toggle-switch">
                            <input type="checkbox" id="cooling" class="toggle-input">
                            <label for="cooling" class="toggle-label"></label>
                        </div>
                    </div>
                    <div class="device-info">
                        <h3>Cooling System</h3>
                        <p>Main cooling unit control</p>
                    </div>
                    <button class="control-btn btn-off active" data-device="cooling">
                        <i class="fas fa-power-off"></i> Turn OFF
                    </button>
                </div>

                <!-- Lighting -->
                <div class="control-device-card">
                    <div class="device-header">
                        <div class="device-icon lighting">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div class="toggle-switch">
                            <input type="checkbox" id="lighting" class="toggle-input" checked>
                            <label for="lighting" class="toggle-label"></label>
                        </div>
                    </div>
                    <div class="device-info">
                        <h3>Lighting</h3>
                        <p>Factory lighting control</p>
                    </div>
                    <button class="control-btn btn-on active" data-device="lighting">
                        <i class="fas fa-power-off"></i> Turn ON
                    </button>
                </div>

                <!-- Ventilation -->
                <div class="control-device-card">
                    <div class="device-header">
                        <div class="device-icon ventilation">
                            <i class="fas fa-fan"></i>
                        </div>
                        <div class="toggle-switch">
                            <input type="checkbox" id="ventilation" class="toggle-input">
                            <label for="ventilation" class="toggle-label"></label>
                        </div>
                    </div>
                    <div class="device-info">
                        <h3>Ventilation</h3>
                        <p>Air ventilation system</p>
                    </div>
                    <button class="control-btn btn-off active" data-device="ventilation">
                        <i class="fas fa-power-off"></i> Turn OFF
                    </button>
                </div>

                <!-- Heater -->
                <div class="control-device-card">
                    <div class="device-header">
                        <div class="device-icon heater">
                            <i class="fas fa-fire"></i>
                        </div>
                        <div class="toggle-switch">
                            <input type="checkbox" id="heater" class="toggle-input" checked>
                            <label for="heater" class="toggle-label"></label>
                        </div>
                    </div>
                    <div class="device-info">
                        <h3>Heater</h3>
                        <p>Industrial heating unit</p>
                    </div>
                    <button class="control-btn btn-on active" data-device="heater">
                        <i class="fas fa-power-off"></i> Turn ON
                    </button>
                </div>
            </div>

            <!-- Slider Controls -->
            <div class="slider-controls-grid">
                <!-- Target Temperature -->
                <div class="slider-card">
                    <h3>Target Temperature</h3>
                    <div class="slider-value-display">
                        <span class="slider-value" id="temp-value">25</span>
                        <span class="slider-unit">°C</span>
                    </div>
                    <input type="range" class="control-slider" id="temp-slider" min="15" max="35" value="25">
                    <div class="slider-labels">
                        <span>15°C</span>
                        <span>35°C</span>
                    </div>
                </div>

                <!-- Fan Speed -->
                <div class="slider-card">
                    <h3>Fan Speed</h3>
                    <div class="slider-value-display">
                        <span class="slider-value" id="fan-value">60</span>
                        <span class="slider-unit">%</span>
                    </div>
                    <input type="range" class="control-slider" id="fan-slider" min="0" max="100" value="60">
                    <div class="slider-labels">
                        <span>0%</span>
                        <span>100%</span>
                    </div>
                </div>

                <!-- Light Brightness -->
                <div class="slider-card">
                    <h3>Light Brightness</h3>
                    <div class="slider-value-display">
                        <span class="slider-value" id="light-value">80</span>
                        <span class="slider-unit">%</span>
                    </div>
                    <input type="range" class="control-slider" id="light-slider" min="0" max="100" value="80">
                    <div class="slider-labels">
                        <span>0%</span>
                        <span>100%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle switches
        const toggles = document.querySelectorAll('.toggle-input');
        toggles.forEach(toggle => {
            toggle.addEventListener('change', function() {
                const card = this.closest('.control-device-card');
                const button = card.querySelector('.control-btn');
                
                if (this.checked) {
                    button.classList.remove('btn-off');
                    button.classList.add('btn-on');
                    button.innerHTML = '<i class="fas fa-power-off"></i> Turn ON';
                } else {
                    button.classList.remove('btn-on');
                    button.classList.add('btn-off');
                    button.innerHTML = '<i class="fas fa-power-off"></i> Turn OFF';
                }
            });
        });

        // Control buttons
        const controlBtns = document.querySelectorAll('.control-btn');
        controlBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const toggle = this.closest('.control-device-card').querySelector('.toggle-input');
                toggle.checked = !toggle.checked;
                toggle.dispatchEvent(new Event('change'));
            });
        });

        // Sliders
        const sliders = [
            { slider: 'temp-slider', value: 'temp-value' },
            { slider: 'fan-slider', value: 'fan-value' },
            { slider: 'light-slider', value: 'light-value' }
        ];

        sliders.forEach(item => {
            const slider = document.getElementById(item.slider);
            const valueDisplay = document.getElementById(item.value);
            
            slider.addEventListener('input', function() {
                valueDisplay.textContent = this.value;
                
                // Update slider gradient
                const percentage = ((this.value - this.min) / (this.max - this.min)) * 100;
                this.style.background = `linear-gradient(to right, #FF9800 0%, #FF9800 ${percentage}%, rgba(255, 152, 0, 0.1) ${percentage}%, rgba(255, 152, 0, 0.1) 100%)`;
            });

            // Initialize gradient
            const percentage = ((slider.value - slider.min) / (slider.max - slider.min)) * 100;
            slider.style.background = `linear-gradient(to right, #FF9800 0%, #FF9800 ${percentage}%, rgba(255, 152, 0, 0.1) ${percentage}%, rgba(255, 152, 0, 0.1) 100%)`;
        });
    </script>
</body>
</html> --}}\

{{-- @extends('layout.master')

@section('title','Control')

@section('page-title','Control Panel')
@section('page-subtitle','Manual & Automatic Device Control')

@section('content')
    <div class="control-mode">
        <div id="modeToggle" class="mode-switch">
            <span class="dot"></span>
            <span class="label">Auto</span>
        </div>
    </div>

    <div class="control-grid">
        <div class="control-card">
            <div class="control-header">
                <span class="icon">💡</span>
                <span>Lampu</span>
            </div>

            <button class="toggle-switch on">
                <span class="thumb"></span>
            </button>

            <span class="status on">ON</span>
        </div>
    </div>

@endsection --}}

@extends('layout.master')

@section('title', 'Control Panel - AUTRA')

@section('page-title', 'Control Panel')
@section('page-subtitle', 'Kontrol device otomasi industri')

@push('styles')
    <style>
        /* Fallback icons if FA doesn't have pump/fan */
        .fa-pump::before {
            content: "\f06d"; /* faucet icon as fallback */
        }
        .fa-fan::before {
            content: "\f863"; /* fan icon */
        }
    </style>
@endpush

@section('content')
    <!-- Emergency Stop Button -->
    <div class="emergency-container">
        <button class="btn-emergency" id="emergencyStop">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <span>Emergency Stop</span>
        </button>
    </div>

    <!-- Control Cards Grid -->
    <div class="control-grid">
        
        <!-- Motor Utama -->
        <div class="control-card" data-device="motor">
            <div class="control-card-header">
                <div class="control-card-info">
                    <div class="control-icon">
                        <i class="fa-solid fa-gear"></i>
                    </div>
                    <div class="control-title-group">
                        <h3>Motor Utama</h3>
                        <div class="control-meta">
                            <span class="status-badge offline">
                                <i class="fa-solid fa-circle"></i> Offline
                            </span>
                            <span class="time-badge">
                                <i class="fa-regular fa-clock"></i> <span class="device-time">00:00:00</span>
                            </span>
                        </div>
                    </div>
                </div>
                <i class="fa-solid fa-bolt control-badge-icon"></i>
            </div>

            <div class="control-section">
                <h4 class="section-title">Control Status</h4>
                <div class="control-buttons">
                    <button class="btn-control btn-on" data-action="on">
                        <i class="fa-solid fa-power-off"></i>
                        <span>ON</span>
                    </button>
                    <button class="btn-control btn-off active" data-action="off">
                        <i class="fa-solid fa-power-off"></i>
                        <span>OFF</span>
                    </button>
                </div>
            </div>

            <div class="power-section">
                <div class="power-header">
                    <h4 class="section-title">Daya Output</h4>
                    <span class="power-value">
                        <i class="fa-solid fa-bolt"></i>
                        <span class="power-percentage">0</span>%
                    </span>
                </div>
                <div class="slider-container">
                    <input type="range" class="power-slider" min="0" max="100" value="0" data-device="motor" disabled>
                    <div class="slider-track">
                        <div class="slider-fill" style="width: 0%"></div>
                    </div>
                </div>
                <div class="slider-labels">
                    <span>Low</span>
                    <span>Medium</span>
                    <span>High</span>
                </div>
            </div>
        </div>

        <!-- Pompa Air -->
        <div class="control-card" data-device="pompa">
            <div class="control-card-header">
                <div class="control-card-info">
                    <div class="control-icon">
                        <i class="fa-solid fa-pump"></i>
                    </div>
                    <div class="control-title-group">
                        <h3>Pompa Air</h3>
                        <div class="control-meta">
                            <span class="status-badge offline">
                                <i class="fa-solid fa-circle"></i> Offline
                            </span>
                            <span class="time-badge">
                                <i class="fa-regular fa-clock"></i> <span class="device-time">00:00:00</span>
                            </span>
                        </div>
                    </div>
                </div>
                <i class="fa-solid fa-bolt control-badge-icon"></i>
            </div>

            <div class="control-section">
                <h4 class="section-title">Control Status</h4>
                <div class="control-buttons">
                    <button class="btn-control btn-on" data-action="on">
                        <i class="fa-solid fa-power-off"></i>
                        <span>ON</span>
                    </button>
                    <button class="btn-control btn-off active" data-action="off">
                        <i class="fa-solid fa-power-off"></i>
                        <span>OFF</span>
                    </button>
                </div>
            </div>

            <div class="power-section">
                <div class="power-header">
                    <h4 class="section-title">Daya Output</h4>
                    <span class="power-value">
                        <i class="fa-solid fa-bolt"></i>
                        <span class="power-percentage">0</span>%
                    </span>
                </div>
                <div class="slider-container">
                    <input type="range" class="power-slider" min="0" max="100" value="0" data-device="pompa" disabled>
                    <div class="slider-track">
                        <div class="slider-fill" style="width: 0%"></div>
                    </div>
                </div>
                <div class="slider-labels">
                    <span>Low</span>
                    <span>Medium</span>
                    <span>High</span>
                </div>
            </div>
        </div>

        <!-- Lampu Ruangan -->
        <div class="control-card" data-device="lampu">
            <div class="control-card-header">
                <div class="control-card-info">
                    <div class="control-icon">
                        <i class="fa-solid fa-lightbulb"></i>
                    </div>
                    <div class="control-title-group">
                        <h3>Lampu Ruangan</h3>
                        <div class="control-meta">
                            <span class="status-badge offline">
                                <i class="fa-solid fa-circle"></i> Offline
                            </span>
                            <span class="time-badge">
                                <i class="fa-regular fa-clock"></i> <span class="device-time">00:00:00</span>
                            </span>
                        </div>
                    </div>
                </div>
                <i class="fa-solid fa-bolt control-badge-icon"></i>
            </div>

            <div class="control-section">
                <h4 class="section-title">Control Status</h4>
                <div class="control-buttons">
                    <button class="btn-control btn-on" data-action="on">
                        <i class="fa-solid fa-power-off"></i>
                        <span>ON</span>
                    </button>
                    <button class="btn-control btn-off active" data-action="off">
                        <i class="fa-solid fa-power-off"></i>
                        <span>OFF</span>
                    </button>
                </div>
            </div>

            <div class="power-section">
                <div class="power-header">
                    <h4 class="section-title">Daya Output</h4>
                    <span class="power-value">
                        <i class="fa-solid fa-bolt"></i>
                        <span class="power-percentage">0</span>%
                    </span>
                </div>
                <div class="slider-container">
                    <input type="range" class="power-slider" min="0" max="100" value="0" data-device="lampu" disabled>
                    <div class="slider-track">
                        <div class="slider-fill" style="width: 0%"></div>
                    </div>
                </div>
                <div class="slider-labels">
                    <span>Low</span>
                    <span>Medium</span>
                    <span>High</span>
                </div>
            </div>
        </div>

        <!-- Fan Exhaust -->
        <div class="control-card" data-device="fan">
            <div class="control-card-header">
                <div class="control-card-info">
                    <div class="control-icon">
                        <i class="fa-solid fa-fan"></i>
                    </div>
                    <div class="control-title-group">
                        <h3>Fan Exhaust</h3>
                        <div class="control-meta">
                            <span class="status-badge offline">
                                <i class="fa-solid fa-circle"></i> Offline
                            </span>
                            <span class="time-badge">
                                <i class="fa-regular fa-clock"></i> <span class="device-time">00:00:00</span>
                            </span>
                        </div>
                    </div>
                </div>
                <i class="fa-solid fa-bolt control-badge-icon"></i>
            </div>

            <div class="control-section">
                <h4 class="section-title">Control Status</h4>
                <div class="control-buttons">
                    <button class="btn-control btn-on" data-action="on">
                        <i class="fa-solid fa-power-off"></i>
                        <span>ON</span>
                    </button>
                    <button class="btn-control btn-off active" data-action="off">
                        <i class="fa-solid fa-power-off"></i>
                        <span>OFF</span>
                    </button>
                </div>
            </div>

            <div class="power-section">
                <div class="power-header">
                    <h4 class="section-title">Daya Output</h4>
                    <span class="power-value">
                        <i class="fa-solid fa-bolt"></i>
                        <span class="power-percentage">0</span>%
                    </span>
                </div>
                <div class="slider-container">
                    <input type="range" class="power-slider" min="0" max="100" value="0" data-device="fan" disabled>
                    <div class="slider-track">
                        <div class="slider-fill" style="width: 0%"></div>
                    </div>
                </div>
                <div class="slider-labels">
                    <span>Low</span>
                    <span>Medium</span>
                    <span>High</span>
                </div>
            </div>
        </div>

    </div>

    <!-- Information Section -->
    <div class="info-section">
        <div class="info-header">
            <i class="fa-solid fa-wave-square"></i>
            <h3>Informasi Kontrol</h3>
        </div>
        <div class="info-content">
            <div class="info-row">
                <div class="info-item">
                    <i class="fa-solid fa-circle bullet-point"></i>
                    <span>Tombol <strong>ON</strong> untuk menghidupkan device</span>
                </div>
                <div class="info-item">
                    <i class="fa-solid fa-circle bullet-point"></i>
                    <span>Tombol <strong>OFF</strong> untuk mematikan device</span>
                </div>
            </div>
            <div class="info-row">
                <div class="info-item">
                    <i class="fa-solid fa-circle bullet-point"></i>
                    <span>Slider untuk mengatur daya output (0-100%)</span>
                </div>
                <div class="info-item">
                    <i class="fa-solid fa-circle bullet-point"></i>
                    <span><strong>Emergency Stop</strong> mematikan semua device</span>
                </div>
            </div>
        </div>
    </div>
@endsection