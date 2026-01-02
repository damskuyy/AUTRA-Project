@extends('be.layout')

@php
  $title = 'Peminjaman Alat';
  $breadcrumb = 'Peminjaman';
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
                Form peminjaman alat berdasarkan hasil scan QR
            </p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h6 class="mb-0">
                <i class="fas fa-tools me-2"></i>Peminjaman Alat
            </h6>
        </div>

        <div class="card-body">

            {{-- INFO ALAT --}}
            <h6 class="fw-bold mb-3">Informasi Alat</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <small class="text-muted">Nama Alat</small>
                    <div class="fw-bold">{{ $inventory->nama }}</div>
                </div>
                <div class="col-md-4">
                    <small class="text-muted">Kode Inventaris</small>
                    <div class="fw-bold">{{ $inventory->kode }}</div>
                </div>
                <div class="col-md-4">
                    <small class="text-muted">Status</small>
                    <div class="fw-bold text-success">
                        {{ $inventory->status }}
                    </div>
                </div>
            </div>

            <hr>

            {{-- JIKA SEDANG DIPINJAM --}}
            @if($peminjamanAktif)
                <div class="alert alert-danger">
                    <strong>Alat sedang dipinjam</strong><br>
                    Oleh: {{ $peminjamanAktif->nama_siswa }}
                </div>
            @else

            {{-- FORM --}}
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf

                <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nama Siswa</label>
                        <input type="text" name="nama_siswa"
                               class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Jam Peminjaman</label>
                        <input type="text" class="form-control"
                               value="{{ now()->format('H:i') }}" readonly>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Estimasi Kembali</label>
                        <input type="time" class="form-control">
                    </div>

                </div>

                <div class="mt-4 text-end">
                    <button class="btn btn-success px-4">
                        <i class="fas fa-check me-1"></i>Konfirmasi Peminjaman
                    </button>
                </div>

            </form>
            @endif

        </div>
    </div>

</div>
@endsection

@section('footer')
    @include('be.footer')
@endsection
