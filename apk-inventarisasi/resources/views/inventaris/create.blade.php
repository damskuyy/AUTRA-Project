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


    <form action="{{ route('inventaris.store') }}" method="POST">
        @csrf

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">Pilih Barang (Item)</label>
                <select name="item_id" class="form-control" required>
                    <option value="">-- Pilih Item --</option>
                    @foreach($items as $i)
                        <option value="{{ $i->id }}">{{ $i->kode_barang }} - {{ $i->nama_barang }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Ruangan</label>
                <select name="ruangan_id" class="form-control" required>
                    @foreach($ruangan as $r)
                        <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
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
                <label>Stok (untuk bahan)</label>
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
@endsection
