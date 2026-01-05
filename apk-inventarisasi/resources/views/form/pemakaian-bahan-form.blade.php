@extends('be.layout')

@php
  $title = 'Pemakaian Bahan';
  $breadcrumb = 'Pemakaian';
@endphp

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">

    <div class="row mb-4">
        <div class="col-12">
            <p class="text-muted small">
                Form pemakaian bahan berdasarkan hasil scan QR
            </p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h6 class="mb-0">
                <i class="fas fa-flask me-2"></i>Pemakaian Bahan
            </h6>
        </div>

        <div class="card-body">

            {{-- INFO BAHAN --}}
            <h6 class="fw-bold mb-3">Informasi Bahan</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <small class="text-muted">Nama Bahan</small>
                    <div class="fw-bold">{{ $inventory->barangMasuk->nama_barang }}</div>
                </div>

                <div class="col-md-3">
                    <small class="text-muted">Merk</small>
                    <div class="fw-bold">
                        {{ $inventory->barangMasuk->merk ?? '-' }}
                    </div>
                </div>

                <div class="col-md-4">
                    <small class="text-muted">Jenis</small>
                    <div class="fw-bold">{{ strtoupper($inventory->barangMasuk->jenis_barang) }}</div>
                </div>
                <div class="col-md-4">
                    <small class="text-muted">Stok Tersedia</small>
                    <div class="fw-bold text-success">
                        {{ $inventory->stok }}
                    </div>
                </div>
            </div>

            <hr>

            {{-- FORM --}}
            <form action="{{ route('pemakaian-bahan.store') }}" method="POST">
                @csrf

                <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nama Siswa</label>
                        <select
                            name="siswa_id"
                            class="form-select select-siswa"
                            required>
                            <option value="">-- Ketik atau pilih siswa --</option>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id }}">
                                    {{ $siswa->nama }} ({{ $siswa->kelas }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Jumlah Dipakai</label>
                        <input type="number" name="jumlah" min="1"
                               class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Jam Pemakaian</label>
                        <input type="text" class="form-control"
                               value="{{ now()->format('H:i') }}" readonly>
                    </div>

                </div>

                <div class="mt-4 text-end">
                    <button class="btn btn-success px-4">
                        <i class="fas fa-check me-1"></i>Konfirmasi Pemakaian
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>


@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    $('.select-siswa').select2({
        placeholder: "Ketik atau pilih nama siswa",
        allowClear: true,
        width: '100%'
    });
});
</script>
@endpush

@endsection

@section('footer')
    @include('be.footer')
@endsection
