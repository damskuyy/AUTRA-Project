@extends ('be.layout')

@php
  $title = 'Daftar Ruangan';
  $breadcrumb = 'Ruangan';
@endphp

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">

    <!-- PAGE HEADER -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-primary">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="text-white">
                        <h4 class="mb-1 fw-bold">
                            <i class="fas fa-door-open me-2"></i> Daftar Ruangan
                        </h4>
                        <p class="mb-0 opacity-8 text-sm">
                            Manajemen data ruangan inventaris
                        </p>
                    </div>

                    <a href="{{ route('ruangan.create') }}"
                       class="btn btn-light fw-semibold">
                        <i class="fas fa-plus me-1"></i> Tambah Ruangan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">

                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs fw-bold opacity-7 ps-4">
                                        #
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs fw-bold opacity-7">
                                        Kode
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs fw-bold opacity-7">
                                        Nama Ruangan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs fw-bold opacity-7 text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($ruangans as $index => $ruangan)
                                    <tr class="hover-shadow">
                                        <td class="ps-4 text-sm fw-semibold">
                                            {{ $index + 1 }}
                                        </td>

                                        <td>
                                            <span class="badge bg-gradient-info">
                                                {{ $ruangan->kode_ruangan }}
                                            </span>
                                        </td>

                                        <td>
                                            <h6 class="mb-0 text-sm">
                                                {{ $ruangan->nama_ruangan }}
                                            </h6>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">

                                                <a href="{{ route('ruangan.edit', $ruangan->id) }}"
                                                   class="btn btn-link text-warning p-0"
                                                   title="Edit">
                                                    <i class="fas fa-pen-to-square fa-lg"></i>
                                                </a>

                                                <form action="{{ route('ruangan.destroy', $ruangan->id) }}"
                                                      method="POST"
                                                      class="form-hapus">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                            class="btn btn-link text-danger p-0 btn-hapus"
                                                            title="Hapus">
                                                        <i class="fas fa-trash fa-lg"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="text-center py-5">
                                                <i class="fas fa-building-circle-xmark fa-3x text-muted mb-3"></i>
                                                <h6 class="text-muted mb-1">
                                                    Belum ada data ruangan
                                                </h6>
                                                <p class="text-sm text-muted mb-0">
                                                    Klik tombol <b>Tambah Ruangan</b> untuk menambahkan data
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

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

{{-- =====================
     SWAL SUCCESS (SUDAH ADA - TIDAK DIHAPUS)
===================== --}}
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


{{-- =====================
     SWAL KONFIRMASI HAPUS (TAMBAHAN)
===================== --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.btn-hapus').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('.form-hapus');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Ruangan yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

});
</script>
@endpush

