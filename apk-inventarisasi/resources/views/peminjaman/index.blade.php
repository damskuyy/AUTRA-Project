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

    {{-- TITLE --}}
    <div class="row mb-4">
        <div class="col-12">
            <p class="text-muted small">Proses peminjaman berdasarkan hasil scan QR</p>
        </div>
    </div>

    {{-- ===================================== --}}
    {{--   MODE 1 : ALAT AVAILABLE             --}}
    {{-- ===================================== --}}

    <div class="card shadow-sm mb-5" id="modeAvailable">
        <div class="card-header bg-success text-white">
            <h6 class="mb-0"><i class="fas fa-check-circle me-2"></i>Alat Tersedia (AVAILABLE)</h6>
        </div>
        <div class="card-body">

            {{-- Info Alat --}}
            <div class="mb-4">
                <h6 class="fw-bold mb-3">Informasi Alat</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <small class="text-muted">Nama Alat</small>
                        <div class="fw-bold">Mikroskop</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Seri</small>
                        <div class="fw-bold">MSK-221</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Nomor Inventaris</small>
                        <div class="fw-bold">ALT-0021</div>
                    </div>
                </div>
            </div>

            <hr>

            {{-- Form Peminjaman --}}
            <h6 class="fw-bold mt-3">Form Peminjaman</h6>

            <div class="row g-3 mt-1">

                <div class="col-md-6">
                    <label class="form-label">Nama Siswa</label>
                    <select class="form-control">
                        <option selected disabled>Pilih siswa...</option>
                        <option>Aldi Ramadhan</option>
                        <option>Dewi Lestari</option>
                        <option>Budi Prasetyo</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Kelas</label>
                    <input type="text" class="form-control" value="XII RPL 2" readonly>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Jam Peminjaman</label>
                    <input type="text" class="form-control" value="{{ date('H:i') }}" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Estimasi Pengembalian (opsional)</label>
                    <input type="time" class="form-control">
                </div>

                <div class="col-md-8">
                    <label class="form-label">Kondisi Alat Saat Dipinjam</label>
                    <input type="text" class="form-control" placeholder="Contoh: Bersih, normal, lengkap">
                </div>

            </div>

            <div class="mt-4 text-end">
                <button class="btn btn-primary px-4">
                    <i class="fas fa-check me-1"></i> Konfirmasi Peminjaman
                </button>
            </div>
        </div>
    </div>



    {{-- ===================================== --}}
    {{--   MODE 2 : ALAT DIPINJAM              --}}
    {{-- ===================================== --}}

    <div class="card shadow-sm" id="modeDipinjam">
        <div class="card-header bg-danger text-white">
            <h6 class="mb-0"><i class="fas fa-exclamation-circle me-2"></i>Alat Sedang Dipinjam</h6>
        </div>
        <div class="card-body">

            {{-- Info Alat --}}
            <div class="mb-4">
                <h6 class="fw-bold mb-3">Informasi Alat</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <small class="text-muted">Nama Alat</small>
                        <div class="fw-bold">Mikroskop</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Seri</small>
                        <div class="fw-bold">MSK-221</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Nomor Inventaris</small>
                        <div class="fw-bold">ALT-0021</div>
                    </div>
                </div>
            </div>

            <hr>

            {{-- Info Peminjam --}}
            <h6 class="fw-bold mt-3">Informasi Peminjam</h6>

            <div class="row g-3 mt-1">
                <div class="col-md-4">
                    <small class="text-muted">Nama Peminjam</small>
                    <div class="fw-bold">Aldi Ramadhan</div>
                </div>

                <div class="col-md-4">
                    <small class="text-muted">Kelas</small>
                    <div class="fw-bold">XII RPL 2</div>
                </div>

                <div class="col-md-4">
                    <small class="text-muted">Jam Peminjaman</small>
                    <div class="fw-bold">08:30</div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <button class="btn btn-success px-4">
                    <i class="fas fa-undo me-1"></i> Kembalikan Alat
                </button>
            </div>
        </div>
    </div>

</div>

{{-- SCRIPT DEMO: gunakan salah satu mode --}}
<script>
// Pilih mode mana yang tampil
// Mode 1: Available
// Mode 2: Dipinjam

let alatStatus = "AVAILABLE";  // ubah ke "DIPINJAM" untuk melihat mode lain

document.addEventListener("DOMContentLoaded", () => {
    if (alatStatus === "AVAILABLE") {
        document.getElementById("modeAvailable").classList.remove("d-none");
        document.getElementById("modeDipinjam").classList.add("d-none");
    } else {
        document.getElementById("modeDipinjam").classList.remove("d-none");
        document.getElementById("modeAvailable").classList.add("d-none");
    }
});
</script>

@endsection

@section('footer')
    @include('be.footer')
@endsection