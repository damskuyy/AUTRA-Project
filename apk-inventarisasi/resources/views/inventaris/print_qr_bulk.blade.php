<!DOCTYPE html>
<html>
<head>
    <title>Print QR Inventaris</title>

    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }

        .controls {
            margin-bottom: 20px;
        }

        .qr-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .qr-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;

            background: #fff;
        }

        .qr-label {
            margin-top: 6px;
            text-align: center;
            line-height: 1.2;
        }

        .qr-label .nama {
            font-size: 11px;
            font-weight: 600;
        }

        .qr-label .kode {
            font-size: 10px;
            color: #666;
        }

        @media print {
            .controls {
                display: none;
            }

            body {
                padding: 0;
            }

            .qr-item {
                border: none;
                padding: 5px;
            }
        }
    </style>
</head>
<body>

<div class="controls">
    <form method="GET" class="controls">
        <label>Ukuran QR:</label>

        <select onchange="setSize(this.value)">
            <option value="">-- Preset --</option>
            <option value="50">Kecil</option>
            <option value="100">Sedang</option>
            <option value="150">Besar</option>
            <option value="200">Extra Besar</option>
        </select>

        <input type="number" name="size" id="sizeInput"
            value="{{ $size }}"
            min="40" max="500"
            style="width:80px; margin-left:10px;"
        >

        <button type="submit">Apply</button>
    </form>

    <button onclick="window.print()">🖨️ Print Semua</button>
</div>

<div class="qr-container">
    @foreach ($inventaris as $item)
        <div class="qr-item">
            {!! QrCode::size($size)->generate($item->kode_qr_jurusan) !!}

            <div class="qr-label">
                <div class="nama">
                    {{ $item->barangMasuk->nama_barang }}
                </div>
                <div class="kode">
                    {{ $item->kode_qr_jurusan }}
                </div>
            </div>
        </div>
    @endforeach
</div>
<script>
function setSize(val) {
    if (val) {
        document.getElementById('sizeInput').value = val;
    }
}
</script>
</body>
</html>