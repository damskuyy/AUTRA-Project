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
    <div class="card shadow border-0">

        {{-- CARD HEADER --}}
        <div class="card-header bg-info text-white py-3">
            <h6 class="mb-0">
                <i class="fas fa-flask me-2"></i>Data Pemakaian Bahan
            </h6>
        </div>

        <div class="card-body p-4">

            {{-- INFO BAHAN --}}
            <div class="bg-light rounded p-3 mb-4">
                <h6 class="fw-bold mb-3">Informasi Bahan</h6>

                <div class="row g-3">
                    <div class="col-md-3">
                        <small class="text-muted">Nama Bahan</small>
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
                        <small class="text-muted">Jenis</small>
                        <div class="fw-semibold text-uppercase">
                            {{ $inventory->barangMasuk->jenis_barang }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <small class="text-muted">Stok Tersedia</small>
                        <div class="fw-bold text-success fs-5">
                            {{ $inventory->stok }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORM --}}
            <form action="{{ route('pemakaian-bahan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Siswa</label>
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

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Keperluan (Mapel / Guru)</label>

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

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Jumlah Dipakai</label>
                        <input type="number" name="jumlah" min="1"
                               class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Jam Pemakaian</label>
                        <input type="text" class="form-control bg-light"
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
    //SELECT SISWA
    $('.select-siswa').select2({
        placeholder: "Ketik atau pilih nama siswa",
        allowClear: true,
        width: '100%'
    });

    //KEPERLUAN MANUAL
    const keperluanSelect = document.getElementById('keperluanSelect');
    const keperluanManual = document.getElementById('keperluanManual');

    if (keperluanSelect && keperluanManual) {
        keperluanSelect.addEventListener('change', function () {
            keperluanManual.classList.toggle(
                'd-none',
                this.value !== '__manual'
            );
        });
    }
});
</script>
@endpush

@endsection

@section('footer')
    @include('be.footer')
@endsection
