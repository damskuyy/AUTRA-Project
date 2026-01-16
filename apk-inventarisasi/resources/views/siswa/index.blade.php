@extends('be.layout')

@php
  $title = 'Manajemen Siswa';
  $breadcrumb = 'Siswa';
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
        <div class="col-12">
            
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                       
                        <div class="d-flex">
                            <button class="btn bg-gradient-success btn-sm mb-0 me-2" data-bs-toggle="modal" data-bs-target="#importModal">
                                <i class="fas fa-file-import me-1"></i> Import Excel
                            </button>
                            <button class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#tambahSiswaModal">
                                <i class="fas fa-plus me-1"></i> Tambah Siswa
                            </button>
                            <form action="{{ route('siswa.naik-kelas') }}" method="POST"
                                onsubmit="return confirm('Yakin ingin memproses kenaikan kelas semua siswa?')">
                                @csrf
                                <button class="btn bg-gradient-warning btn-sm mb-0 me-2 ms-2">
                                    <i class="fas fa-level-up-alt me-1"></i> Proses Kenaikan Kelas
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            
        </div>
    </div>

    <!-- Tabel Siswa -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Daftar Siswa</h6>
                        
                        <form method="GET" action="{{ route('siswa.index') }}">
                            <div class="input-group input-group-outline" style="width: 300px;">
                                <input 
                                    type="text" 
                                    name="search" 
                                    value="{{ request('search') }}" 
                                    class="form-control" 
                                    placeholder="Cari siswa..."
                                >
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Siswa</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelas</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIS</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Poin</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Terdaftar</th>
                                    <th class="text-secondary opacity-7" width="120px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($siswas as $siswa)
                            <tr class="siswa-row"
                                data-nama="{{ strtolower($siswa->nama) }}"
                                data-kelas="{{ strtolower($siswa->kelas) }}">
                                <td>
                                    <h6 class="mb-0 text-sm">{{ $siswa->nama }}</h6>
                                </td>
                                <td>{{ $siswa->kelas }}</td>
                                <td>{{ $siswa->nis }}</td>
                                <td>
                                    @if ($siswa->is_banned)
                                        <span class="badge bg-gradient-danger">Banned</span>
                                    @else
                                        <span class="badge bg-gradient-success">Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge 
                                        {{ $siswa->total_poin >= 3 ? 'bg-danger' : 'bg-warning' }}">
                                        {{ $siswa->total_poin }} Poin
                                    </span>
                                </td>
                                <td>{{ $siswa->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <!-- Edit -->
                                        <button 
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editSiswaModal"
                                            data-id="{{ $siswa->id }}"
                                            data-nis="{{ $siswa->nis }}"
                                            data-nama="{{ $siswa->nama }}"
                                            data-kelas="{{ $siswa->kelas }}"
                                            data-status="{{ $siswa->is_active ? 1 : 0 }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- Ban / Unban --}}
                                        @if(!$siswa->is_banned)
                                            <form action="{{ route('siswa.ban', $siswa->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('siswa.unban', $siswa->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-secondary btn-sm">
                                                    <i class="fas fa-unlock"></i>
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Hapus -->
                                        <button 
                                            class="btn btn-danger btn-sm "
                                            data-bs-toggle="modal"
                                            data-bs-target="#hapusSiswaModal"
                                            data-id="{{ $siswa->id }}"
                                            data-nama="{{ $siswa->nama }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Belum ada data siswa
                                </td>
                            </tr>
                            @endforelse
                            </tbody>


                        </table>
                    </div>
                    <div class="px-4 pt-3">
                        {{ $siswas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Siswa -->
<div class="modal fade" id="tambahSiswaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">

            <!-- HEADER -->
            <div class="modal-header bg-gradient-primary text-white">
                <div>
                    <h5 class="mb-0 text-white">Tambah Siswa</h5>
                    <small class="opacity-8">
                        Lengkapi data siswa baru
                    </small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('siswa.store') }}" method="POST">
                @csrf

                <!-- BODY -->
                <div class="modal-body px-4 py-4">

                    <!-- NIS -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-1">
                            NIS
                        </label>
                        <input
                            type="text"
                            name="nis"
                            class="form-control form-control-lg @error('nis') is-invalid @enderror"
                            placeholder="Masukkan NIS siswa"
                            value="{{ old('nis') }}"
                            required
                        >
                    </div>

                    <!-- Nama -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-1">
                            Nama Lengkap
                        </label>
                        <input
                            type="text"
                            name="nama"
                            class="form-control form-control-lg"
                            placeholder="Nama lengkap siswa"
                            required
                        >
                    </div>

                    <!-- Kelas -->
                    <div class="mb-2">
                        <label class="form-label fw-semibold mb-1">
                            Kelas
                        </label>
                        <input
                            type="text"
                            name="kelas"
                            class="form-control form-control-lg"
                            list="kelasList"
                            placeholder="Contoh: X RPL 1"
                            required
                        >
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer px-4 py-3 border-top">
                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn bg-gradient-primary px-4">
                        Simpan Siswa
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


<!-- Modal Edit Siswa -->
<div class="modal fade" id="editSiswaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">

            <form id="editForm" method="POST">
                @csrf

                {{-- Header --}}
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h5 class="modal-title fw-bold mb-1">
                            <i class="fas fa-user-edit me-1 text-primary"></i>
                            Edit Data Siswa
                        </h5>
                        <small class="text-muted">
                            Perbarui informasi siswa dengan benar
                        </small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                {{-- Body --}}
                <div class="modal-body pt-3">
                    <div class="row g-3">

                        <!-- NIS -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-id-card me-1"></i> NIS
                            </label>
                            <input
                                type="text"
                                name="nis"
                                id="editNis"
                                class="form-control"
                                placeholder="Masukkan NIS siswa"
                                required
                            >
                        </div>

                        <!-- Nama -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-user me-1"></i> Nama Lengkap
                            </label>
                            <input 
                                type="text" 
                                name="nama" 
                                id="editNama"
                                class="form-control"
                                placeholder="Masukkan nama lengkap"
                                required
                            >
                        </div>

                        <!-- Kelas -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-school me-1"></i> Kelas
                            </label>
                            <input 
                                type="text"
                                name="kelas"
                                id="editKelas"
                                class="form-control"
                                list="kelasList"
                                placeholder="Contoh: XI RPL 1"
                                required
                            >
                        </div>

                    </div>
                </div>

                {{-- Footer --}}
                <div class="modal-footer border-0 pt-0">
                    <button type="button"
                            class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit"
                            class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


<!-- Modal Hapus Siswa -->
<div class="modal fade" id="hapusSiswaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="hapusForm" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>
                        Apakah Anda yakin ingin menghapus
                        <strong id="hapusNama"></strong>?
                    </p>
                    <p class="text-sm text-danger">
                        Data yang dihapus tidak dapat dikembalikan.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Hapus
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>



<!-- Modal Import Excel -->
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Import Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-info text-white">
                        File Excel (.xlsx) dengan kolom minimal:
                        <strong>nama</strong> dan <strong>kelas</strong>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pilih File Excel</label>
                        <input class="form-control" type="file" name="file" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Import
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ======================
       MODAL HAPUS
    ====================== */
    const hapusModal = document.getElementById('hapusSiswaModal');

    hapusModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const id   = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');

        document.getElementById('hapusNama').innerText = nama;
        document.getElementById('hapusForm').action = `/siswa/${id}`;
    });


    /* ======================
       MODAL EDIT
    ====================== */
    const editModal = document.getElementById('editSiswaModal');

    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const id     = button.getAttribute('data-id');
        const nis    = button.getAttribute('data-nis');
        const nama   = button.getAttribute('data-nama');
        const kelas  = button.getAttribute('data-kelas');

        // Isi value input
        document.getElementById('editNama').value   = nama;
        document.getElementById('editNis').value    = nis;
        document.getElementById('editKelas').value  = kelas;

        // Force floating label Soft UI
        document.getElementById('editNama')
            .closest('.input-group')
            .classList.add('focused', 'is-focused');

        document.getElementById('editNis')
            .closest('.input-group')
            .classList.add('focused', 'is-focused');

        document.getElementById('editKelas')
            .closest('.input-group')
            .classList.add('focused', 'is-focused');

        // Set action form
        document.getElementById('editForm').action = `/siswa/${id}/update`;
    });

});
</script>

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    });
</script>
@endif

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ $errors->first() }}",
            confirmButtonText: 'OK'
        });
    });
</script>
@endif
@endpush

@endsection

@section('footer')
    @include('be.footer')
@endsection