@extends('be.layout')

@php
  $title = 'Detail Inventaris';
  $breadcrumb = 'Inventaris';

  $isSarpras = strtolower($inventaris->barangMasuk?->sumber ?? '') === 'sarpras';
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
        {{-- ================= LEFT : INFORMASI BARANG ================= --}}
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0">Informasi Barang</h5>

                        @php
                            $displayStatus = $inventaris->status;
                            if ($inventaris->barangMasuk?->jenis_barang === 'bahan' && $inventaris->stok <= 0) {
                                $displayStatus = 'HABIS';
                            }

                            $statusClass = match ($displayStatus) {
                                'TERSEDIA'   => 'bg-success',
                                'DIPINJAM'   => 'bg-warning',
                                'HILANG'     => 'bg-danger',
                                'DIPERBAIKI' => 'bg-info',
                                'HABIS'      => 'bg-danger',
                                default      => 'bg-secondary',
                            };
                        @endphp

                        <span class="badge {{ $statusClass }}">
                            {{ $displayStatus }}
                        </span>
                    </div>

                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Kategori</th>
                            <td>: <span class="badge bg-secondary text-uppercase">
                                {{ $inventaris->barangMasuk?->jenis_barang ?? '-' }}
                            </span></td>
                        </tr>

                        <tr>
                            <th>Tanggal Masuk</th>
                            <td>: {{ $inventaris->barangMasuk?->tanggal_masuk?->format('Y-m-d') }}</td>
                        </tr>

                        <tr>
                            <th>Nama Barang</th>
                            <td>: {{ $inventaris->barangMasuk?->nama_barang ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Merk</th>
                            <td>: {{ $inventaris->barangMasuk->merk ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Lokasi Penempatan</th>
                            <td>: {{ $inventaris->barangMasuk?->ruangan?->nama_ruangan ?? '-' }}</td>
                        </tr>

                        {{-- HILANG JIKA SARPRAS --}}
                        @if(!$isSarpras)
                        <tr>
                            <th>Penempatan Rak</th>
                            <td>: {{ $inventaris->penempatan_rak_label }}</td>
                        </tr>
                        @endif

                        <tr>
                            <th>Sumber Dana/Barang</th>
                            <td>: {{ $inventaris->barangMasuk?->sumber ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Stok/Unit</th>
                            <td>: {{ $inventaris->stok ?? 1 }} {{ $inventaris->barangMasuk?->satuan ?? 'Unit' }}</td>
                        </tr>

                        <tr>
                            <th>Kondisi</th>
                            <td>: <span class="fw-bold text-primary">{{ $inventaris->kondisi }}</span></td>
                        </tr>

                        {{-- KODE UNIK KHUSUS SARPRAS --}}
                        @if($isSarpras)
                        <tr>
                            <th>Kode Unik</th>
                            <td>: <span>
                                {{ $inventaris->barangMasuk->kode_unik }}
                            </span></td>
                        </tr>
                        @endif
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('inventaris.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>

                        @if($inventaris->barangMasuk?->jenis_barang !== 'bahan')
                        <a href="{{ route('inventaris.edit', $inventaris->id) }}" class="btn btn-warning px-4">
                            <i class="fas fa-edit me-2"></i>Edit Data
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= RIGHT : QR / KODE ================= --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Label Inventaris</h6>

                    {{-- SARPRAS --}}
                    @if($isSarpras)
                        <div class="py-4">
                            <i class="fas fa-ban fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-2">QR Code dan kode unik dari <strong>Sarpras Pusat</strong></p>

                            <div class="mt-3">
                                <span class="badge bg-secondary px-4 py-2">
                                    {{ $inventaris->barangMasuk->kode_unik }}
                                </span>
                            </div>
                        </div>

                    {{--NON SARPRAS --}}
                    @else
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
                        @else
                            <div class="py-4">
                                <i class="fas fa-qrcode fa-4x text-light mb-3"></i>
                                <p class="text-muted">QR Code belum dibuat</p>
                                <a href="{{ route('inventaris.generateQrBulk', $inventaris->barangMasuk->id) }}"
                                   class="btn btn-primary">
                                    Buat QR Sekarang
                                </a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- PRINT --}}
<script>
function printLabel() {
    const printContents = document.getElementById('printArea').innerHTML;
    const originalContents = document.body.innerHTML;

    document.body.innerHTML =
        "<html><head><title>Print</title></head><body style='display:flex;justify-content:center;align-items:center;height:100vh'>" +
        printContents +
        "</body></html>";

    window.print();
    document.body.innerHTML = originalContents;
    window.location.reload();
}
</script>
@endsection
