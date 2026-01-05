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

<div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        <h6 class="mb-0">Pengembalian Alat</h6>
    </div>

    <div class="card-body">
        <p><strong>Alat:</strong> {{ $peminjaman->inventory->barangMasuk->nama_barang }}</p>
        <p><strong>Jumlah:</strong> {{ $peminjaman->quantity }}</p>
        <p><strong>Peminjam:</strong> {{ $peminjaman->siswa->nama }}</p>
        <p><strong>Kelas:</strong>{{ $peminjaman->siswa->kelas }}</p>


        <form action="{{ route('pengembalian.store') }}" method="POST">
            @csrf
            <input type="hidden" name="quantity" value="{{ $peminjaman->quantity }}">

            <input type="hidden" name="peminjaman_id" value="{{ $peminjaman->id }}">

            <div class="mb-3">
                <label class="form-label">Kondisi Saat Dikembalikan</label>
                <select name="kondisi" class="form-select" required>
                    <option value="BAIK">Baik</option>
                    <option value="RUSAK_RINGAN">Rusak Ringan</option>
                    <option value="RUSAK_BERAT">Rusak Berat</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Catatan</label>
                <textarea name="catatan" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">Konfirmasi Pengembalian</button>
        </form>
    </div>
</div>

</div>
@endsection

@section('footer')
    @include('be.footer')
@endsection