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
            <h4 class="fw-bold mb-0">Buat Transaksi Massal</h4>
            <small class="text-muted">Pilih alat/bahan dan siswa</small>
        </div>
        <a href="{{ route('transaksi.massal.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm p-4">
        <form action="{{ route('transaksi.massal.store') }}" method="POST">
            @csrf

            <div class="col-md-6">
                <label class="form-label fw-semibold">Nama Siswa</label>
                <select name="siswa_id"
                    class="form-select select-siswa" required>
                    <option value="">-- Ketik atau pilih siswa --</option>
                    @foreach ($siswas as $siswa)
                        <option value="{{ $siswa->id }}">
                            {{ $siswa->nama }} ({{ $siswa->kelas }})
                        </option>
                    @endforeach
                </select>
            </div>
            <br></br>

            {{-- Tabs Alat & Bahan --}}
            <ul class="nav nav-tabs" id="tabInventaris" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="alat-tab" data-bs-toggle="tab" data-bs-target="#tabAlat" type="button">Alat</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="bahan-tab" data-bs-toggle="tab" data-bs-target="#tabBahan" type="button">Bahan</button>
                </li>
            </ul>

            <div class="tab-content mt-3">
                {{-- Tab Alat --}}
                <div class="tab-pane fade show active" id="tabAlat" role="tabpanel">
                    @forelse($inventarisAlat as $inv)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="inventaris_ids[]" value="{{ $inv->id }}" id="inv{{ $inv->id }}">
                        <label class="form-check-label" for="inv{{ $inv->id }}">
                            {{ $inv->barangMasuk->nama_barang }} - {{ $inv->barangMasuk->merk ?? '-' }} ({{ $inv->kode_qr_jurusan }})
                        </label>
                    </div>
                    @empty
                    <p class="text-muted">Tidak ada alat tersedia.</p>
                    @endforelse
                </div>

                {{-- Tab Bahan --}}
                <div class="tab-pane fade" id="tabBahan" role="tabpanel">
                    @forelse($inventarisBahan as $inv)
                        <div class="row align-items-center mb-2">
                            <div class="col-md-6">
                                <strong>{{ $inv->barangMasuk->nama_barang }}</strong>
                                <small class="text-muted">
                                    (stok: {{ $inv->stok }} {{ $inv->barangMasuk->satuan }})
                                </small>
                            </div>
                            <div class="col-md-3">
                                <input type="number"
                                    name="jumlah[{{ $inv->id }}]"
                                    class="form-control"
                                    min="0"
                                    max="{{ $inv->stok }}"
                                    placeholder="Jumlah">
                            </div>
                        </div>
                    @empty
                    <p class="text-muted">Tidak ada bahan tersedia.</p>
                    @endforelse
                </div>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Jam Kembali</label>
                <input type="time" name="jam_kembali" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Catatan (opsional)</label>
                <textarea name="catatan" class="form-control" rows="2"></textarea>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-1"></i> Submit Massal</button>
        </form>
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
