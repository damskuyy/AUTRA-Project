@extends ('be.layout')

@php
  $title = 'Edit Ruangan';
  $breadcrumb = 'Ruangan > Edit';
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
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">
                <i class="fas fa-edit me-2"></i>Edit Ruangan
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="kode_ruangan" class="form-label fw-semibold">Kode Ruangan</label>
                    <input type="text" name="kode_ruangan" id="kode_ruangan" class="form-control" value="{{ old('kode_ruangan', $ruangan->kode_ruangan) }}" placeholder="Contoh: RUANG-001" required>
                    @error('kode_ruangan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_ruangan" class="form-label fw-semibold">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" id="nama_ruangan" class="form-control" value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}" placeholder="Contoh: Ruang Kelas 1" required>
                    @error('nama_ruangan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-2"></i>Update
                    </button>
                    <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('be.footer')
@endsection