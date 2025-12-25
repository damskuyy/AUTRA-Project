@extends('layout.master')

@section('title', 'Dashboard Monitoring - AUTRA')

@section('page-title', 'Dashboard Monitoring')
@section('page-subtitle', 'Real-time monitoring sensor PLC')

@push('styles')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@section('topbar-actions')
    <div class="live-indicator">
        <i class="fa-solid fa-circle"></i>
        <span>Live</span>
    </div>
@endsection

@section('content')
    <!-- Sensor Cards - 3 COLUMNS -->
    <div class="sensor-cards">
        <!-- Temperature Card -->
        <div class="sensor-card">
            <div class="card-header">
                <span class="card-title">Suhu</span>
                <div class="card-icon temperature">
                    <i class="fa-solid fa-temperature-half"></i>
                </div>
            </div>
            <div class="card-value">
                <span class="value" id="suhuValue">34.7</span>
                <span class="unit">°C</span>
            </div>
            <div class="card-status normal">
                <i class="fa-solid fa-wave-square"></i>
                <span>Normal</span>
            </div>
        </div>

        <!-- Light Intensity Card -->
        <div class="sensor-card">
            <div class="card-header">
                <span class="card-title">Intensitas Cahaya</span>
                <div class="card-icon light">
                    <i class="fa-solid fa-sun"></i>
                </div>
            </div>
            <div class="card-value">
                <span class="value" id="cahayaValue">698</span>
                <span class="unit">Lux</span>
            </div>
            <div class="card-status normal">
                <i class="fa-solid fa-wave-square"></i>
                <span>Normal</span>
            </div>
        </div>

        <!-- Humidity Card -->
        <div class="sensor-card">
            <div class="card-header">
                <span class="card-title">Kelembapan</span>
                <div class="card-icon humidity">
                    <i class="fa-solid fa-droplet"></i>
                </div>
            </div>
            <div class="card-value">
                <span class="value" id="kelembapanValue">60.2</span>
                <span class="unit">%</span>
            </div>
            <div class="card-status normal">
                <i class="fa-solid fa-wave-square"></i>
                <span>Normal</span>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="chart-grid">
        <!-- Temperature Trend Chart -->
        <div class="chart-card">
            <div class="chart-header">
                <i class="fa-solid fa-temperature-half" style="color: #f97316;"></i>
                <h3>Trend Suhu</h3>
            </div>
            <div class="chart-container">
                <canvas id="suhuChart"></canvas>
            </div>
        </div>

        <!-- Light Intensity Trend Chart -->
        <div class="chart-card">
            <div class="chart-header">
                <i class="fa-solid fa-sun" style="color: #fbbf24;"></i>
                <h3>Trend Intensitas Cahaya</h3>
            </div>
            <div class="chart-container">
                <canvas id="cahayaChart"></canvas>
            </div>
        </div>

        <!-- Humidity Trend Chart (FULL WIDTH) -->
        <div class="chart-card full-width">
            <div class="chart-header">
                <i class="fa-solid fa-droplet" style="color: #3b82f6;"></i>
                <h3>Trend Kelembapan</h3>
            </div>
            <div class="chart-container">
                <canvas id="kelembapanChart"></canvas>
            </div>
        </div>
    </div>
@endsection