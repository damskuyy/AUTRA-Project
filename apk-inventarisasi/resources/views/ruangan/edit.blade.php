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

    <!-- HEADER -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-warning">
                <div class="card-body">
                    <h4 class="mb-1 fw-bold text-dark">
                        <i class="fas fa-edit me-2"></i> Edit Ruangan
                    </h4>
                    <p class="mb-0 text-sm text-muted">
                        Perbarui data ruangan yang sudah terdaftar
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- FORM -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- KODE RUANGAN -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Kode Ruangan
                            </label>
                            <input type="text"
                                   name="kode_ruangan"
                                   class="form-control @error('kode_ruangan') is-invalid @enderror"
                                   value="{{ old('kode_ruangan', $ruangan->kode_ruangan) }}"
                                   placeholder="Contoh: RUANG-001"
                                   required>

                            @error('kode_ruangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- NAMA RUANGAN -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Nama Ruangan
                            </label>
                            <input type="text"
                                   name="nama_ruangan"
                                   class="form-control @error('nama_ruangan') is-invalid @enderror"
                                   value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}"
                                   placeholder="Contoh: Ruang Kelas 1"
                                   required>

                            @error('nama_ruangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- ACTION -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('ruangan.index') }}"
                               class="btn btn-light">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>

                            <button type="submit"
                                    class="btn btn-warning px-4 text-dark">
                                <i class="fas fa-save me-1"></i> Update
                            </button>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- SWAL SUCCESS --}}
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 1800,
        timerProgressBar: true
    });
</script>
@endif
@endpush
