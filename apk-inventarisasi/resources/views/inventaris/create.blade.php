@extends('be.layout')

@php
  $title = 'Tambah Inventaris';
  $breadcrumb = 'Inventaris';
@endphp

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <a href="{{ route('inventaris.index') }}" class="btn btn-secondary px-4">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    @if($type == 'bahan')
        <!-- BAHAN -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="fw-bold mb-3 text-primary">Tambah Inventaris Bahan</h5>
                <form action="{{ route('inventaris.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pilih Barang</label>
                            <select name="barang_masuk_id" class="form-control" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barangMasukBahan as $b)
                                    <option value="{{ $b->id }}">{{ $b->nama_barang }} ({{ $b->jumlah }} {{ $b->satuan }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="TERSEDIA">Tersedia</option>
                                <option value="DIPINJAM">Dipinjam</option>
                                <option value="RUSAK">Rusak</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Kondisi</label>
                            <select name="kondisi" class="form-control">
                                <option value="BAIK">Baik</option>
                                <option value="RUSAK_RINGAN">Rusak Ringan</option>
                                <option value="RUSAK_BERAT">Rusak Berat</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>No Inventaris</label>
                            <input type="text" name="nomor_inventaris" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Serial Number</label>
                            <input type="text" name="serial_number" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Kode QR Jurusan</label>
                            <input type="text" name="kode_qr_jurusan" class="form-control">
                        </div>
                    </div>
                    <button class="btn btn-primary px-4">Simpan</button>
                </form>
            </div>
        </div>
    @else
        <!-- ALAT -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="fw-bold mb-3 text-primary">Tambah Inventaris Alat</h5>
                <form action="{{ route('inventaris.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pilih Barang</label>
                            <select name="barang_masuk_id" class="form-control" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barangMasukAlat as $a)
                                    <option value="{{ $a->id }}">{{ $a->nama_barang }} (Seri: {{ $a->nomor_dokumen }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="TERSEDIA">Tersedia</option>
                                <option value="DIPINJAM">Dipinjam</option>
                                <option value="RUSAK">Rusak</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Kondisi</label>
                            <select name="kondisi" class="form-control">
                                <option value="BAIK">Baik</option>
                                <option value="RUSAK_RINGAN">Rusak Ringan</option>
                                <option value="RUSAK_BERAT">Rusak Berat</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>No Inventaris</label>
                            <input type="text" name="nomor_inventaris" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Serial Number</label>
                            <input type="text" name="serial_number" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Kode QR Jurusan</label>
                            <input type="text" name="kode_qr_jurusan" class="form-control">
                        </div>
                    </div>
                    <button class="btn btn-primary px-4">Simpan</button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
