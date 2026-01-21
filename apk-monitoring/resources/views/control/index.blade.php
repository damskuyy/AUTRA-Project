@extends('layout.master')
@section('sidebar')
    @include('layout.sidebar')
@endsection
@section('navbar')
    @include('layout.navbar')
@endsection

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