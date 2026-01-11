@extends ('be.layout')

@php
  $title = 'Pengembalian Alat';
  $breadcrumb = 'Pengembalian';
@endphp

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-success">
                <div class="card-body">
                    <h4 class="mb-1 fw-bold text-white">
                        <i class="fas fa-rotate-left me-2"></i> Pengembalian Alat
                    </h4>
                    <p class="mb-0 text-sm text-white opacity-8">
                        Konfirmasi pengembalian alat oleh siswa
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- INFO ALAT -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <h6 class="fw-bold mb-3 text-uppercase text-secondary">
                        Informasi Peminjaman
                    </h6>

                    <ul class="list-group list-group-flush text-sm">
                        <li class="list-group-item px-0">
                            <strong>Alat</strong><br>
                            {{ $peminjaman->inventory->barangMasuk->nama_barang }}
                        </li>

                        <li class="list-group-item px-0">
                            <strong>Jumlah</strong><br>
                            {{ $peminjaman->quantity }}
                        </li>

                        <li class="list-group-item px-0">
                            <strong>Peminjam</strong><br>
                            {{ $peminjaman->siswa->nama }}
                        </li>

                        <li class="list-group-item px-0">
                            <strong>Kelas</strong><br>
                            <span class="badge bg-secondary">
                                {{ $peminjaman->siswa->kelas }}
                            </span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

        <!-- FORM PENGEMBALIAN -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <h6 class="fw-bold mb-3 text-uppercase text-secondary">
                        Form Pengembalian
                    </h6>

                    <form action="{{ route('pengembalian.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="quantity" value="{{ $peminjaman->quantity }}">
                        <input type="hidden" name="peminjaman_id" value="{{ $peminjaman->id }}">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Kondisi Saat Dikembalikan
                            </label>
                            <select name="kondisi" class="form-select" required>
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="BAIK">Baik</option>
                                <option value="RUSAK_RINGAN">Rusak Ringan</option>
                                <option value="RUSAK_BERAT">Rusak Berat</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Catatan (Opsional)
                            </label>
                            <textarea name="catatan"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button class="btn btn-success">
                                <i class="fas fa-check me-1"></i> Konfirmasi Pengembalian
                            </button>

                            <a href="{{ url()->previous() }}"
                               class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@section('footer')
    @include('be.footer')
@endsection
