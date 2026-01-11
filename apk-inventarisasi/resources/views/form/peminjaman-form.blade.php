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
    <div class="card shadow border-0">

        {{-- HEADER --}}
        <div class="card-header bg-primary text-white py-3">
            <h6 class="mb-0">
                <i class="fas fa-tools me-2"></i>Data Peminjaman Alat
            </h6>
        </div>

        <div class="card-body p-4">

            {{-- INFO ALAT --}}
            <div class="bg-light rounded p-3 mb-4">
                <h6 class="fw-bold mb-3">Informasi Alat</h6>

                <div class="row g-3">
                    <div class="col-md-3">
                        <small class="text-muted">Nama Alat</small>
                        <div class="fw-semibold">
                            {{ $inventory->barangMasuk->nama_barang }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <small class="text-muted">Merk</small>
                        <div class="fw-semibold">
                            {{ $inventory->barangMasuk->merk ?? '-' }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <small class="text-muted">Kode Inventaris</small>
                        <div class="fw-semibold">
                            {{ $inventory->nomor_inventaris ?? '-' }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <small class="text-muted">Status</small>
                        <div class="fw-bold text-success">
                            {{ $inventory->status }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- JIKA DIPINJAM --}}
            @if($peminjamanAktif)
                <div class="alert alert-danger">
                    <strong>Alat sedang dipinjam</strong><br>
                    Oleh: {{ $peminjamanAktif->siswa->nama }}
                </div>
            @else

            {{-- FORM --}}
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
                <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Siswa</label>
                        <select name="siswa_id"
                                class="form-select select-siswa"
                                required>
                            <option value="">-- Pilih siswa --</option>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id }}">
                                    {{ $siswa->nama }} - {{ $siswa->kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Jam Peminjaman</label>
                        <input type="text" class="form-control bg-light"
                               value="{{ now('Asia/Jakarta')->format('H:i') }}" readonly>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Jumlah Dipinjam</label>
                        <input type="number"
                               name="quantity"
                               class="form-control"
                               min="1"
                               max="{{ $inventory->stok }}"
                               required>
                        <small class="text-muted">
                            Stok tersedia: {{ $inventory->stok }}
                        </small>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Estimasi Kembali</label>
                        <input type="time"
                               name="waktu_kembali_aktual"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Kondisi Saat Dipinjam</label>
                        <select name="kondisi_pinjam"
                                class="form-select"
                                required>
                            <option value="">-- Pilih kondisi --</option>
                            <option value="BAIK">Baik</option>
                            <option value="RUSAK_RINGAN">Rusak Ringan</option>
                            <option value="RUSAK_BERAT">Rusak Berat</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Catatan Peminjaman</label>
                        <textarea name="catatan_pinjam"
                                  class="form-control"
                                  rows="2"
                                  placeholder="Catatan kondisi / keperluan"></textarea>
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
