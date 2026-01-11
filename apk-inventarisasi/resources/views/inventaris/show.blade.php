@extends('be.layout')

@php
  $title = 'Detail Inventaris';
  $breadcrumb = 'Inventaris';
@endphp

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0">Informasi Barang</h5>
                        <span class="badge {{ $inventaris->status === 'TERSEDIA' ? 'bg-success' : 'bg-warning' }}">
                            {{ $inventaris->status }}
                        </span>
                    </div>

                    <table class="table table-borderless">
                        <tr><th>Kategori</th><td>: <span class="badge bg-secondary text-uppercase">{{ $inventaris->barangMasuk?->jenis_barang ?? 'Tidak diketahui' }}</span></td></tr>
                        <tr><th width="30%">Nama Barang</th><td>: {{ $inventaris->barangMasuk?->nama_barang ?? 'Data tidak ditemukan' }}</td></tr>
                        <tr><th>Merk</th><td>: {{ $inventaris->barangMasuk->merk ?? '-' }}</td></tr>
                        <tr><th>Seri Alat</th><td>: {{ $inventaris->barangMasuk?->nomor_dokumen ?? '-' }}</td></tr>
                        <tr><th>Lokasi Penempatan Barang</th><td>: {{ $inventaris->barangMasuk?->ruangan?->nama_ruangan ?? '-' }}</td></tr>
                        <tr><th>Sumber Dana Barang</th><td>: {{ $inventaris->barangMasuk?->sumber ?? '-' }}</td></tr>
                        <tr><th>Stok / Unit</th><td>: {{ $inventaris->stok ?? '1' }} {{ $inventaris->barangMasuk?->satuan ?? 'Unit' }}</td></tr>
                        <tr><th>Kondisi</th><td>: <span class="text-primary fw-bold">{{ $inventaris->kondisi }}</span></td></tr>
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('inventaris.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="{{ route('inventaris.edit', $inventaris->id) }}" class="btn btn-warning px-4">
                            <i class="fas fa-edit me-2"></i>Edit Data
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Label QR Code</h6>

                    @if($inventaris->kode_qr_jurusan)
                        <div id="printArea" class="p-3 border rounded bg-white mb-3">
                            {!! QrCode::size(150)->generate($inventaris->kode_qr_jurusan) !!}
                            <div class="mt-2">
                                <strong style="font-size: 12px; display: block;">
                                    {{ $inventaris->barangMasuk->nama_barang }}
                                </strong>
                                <span style="font-size: 10px; color: #666;">
                                    {{ $inventaris->kode_qr_jurusan }}
                                </span>
                            </div>
                        </div>


                        <button onclick="printLabel()" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-print me-2"></i>Cetak Label
                        </button>
                        <a href="{{ route('inventaris.generateQrBulk', $inventaris->barangMasuk->id) }}" class="btn btn-outline-danger btn-sm w-100" onclick="return confirm('Generate ulang akan membatalkan QR lama. Lanjutkan?')">
                            <i class="fas fa-sync me-2"></i>Regenerate QR
                        </a>
                    @else
                        <div class="py-4">
                            <i class="fas fa-qrcode fa-4x text-light mb-3"></i>
                            <p class="text-muted">QR Code belum dibuat</p>
                            <a href="{{ route('inventaris.generateQrBulk', $inventaris->barangMasuk->id) }}" class="btn btn-primary">
                                Buat QR Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function printLabel() {
        var printContents = document.getElementById('printArea').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = "<html><head><title>Print Label</title></head><body style='display:flex; justify-content:center; align-items:center; height:100vh; text-align:center;'>" + printContents + "</body></html>";
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload(); // Reload untuk mengembalikan state JS
    }
</script>
@endsection