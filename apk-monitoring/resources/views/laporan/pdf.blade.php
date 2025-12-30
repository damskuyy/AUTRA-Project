<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Sensor Dari PLC</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #333;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px solid #f97316;
            padding-bottom: 15px;
        }
        
        .header-content {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }
        
        .logo-section {
            display: table-cell;
            vertical-align: middle;
            width: 80px;
            text-align: left;
        }
        
        .logo-section img {
            width: 60px;
            height: 60px;
        }
        
        .title-section {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }
        
        .header h1 {
            font-size: 18px;
            color: #f97316;
            margin-bottom: 4px;
            font-weight: bold;
        }
        
        .header h2 {
            font-size: 12px;
            color: #666;
            font-weight: normal;
            margin-bottom: 8px;
        }
        
        .header .info {
            font-size: 9px;
            color: #999;
            line-height: 1.4;
        }
        
        .summary {
            margin-bottom: 18px;
            padding: 12px;
            background-color: #f5f5f5;
            border-left: 4px solid #f97316;
            page-break-inside: avoid;
        }
        
        .summary h3 {
            font-size: 11px;
            margin-bottom: 8px;
            color: #f97316;
            font-weight: bold;
        }
        
        .summary-grid {
            display: table;
            width: 100%;
        }
        
        .summary-row {
            display: table-row;
        }
        
        .summary-item {
            display: table-cell;
            font-size: 9px;
            padding: 3px 8px 3px 0;
            width: 33.33%;
        }
        
        .summary-item strong {
            color: #f97316;
            font-weight: bold;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        
        table thead {
            background-color: #f97316;
            color: white;
        }
        
        table thead th {
            padding: 8px 6px;
            text-align: left;
            font-weight: bold;
            font-size: 10px;
            border-right: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        table thead th:last-child {
            border-right: none;
        }
        
        table tbody td {
            padding: 6px;
            border-bottom: 1px solid #ddd;
            font-size: 9px;
        }
        
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 8px;
            text-align: center;
        }
        
        .status-normal {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .status-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }
        
        .status-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .footer {
            position: fixed;
            bottom: 15px;
            left: 20px;
            right: 20px;
            text-align: center;
            font-size: 8px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 8px;
        }
        
        .page-number:after {
            content: counter(page);
        }
        
        .page-break {
            page-break-after: always;
        }
        
        /* Column widths */
        .col-id { width: 8%; }
        .col-waktu { width: 20%; }
        .col-suhu { width: 12%; }
        .col-cahaya { width: 15%; }
        .col-kelembapan { width: 18%; }
        .col-status { width: 12%; }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="logo-section">
                <img src="{{ public_path('assets/img/logo/logo-autra-nonBG.png') }}" alt="AUTRA Logo">
            </div>
            <div class="title-section">
                <h1>LAPORAN DATA SENSOR PLC</h1>
                <h2>AUTRA Monitoring System</h2>
                <div class="info">
                    <p>Tanggal Export: {{ $exportDate }}</p>
                    <p>Total Records: {{ $data->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Statistics -->
    <div class="summary">
        <h3>Ringkasan Data</h3>
        <div class="summary-grid">
            <div class="summary-row">
                <div class="summary-item">
                    <strong>Total Data:</strong> {{ $data->count() }}
                </div>
                <div class="summary-item">
                    <strong>Status Normal:</strong> {{ $data->where('status', 'Normal')->count() }}
                </div>
                <div class="summary-item">
                    <strong>Status Warning:</strong> {{ $data->where('status', 'Warning')->count() }}
                </div>
            </div>
            <div class="summary-row">
                <div class="summary-item">
                    <strong>Status Danger:</strong> {{ $data->where('status', 'Danger')->count() }}
                </div>
                <div class="summary-item">
                    <strong>Rata-rata Suhu:</strong> {{ number_format($data->avg('suhu'), 2) }} °C
                </div>
                <div class="summary-item">
                    <strong>Rata-rata Kelembapan:</strong> {{ number_format($data->avg('kelembapan'), 2) }} %
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <table>
        <thead>
            <tr>
                <th class="col-id">ID</th>
                <th class="col-waktu">Waktu</th>
                <th class="col-suhu">Suhu (°C)</th>
                <th class="col-cahaya">Cahaya (Lux)</th>
                <th class="col-kelembapan">Kelembapan (%)</th>
                <th class="col-status">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->waktu->format('d-m-Y H:i:s') }}</td>
                <td>{{ $item->suhu }}</td>
                <td>{{ $item->cahaya }}</td>
                <td>{{ $item->kelembapan }}</td>
                <td>
                    <span class="status status-{{ strtolower($item->status) }}">
                        {{ $item->status }}
                    </span>
                </td>
            </tr>
            
            @if(($index + 1) % 35 == 0 && !$loop->last)
            </tbody>
        </table>
        <div class="page-break"></div>
        <table>
            <thead>
                <tr>
                    <th class="col-id">ID</th>
                    <th class="col-waktu">Waktu</th>
                    <th class="col-suhu">Suhu (°C)</th>
                    <th class="col-cahaya">Cahaya (Lux)</th>
                    <th class="col-kelembapan">Kelembapan (%)</th>
                    <th class="col-status">Status</th>
                </tr>
            </thead>
            <tbody>
            @endif
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>© 2025 AUTRA Monitoring System - Laporan Data Sensor PLC</p>
        <p>Dokumen ini dibuat secara otomatis oleh sistem | Halaman <span class="page-number"></span></p>
    </div>
</body>
</html>