@extends('be.layout')

@php
    $title = 'Pengembalian Transaksi Massal';
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

    {{-- HEADER --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-success">
                <div class="card-body">
                    <h4 class="mb-1 fw-bold text-white">
                        <i class="fas fa-boxes-stacked me-2"></i>
                        Pengembalian Transaksi Massal
                    </h4>
                    <p class="mb-0 text-sm text-white opacity-8">
                        Konfirmasi pengembalian beberapa inventaris sekaligus
                    </p>
                </div>
            </div>
        </div>
    </div>

@if($transaksi->inventaris->isEmpty())

    <div class="alert alert-info d-flex align-items-center gap-2 shadow-sm">
        <i class="fas fa-info-circle"></i>
        Tidak ada transaksi massal yang perlu dikembalikan.
    </div>

@else

<div class="row">

    {{-- INFO PEMINJAM --}}
    <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">

                <h6 class="fw-bold mb-3 text-uppercase text-secondary">
                    Informasi Peminjam
                </h6>

                <ul class="list-group list-group-flush text-sm">
                    <li class="list-group-item px-0">
                        <strong>Nama Siswa</strong><br>
                        {{ $transaksi->siswa->nama ?? 'Tidak ditemukan' }}
                    </li>

                    <li class="list-group-item px-0">
                        <strong>Jam Pinjam</strong><br>
                        {{ $transaksi->jam_transaksi
                            ? \Carbon\Carbon::parse($transaksi->jam_transaksi)->format('H:i')
                            : '-' }}
                    </li>

                    <li class="list-group-item px-0">
                        <strong>Estimasi Kembali</strong><br>
                        {{ $transaksi->jam_kembali }}
                    </li>
                </ul>

            </div>
        </div>
    </div>

    {{-- FORM PENGEMBALIAN --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <h6 class="fw-bold mb-3 text-uppercase text-secondary">
                    Daftar Inventaris & Kondisi
                </h6>

                <form action="{{ route('transaksi.massal.prosesKembalikan', $transaksi->id) }}" method="POST">
                    @csrf

                    {{-- TABLE INVENTARIS --}}
                    <div class="table-responsive mb-4">
                        <table class="table table-borderless align-middle">
                            <thead class="table-light small text-uppercase text-muted">
                                <tr>
                                    <th>Barang</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th width="240">Kondisi Dikembalikan</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($transaksi->inventaris->where('barangMasuk.jenis_barang', 'alat') as $inv)
                                <tr class="border-bottom">
                                    <td>
                                        <strong>{{ $inv->barangMasuk->nama_barang }}</strong>
                                    </td>

                                    <td>
                                        <span class="badge bg-primary-subtle text-primary rounded-pill">
                                            {{ ucfirst($inv->barangMasuk->jenis_barang) }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($inv->barangMasuk->jenis_barang == 'bahan')
                                            {{ $inv->pivot->quantity }} {{ $inv->barangMasuk->satuan }}
                                        @else
                                            1 unit
                                        @endif
                                    </td>

                                    <td>
                                        <select name="kondisi[{{ $inv->id }}]"
                                                class="form-select form-select-sm"
                                                required>
                                            <option value="BAIK">Baik</option>
                                            <option value="RUSAK_RINGAN">Rusak Ringan</option>
                                            <option value="RUSAK_BERAT">Rusak Berat</option>
                                            <option value="HILANG">Hilang</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- CATATAN --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-sticky-note me-1"></i>
                            Catatan Pengembalian (Opsional)
                        </label>
                        <textarea name="catatan_pengembalian"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                    </div>

                    {{-- ACTION --}}
                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fas fa-check me-1"></i>
                            Selesaikan Pengembalian
                        </button>

                        <a href="{{ url()->previous() }}"
                           class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>
                            Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>
@endif
</div>
@endsection
