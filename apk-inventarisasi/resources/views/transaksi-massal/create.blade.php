@extends('be.layout')

@php
    $title = 'Transaksi Massal Baru';
    $breadcrumb = 'Transaksi Massal';
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
            <div class="card border-0 shadow-sm bg-gradient-primary">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 fw-bold text-white">
                            <i class="fas fa-layer-group me-2"></i>
                            Transaksi Massal Baru
                        </h4>
                        <p class="mb-0 text-sm text-white opacity-8">
                            Pilih siswa dan inventaris yang digunakan
                        </p>
                    </div>

                    <a href="{{ route('transaksi.massal.index') }}"
                       class="btn btn-light btn-sm rounded-pill px-3">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= FORM ================= --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('transaksi.massal.store') }}" method="POST">
                @csrf

                {{-- ================= SISWA ================= --}}
                <div class="mb-4 col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-user-graduate me-1"></i> Nama Siswa
                    </label>
                    <select name="siswa_id" class="form-select select-siswa" required>
                        <option value="">-- Ketik atau pilih siswa --</option>
                        @foreach ($siswas as $siswa)
                            <option value="{{ $siswa->id }}">
                                {{ $siswa->nama }} ({{ $siswa->kelas }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ================= TABS ================= --}}
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabAlat">
                            <i class="fas fa-tools me-2"></i>Alat
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabBahan">
                            <i class="fas fa-flask me-2"></i>Bahan
                        </button>
                    </li>
                </ul>

                <div class="tab-content">

                    {{-- ================= ALAT ================= --}}
                    <div class="tab-pane fade show active" id="tabAlat">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">

                                <h5 class="fw-bold text-primary mb-2">Pilih Alat</h5>

                                <div class="mb-3">
                                    <select id="filterRakAlat" class="form-select form-select-sm w-25">
                                        <option value="">Semua Rak</option>
                                        @foreach($rakInventories as $rak)
                                            @if(isset($rakLabels[$rak]))
                                                <option value="{{ $rak }}">
                                                    {{ $rak }} — {{ $rakLabels[$rak] }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>

                                @forelse($inventarisAlat as $inv)
                                    <div class="form-check border rounded-3 p-3 mb-2 inventaris-alat"
                                        data-rak="{{ $inv->penempatan_rak }}">

                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="inventaris_ids[]"
                                            value="{{ $inv->id }}"
                                            id="inv{{ $inv->id }}">

                                        <label class="form-check-label ms-2 w-100" for="inv{{ $inv->id }}">
                                            <div class="fw-semibold">
                                                {{ $inv->barangMasuk->nama_barang }}
                                            </div>
                                            <div class="text-muted small">
                                                {{ $inv->barangMasuk->merk ?? '-' }}
                                                • Rak:
                                                <strong>
                                                    {{ $inv->penempatan_rak
                                                        ? ($rakLabels[$inv->penempatan_rak] ?? $inv->penempatan_rak)
                                                        : 'Tanpa Rak' }}
                                                </strong>
                                                 • {{ $inv->kode_qr_jurusan }}
                                            </div>
                                        </label>
                                    </div>
                                @empty
                                    <p class="text-muted">Tidak ada alat.</p>
                                @endforelse


                            </div>
                        </div>
                    </div>

                    {{-- ================= BAHAN ================= --}}
                    <div class="tab-pane fade" id="tabBahan">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">

                                <h5 class="fw-bold text-primary mb-2">Pilih Bahan</h5>

                                <div class="mb-3">
                                    <select id="filterRakBahan" class="form-select form-select-sm w-25">
                                        <option value="">Semua Rak</option>
                                        @foreach($rakInventories as $rak)
                                            @if(isset($rakLabels[$rak]))
                                                <option value="{{ $rak }}">
                                                    {{ $rak }} — {{ $rakLabels[$rak] }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>

                                @forelse($inventarisBahan as $inv)
                                    <div class="border rounded-3 p-3 mb-2 inventaris-bahan"
                                        data-rak="{{ $inv->penempatan_rak }}">

                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <div class="fw-semibold">
                                                    {{ $inv->barangMasuk->nama_barang }}
                                                </div>
                                                <small class="text-muted">
                                                    Stok: {{ $inv->stok }} {{ $inv->barangMasuk->satuan }}
                                                    • Rak:
                                                    <strong>
                                                        {{ $inv->penempatan_rak
                                                            ? ($rakLabels[$inv->penempatan_rak] ?? $inv->penempatan_rak)
                                                            : 'Tanpa Rak' }}
                                                    </strong>
                                                </small>
                                            </div>

                                            <div class="col-md-4">
                                                <input type="number"
                                                    name="jumlah[{{ $inv->id }}]"
                                                    class="form-control"
                                                    min="0"
                                                    max="{{ $inv->stok }}">
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">Tidak ada bahan.</p>
                                @endforelse


                            </div>
                        </div>
                    </div>

                </div>

                {{-- ================= JAM & KEPERLUAN ================= --}}
                <div class="row mt-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Jam Kembali</label>
                        <input type="time" name="jam_kembali" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Keperluan</label>
                        <select name="keperluan" id="keperluanSelect" class="form-select">
                            <option value="">-- pilih --</option>
                            <option value="Kelistrikan / Bu Isri">Kelistrikan / Bu Isri</option>
                            <option value="Elektronika / Pak Budi">Elektronika / Pak Budi</option>
                            <option value="__manual">Lainnya</option>
                        </select>

                        <input type="text"
                               name="keperluan_manual"
                               id="keperluanManual"
                               class="form-control mt-2 d-none">
                    </div>
                </div>

                {{-- ================= SUBMIT ================= --}}
                <div class="mt-4 text-end">
                    <button class="btn btn-primary px-4">
                        <i class="fas fa-paper-plane me-1"></i> Submit
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    function setupRakFilter(selectId, itemSelector) {
        const select = document.getElementById(selectId);
        const items  = document.querySelectorAll(itemSelector);

        if (!select) return;

        select.addEventListener('change', () => {
            items.forEach(item => {
                item.style.display =
                    (!select.value || item.dataset.rak === select.value)
                        ? ''
                        : 'none';
            });
        });
    }

    setupRakFilter('filterRakAlat', '.inventaris-alat');
    setupRakFilter('filterRakBahan', '.inventaris-bahan');
});
</script>
@endpush
