@extends('be.layout')

@php
  $title = 'Edit Inventaris';
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

    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <a href="{{ route('inventaris.index') }}" class="btn btn-secondary px-4">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Card Content -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('inventaris.update', $inventaris) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <!-- Barang Masuk -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pilih Barang</label>
                        <select name="barang_masuk_id" class="form-select" required>
                            <option value="">-- Pilih Barang --</option>
                            @if($inventaris->barangMasuk?->jenis_barang == 'bahan')
                                @foreach ($barangMasukBahan as $b)
                                    <option value="{{ $b->id }}" {{ $inventaris->barang_masuk_id == $b->id ? 'selected' : '' }}>
                                        {{ $b->nama_barang }} ({{ $b->jumlah }} {{ $b->satuan }})
                                    </option>
                                @endforeach
                            @else
                                @foreach ($barangMasukAlat as $a)
                                    <option value="{{ $a->id }}" {{ $inventaris->barang_masuk_id == $a->id ? 'selected' : '' }}>
                                        {{ $a->nama_barang }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            @foreach (['TERSEDIA','DIPINJAM','HILANG','DIPERBAIKI'] as $st)
                                <option value="{{ $st }}" 
                                    {{ $inventaris->status === $st ? 'selected' : '' }}>
                                    {{ $st }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kondisi -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kondisi</label>
                        <select name="kondisi" class="form-select" required>
                            @foreach (['BAIK','RUSAK_RINGAN','RUSAK_BERAT','HILANG','SEDANG DIPERBAIKI'] as $k)
                                <option value="{{ $k }}"
                                    {{ $inventaris->kondisi === $k ? 'selected' : '' }}>
                                    {{ $k }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Stok (untuk bahan) -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok"
                               value="{{ $inventaris->stok }}" class="form-control"
                               readonly>
                        <small class="text-muted">
                            Stok default alat adalah 1
                        </small>
                    </div>

                    <!-- QR -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kode QR</label>
                        <input type="text" name="kode_qr_jurusan" class="form-control"
                               value="{{ $inventaris->kode_qr_jurusan }}"
                               readonly>
                        <small class="text-muted">
                            Kode QR hanya dapat diubah saat menambah barang masuk baru.
                        </small>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary px-4 mt-3">
                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                </button>

            </form>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.querySelector('select[name="status"]');
    const kondisiSelect = document.querySelector('select[name="kondisi"]');

    statusSelect.addEventListener('change', function() {
        if (this.value === 'DIPERBAIKI') {
            kondisiSelect.value = 'SEDANG DIPERBAIKI';
        }
    });
});
</script>
@endpush

@section('footer')
    @include('be.footer')
@endsection
