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
                                <button class="btn btn-primary mb-0 d-flex align-items-center justify-content-center" type="submit" style="z-index: 3;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Siswa</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIS</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelas</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
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
                                <td>-</td>
                                <td>{{ $siswa->kelas }}</td>
                                <td>
                                    @if ($siswa->is_banned)
                                        <span class="badge bg-gradient-danger">Banned</span>
                                    @else
                                        <span class="badge bg-gradient-success">Aktif</span>
                                    @endif
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
                                            data-nama="{{ $siswa->nama }}"
                                            data-kelas="{{ $siswa->kelas }}"
                                            data-status="{{ $siswa->is_active ? 1 : 0 }}"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Hapus -->
                                        <button 
                                            class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#hapusSiswaModal"
                                            data-id="{{ $siswa->id }}"
                                            data-nama="{{ $siswa->nama }}"
                                        >
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('siswa.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Kelas</label>
                            <input 
                                type="text"
                                name="kelas"
                                class="form-control"
                                list="kelasList"
                                placeholder="Ketik atau pilih kelas..."
                                required
                            >
                        </div>
                    </div>
                </div>
                <datalist id="kelasList">
                    @foreach ($kelasList as $kelas)
                        <option value="{{ $kelas }}">
                    @endforeach
                </datalist>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Siswa -->
<div class="modal fade" id="editSiswaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <!-- Nama -->
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input 
                                    type="text" 
                                    name="nama" 
                                    id="editNama"
                                    class="form-control"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Kelas -->
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Kelas</label>
                                <input 
                                    type="text"
                                    name="kelas"
                                    id="editKelas"
                                    class="form-control"
                                    list="kelasList"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Status</label>
                                <select name="is_active" id="editStatus" class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
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
        const nama   = button.getAttribute('data-nama');
        const kelas  = button.getAttribute('data-kelas');
        const status = button.getAttribute('data-status');

        // Isi value input
        document.getElementById('editNama').value   = nama;
        document.getElementById('editKelas').value  = kelas;
        document.getElementById('editStatus').value = status;

        // Force floating label Soft UI
        document.getElementById('editNama')
            .closest('.input-group')
            .classList.add('focused', 'is-focused');

        document.getElementById('editKelas')
            .closest('.input-group')
            .classList.add('focused', 'is-focused');

        document.getElementById('editStatus')
            .closest('.input-group')
            .classList.add('focused', 'is-focused');

        // Set action form
        document.getElementById('editForm').action = `/siswa/${id}`;
    });

});
</script>
@endpush

@endsection

@section('footer')
    @include('be.footer')
@endsection