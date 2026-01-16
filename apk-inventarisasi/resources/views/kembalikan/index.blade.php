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

@if($transaksi->inventaris->isEmpty())
    <div class="alert alert-info d-flex align-items-center gap-2">
        <i class="fas fa-info-circle"></i>
        Tidak ada transaksi massal yang perlu dikembalikan.
    </div>
@else

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h5 class="fw-bold mb-1">
                    <i class="fas fa-user-graduate me-1 text-primary"></i>
                    {{ $transaksi->siswa->nama ?? 'Tidak ditemukan' }}
                </h5>
                <small class="text-muted">
                    <i class="fas fa-clock me-1"></i>
                    Jam Pinjam:
                    {{ $transaksi->jam_transaksi ? \Carbon\Carbon::parse($transaksi->jam_transaksi)->format('H:i') : '-' }}
                    &nbsp;|&nbsp;
                    Estimasi Kembali:
                    {{ $transaksi->jam_kembali }}
                </small>
            </div>
        </div>

        <form action="{{ route('transaksi.massal.prosesKembalikan', $transaksi->id) }}" method="POST">
            @csrf

            {{-- LIST INVENTARIS --}}
            <div class="table-responsive mb-4">
                <table class="table align-middle mb-0">
                    <thead class="table-light small text-uppercase text-muted">
                        <tr>
                            <th>Barang</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th width="240">Kondisi Saat Dikembalikan</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($transaksi->inventaris->where('barangMasuk.jenis_barang', 'alat') as $inv)
                        <tr>
                            <td>
                                <strong>{{ $inv->barangMasuk->nama_barang }}</strong>
                            </td>

                            <td>
                                <span class="badge rounded-pill bg-primary-subtle text-primary">
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
                                @if($inv->barangMasuk->jenis_barang == 'alat')
                                <select name="kondisi[{{ $inv->id }}]"
                                        class="form-select form-select-sm"
                                        required>
                                    <option value="BAIK">Baik</option>
                                    <option value="RUSAK_RINGAN">Rusak Ringan</option>
                                    <option value="RUSAK_BERAT">Rusak Berat</option>
                                    <option value="HILANG">Hilang</option>
                                </select>
                                @else
                                <span class="text-muted small">
                                    Bahan tidak memiliki kondisi
                                </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{-- CATATAN --}}
            <div class="mb-4 col-md-6">
                <label class="form-label fw-semibold">
                    <i class="fas fa-sticky-note me-1"></i>
                    Catatan Pengembalian (Opsional)
                </label>
                <textarea name="catatan_pengembalian"
                          class="form-control"
                          rows="2"
                          placeholder="Catatan tambahan jika ada..."></textarea>
            </div>

            {{-- ACTION --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success rounded-pill px-4">
                    <i class="fas fa-check me-1"></i> Selesaikan Pengembalian
                </button>
            </div>

        </form>
    </div>
</div>

@endif
</div>
@endsection
