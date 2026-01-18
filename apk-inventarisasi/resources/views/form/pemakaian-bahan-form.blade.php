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

    {{-- ================= HEADER ================= --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-info rounded-4">
                <div class="card-body">
                    <h5 class="fw-bold text-white mb-1">
                        <i class="fas fa-flask me-2"></i> Pemakaian Bahan
                    </h5>
                    <p class="text-white opacity-8 mb-0 small">
                        Pencatatan penggunaan bahan oleh siswa
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= MAIN CARD ================= --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            {{-- ================= INFO BAHAN ================= --}}
            <div class="mb-4">
                <h6 class="fw-bold text-info mb-3">
                    <i class="fas fa-info-circle me-1"></i> Informasi Bahan
                </h6>

                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="border rounded-3 p-3 h-100 bg-light">
                            <small class="text-muted">Nama Bahan</small>
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
                            <small class="text-muted">Jenis</small>
                            <div class="fw-semibold text-uppercase">
                                {{ $inventory->barangMasuk->jenis_barang }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="border rounded-3 p-3 h-100 bg-light">
                            <small class="text-muted">Stok Tersedia</small>
                            <div class="fw-bold text-success fs-5">
                                {{ $inventory->stok }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= FORM ================= --}}
            <form action="{{ route('pemakaian-bahan.store') }}" method="POST">
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
                            <option value="">-- Ketik atau pilih siswa --</option>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id }}">
                                    {{ $siswa->nama }} ({{ $siswa->kelas }})
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

                    {{-- JUMLAH --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-sort-numeric-up me-1"></i> Jumlah Dipakai
                        </label>
                        <input type="number"
                               name="jumlah"
                               min="1"
                               class="form-control"
                               required>
                    </div>

                    {{-- JAM --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-clock me-1"></i> Jam Pemakaian
                        </label>
                        <input type="text"
                               class="form-control bg-light"
                               value="{{ now()->format('H:i') }}"
                               readonly>
                    </div>

                </div>

                {{-- SUBMIT --}}
                <div class="mt-4 text-end">
                    <button class="btn btn-success rounded-pill px-4">
                        <i class="fas fa-check me-1"></i> Konfirmasi Pemakaian
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

    // ================= VALIDASI STOK =================
    const stokTersedia = {{ $inventory->stok }};
    const inputJumlah = document.querySelector('input[name="jumlah"]');

    // Cek stok saat halaman dimuat
    if (stokTersedia === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Stok Habis',
            text: 'Stok bahan ini sudah habis dan tidak dapat digunakan.',
            confirmButtonText: 'Kembali',
            allowOutsideClick: false
        }).then(() => {
            window.history.back();
        });
        return; // Stop eksekusi selanjutnya
    }

    // Validasi real-time saat input jumlah
    if (inputJumlah) {
        inputJumlah.addEventListener('input', function () {
            const jumlahInput = parseInt(this.value) || 0;

            if (jumlahInput > stokTersedia) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Stok Tidak Mencukupi',
                    text: `Jumlah yang diminta (${jumlahInput}) melebihi stok tersedia (${stokTersedia}).`,
                    confirmButtonText: 'OK'
                });
                this.value = stokTersedia; // Set ke maksimal stok
            }
        });

        // Validasi saat form disubmit
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function (e) {
                const jumlahInput = parseInt(inputJumlah.value) || 0;

                if (jumlahInput > stokTersedia) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Stok Tidak Mencukupi',
                        text: `Jumlah yang diminta (${jumlahInput}) melebihi stok tersedia (${stokTersedia}).`,
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    }
});
</script>

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ session('error') }}",
            confirmButtonText: 'OK'
        });
    });
</script>
@endif

@endpush

@endsection

@section('footer')
    @include('be.footer')
@endsection
