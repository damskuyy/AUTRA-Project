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

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Buat Transaksi Massal</h4>
            <span class="text-muted small">
                <i class="fas fa-layer-group me-1"></i>
                Pilih siswa dan inventaris yang digunakan
            </span>
        </div>
        <a href="{{ route('transaksi.massal.index') }}" class="btn btn-secondary rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    {{-- Card Form --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('transaksi.massal.store') }}" method="POST">
                @csrf

                {{-- Siswa --}}
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

                {{-- Tabs --}}
                <ul class="nav nav-tabs mb-4" id="inventarisTabs" role="tablist" style="border-radius: 15px;">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="alat-tab" data-bs-toggle="tab" data-bs-target="#tabAlat" type="button">
                            <i class="fas fa-tools me-2"></i>Alat
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="bahan-tab" data-bs-toggle="tab" data-bs-target="#tabBahan" type="button">
                            <i class="fas fa-flask me-2"></i>Bahan
                        </button>
                    </li>
                </ul>

                <div class="tab-content">

                    {{-- Alat --}}
                    <div class="tab-pane fade show active" id="tabAlat">
                        @forelse($inventarisAlat as $inv)
                        <div class="form-check border rounded-3 p-2 mb-2">
                            <input class="form-check-input" type="checkbox"
                                name="inventaris_ids[]"
                                value="{{ $inv->id }}"
                                id="inv{{ $inv->id }}">
                            <label class="form-check-label ms-1" for="inv{{ $inv->id }}">
                                <strong>{{ $inv->barangMasuk->nama_barang }}</strong>
                                <br>
                                <small class="text-muted">
                                    {{ $inv->barangMasuk->merk ?? '-' }} • QR: {{ $inv->kode_qr_jurusan }}
                                </small>
                            </label>
                        </div>
                        @empty
                            <p class="text-muted">Tidak ada alat tersedia.</p>
                        @endforelse
                    </div>

                    {{-- Bahan --}}
                    <div class="tab-pane fade" id="tabBahan">
                        @forelse($inventarisBahan as $inv)
                        <div class="border rounded-3 p-3 mb-2">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <strong>{{ $inv->barangMasuk->nama_barang }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        Stok: {{ $inv->stok }} {{ $inv->barangMasuk->satuan }}
                                    </small>
                                </div>
                                <div class="col-md-4">
                                    <input type="number"
                                        name="jumlah[{{ $inv->id }}]"
                                        class="form-control"
                                        min="0"
                                        max="{{ $inv->stok }}"
                                        placeholder="Jumlah">
                                </div>
                            </div>
                        </div>
                        @empty
                            <p class="text-muted">Tidak ada bahan tersedia.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Jam Kembali --}}
                <div class="mt-4 col-md-4">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-clock me-1"></i> Jam Kembali
                    </label>
                    <input type="time" name="jam_kembali" class="form-control" required>
                </div>

                {{-- Keperluan --}}
                <div class="mt-4 col-md-6">
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

                {{-- Catatan --}}
                <div class="mt-3">
                    <label class="form-label">
                        <i class="fas fa-sticky-note me-1"></i> Catatan (opsional)
                    </label>
                    <textarea name="catatan" class="form-control" rows="2"></textarea>
                </div>

                {{-- Submit --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-paper-plane me-1"></i> Submit Transaksi
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Terjadi kesalahan',
        html: '{!! implode("<br>", $errors->all()) !!}'
    });
</script>
@endif
@endpush
