@extends('be.layout')

@php
  $title = 'Tambah Barang Sarpras';
  $breadcrumb = 'Items';
@endphp

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <h5 class="fw-bold text-primary mb-3">
               Tambah Barang Sarpras
            </h5>

            <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Kode Barang</label>
                        <input type="text" name="kode_barang"
                               class="form-control @error('kode_barang') is-invalid @enderror"
                               value="{{ old('kode_barang') }}">
                        @error('kode_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nama Barang</label>
                        <input type="text" name="nama_barang"
                               class="form-control @error('nama_barang') is-invalid @enderror"
                               value="{{ old('nama_barang') }}">
                        @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Merk</label>
                        <input type="text" name="merk" class="form-control"
                               value="{{ old('merk') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Jenis Barang</label>
                        <select name="jenis" class="form-select @error('jenis') is-invalid @enderror">
                            <option value="">-- pilih jenis --</option>
                            <option value="alat" {{ old('jenis') == 'alat' ? 'selected' : '' }}>Alat</option>
                            <option value="bahan" {{ old('jenis') == 'bahan' ? 'selected' : '' }}>Bahan</option>
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Spesifikasi</label>
                    <textarea name="spesifikasi" class="form-control" rows="3">{{ old('spesifikasi') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Foto Barang (opsional)</label>
                    <input type="file" name="foto" class="form-control">
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('items.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <button class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Simpan Barang
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

@section('footer')
    @include('be.footer')
@endsection
