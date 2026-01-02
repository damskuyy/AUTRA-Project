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
                    <div class="fw-bold">{{ $inventory->nama }}</div>
                </div>
                <div class="col-md-4">
                    <small class="text-muted">Jenis</small>
                    <div class="fw-bold">{{ $inventory->jenis }}</div>
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
                        <input type="text" name="nama_siswa" class="form-control"
                               placeholder="Masukkan nama siswa" required>
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
@endsection

@section('footer')
    @include('be.footer')
@endsection
