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

    {{-- ================= HEADER CARD ================= --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-primary rounded-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="fw-bold text-white mb-1">
                            <i class="fas fa-tools me-2"></i> Form Peminjaman Alat
                        </h5>
                        <p class="text-white opacity-8 mb-0 small">
                            Isi data peminjaman alat oleh siswa
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= MAIN CARD ================= --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            {{-- ================= INFO ALAT ================= --}}
            <div class="mb-4">
                <h6 class="fw-bold mb-3 text-primary">
                    <i class="fas fa-info-circle me-1"></i> Informasi Alat
                </h6>

                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="border rounded-3 p-3 h-100 bg-light">
                            <small class="text-muted">Nama Alat</small>
                            <div class="fw-semibold">
                                {{ $inventory->barangMasuk->nama_barang }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="border rounded-3 p-3 h-100 bg-light">
                            <small class="text-muted">Merk</small>
                            <div class="fw-semibold">
                                {{ $inventory->barangMasuk->merk ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="border rounded-3 p-3 h-100 bg-light">
                            <small class="text-muted">Kode QR</small>
                            <div class="fw-semibold">
                                {{ $inventory->kode_qr_jurusan }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="border rounded-3 p-3 h-100 bg-light">
                            <small class="text-muted">Status</small>
                            <div class="fw-bold text-success">
                                {{ $inventory->status }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= FORM ================= --}}
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
                <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">

                <div class="row g-3">

                    {{-- SISWA --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-user-graduate me-1"></i> Nama Siswa
                        </label>
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

                    {{-- KEPERLUAN --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-book me-1"></i> Keperluan (Mapel / Guru)
                        </label>

                        <select name="keperluan" id="keperluanSelect" class="form-select">
                            <option value="">-- pilih keperluan --</option>
                            <option value="Kelistrikan / Bu Isri">Kelistrikan / Bu Isri</option>
                            <option value="Elektronika / Pak Budi">Elektronika / Pak Budi</option>
                            <option value="__manual">Lainnya</option>
                        </select>

                        <input type="text"
                               name="keperluan_manual"
                               id="keperluanManual"
                               class="form-control mt-2 d-none"
                               placeholder="Contoh: Kelistrikan / Bu Isri">
                    </div>

                    {{-- JAM PINJAM --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-clock me-1"></i> Jam Peminjaman
                        </label>
                        <input type="text"
                               class="form-control bg-light"
                               value="{{ now('Asia/Jakarta')->format('H:i') }}"
                               readonly>
                    </div>

                    {{-- JUMLAH --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-sort-numeric-up me-1"></i> Jumlah Dipinjam
                        </label>
                        <input type="number"
                               class="form-control bg-light"
                               value="1"
                               readonly>
                        <input type="hidden" name="quantity" value="1">
                    </div>

                    {{-- ESTIMASI KEMBALI --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-hourglass-end me-1"></i> Estimasi Kembali
                        </label>
                        <input type="time"
                               name="waktu_kembali_aktual"
                               class="form-control"
                               required>
                    </div>

                    {{-- KONDISI --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-clipboard-check me-1"></i> Kondisi Saat Dipinjam
                        </label>
                        <input type="text"
                               class="form-control bg-light"
                               value="{{ $inventory->kondisi }}"
                               readonly>
                        <input type="hidden"
                               name="kondisi_saat_dipinjam"
                               value="{{ $inventory->kondisi }}">
                    </div>

                    {{-- CATATAN --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-sticky-note me-1"></i> Catatan Peminjaman
                        </label>
                        <textarea name="catatan_pinjam"
                                  class="form-control"
                                  rows="2"
                                  placeholder="Catatan kondisi / keperluan"></textarea>
                    </div>

                </div>

                {{-- SUBMIT --}}
                <div class="mt-4 text-end">
                    <button class="btn btn-success rounded-pill px-4">
                        <i class="fas fa-check me-1"></i> Konfirmasi Peminjaman
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

    const keperluanSelect = document.getElementById('keperluanSelect');
    const keperluanManual = document.getElementById('keperluanManual');

    if (keperluanSelect && keperluanManual) {
        keperluanSelect.addEventListener('change', function () {
            keperluanManual.classList.toggle('d-none', this.value !== '__manual');
        });
    }
});
</script>
@endpush

@endsection

@section('footer')
    @include('be.footer')
@endsection
