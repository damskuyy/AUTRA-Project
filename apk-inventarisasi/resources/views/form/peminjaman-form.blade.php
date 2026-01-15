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
                        <label class="form-label fw-semibold">Jam Peminjaman</label>
                        <input type="text" class="form-control bg-light"
                               value="{{ now('Asia/Jakarta')->format('H:i') }}" readonly>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Jumlah Dipinjam</label>
                        <input type="number"
                               class="form-control bg-light"
                               value="1"
                               readonly>
                        <input type="hidden"
                               name="quantity"
                               value="1">
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
                        <input type="text"
                               class="form-control bg-light"
                               value="{{ $inventory->kondisi }}"
                               readonly>
                        <input type="hidden"
                               name="kondisi_saat_dipinjam"
                               value="{{ $inventory->kondisi }}">
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
