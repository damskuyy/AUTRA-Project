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
    <div class="alert alert-info">
        Tidak ada transaksi massal yang perlu dikembalikan.
    </div>
@else

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">

        {{-- Header --}}
        <div class="mb-3">
            <h5 class="fw-bold mb-1">
                {{ $transaksi->siswa->nama ?? 'Tidak ditemukan' }} 
            </h5>
            <small class="text-muted">
                Jam Pinjam: {{ $transaksi->jam_transaksi ? \Carbon\Carbon::parse($transaksi->jam_transaksi)->format('H:i') : '-' }} |
                Estimasi Kembali: {{ $transaksi->jam_kembali }}
            </small>
        </div>

        <form action="{{ route('transaksi.massal.prosesKembalikan', $transaksi->id) }}" method="POST">
            @csrf

            {{-- LIST INVENTARIS --}}
            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Barang</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th width="220">Kondisi Saat Dikembalikan</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($transaksi->inventaris->where('barangMasuk.jenis_barang', 'alat') as $inv)
                        <tr>
                            <td>
                                {{ $inv->barangMasuk->nama_barang }}
                            </td>

                            <td>
                                <span class="badge bg-{{ $inv->barangMasuk->jenis_barang == 'alat' ? 'primary' : 'success' }}">
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
                                <span class="text-muted">Bahan - Tidak perlu kondisi</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{-- CATATAN TRANSAKSI --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Catatan Pengembalian (Opsional)</label>
                <textarea name="catatan_pengembalian"
                          class="form-control"
                          rows="2"></textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check me-1"></i> Selesaikan Pengembalian
                </button>
            </div>
        </form>

    </div>
</div>

@endif
</div>
@endsection
