@extends('be.layout')

@section('title', 'Dashboard - Sistem Inventaris')

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
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Manajemen Data Siswa</h6>
                            <p class="text-sm mb-0">Kelola data siswa dengan fitur lengkap</p>
                        </div>
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
    </div>

    <!-- Tabel Siswa -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Daftar Siswa</h6>
                        <div class="d-flex">
                            <div class="input-group input-group-outline me-2" style="width: 250px;">
                                <input type="text" class="form-control form-control-sm" placeholder="Cari siswa..." id="searchInput">
                            </div>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                        </div>
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
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Ahmad Rizki</h6>
                                                <p class="text-xs text-secondary mb-0">ahmad.rizki@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">20230001</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">XII IPA 1</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-success">Aktif</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">15 Mar 2023</p>
                                    </td>
                                    <td class="align-middle">
                                        <div class="btn-group">
                                            <button class="btn btn-link text-primary mb-0 px-1" data-bs-toggle="modal" data-bs-target="#editSiswaModal" title="Edit">
                                                <i class="fas fa-pencil-alt text-xs"></i>
                                            </button>
                                            <button class="btn btn-link text-warning mb-0 px-1" title="Banned">
                                                <i class="fas fa-user-slash text-xs"></i>
                                            </button>
                                            <button class="btn btn-link text-danger mb-0 px-1" data-bs-toggle="modal" data-bs-target="#hapusSiswaModal" title="Hapus">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="avatar avatar-sm me-3" alt="user2">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Siti Nurhaliza</h6>
                                                <p class="text-xs text-secondary mb-0">siti.nur@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">20230002</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">XII IPS 2</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-danger">Banned</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">16 Mar 2023</p>
                                    </td>
                                    <td class="align-middle">
                                        <div class="btn-group">
                                            <button class="btn btn-link text-primary mb-0 px-1" data-bs-toggle="modal" data-bs-target="#editSiswaModal" title="Edit">
                                                <i class="fas fa-pencil-alt text-xs"></i>
                                            </button>
                                            <button class="btn btn-link text-success mb-0 px-1" title="Aktifkan">
                                                <i class="fas fa-user-check text-xs"></i>
                                            </button>
                                            <button class="btn btn-link text-danger mb-0 px-1" data-bs-toggle="modal" data-bs-target="#hapusSiswaModal" title="Hapus">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://images.unsplash.com/photo-1628157588553-5eeea00af15c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="avatar avatar-sm me-3" alt="user3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Budi Santoso</h6>
                                                <p class="text-xs text-secondary mb-0">budi.santoso@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">20230003</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">XII IPA 3</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-success">Aktif</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">17 Mar 2023</p>
                                    </td>
                                    <td class="align-middle">
                                        <div class="btn-group">
                                            <button class="btn btn-link text-primary mb-0 px-1" data-bs-toggle="modal" data-bs-target="#editSiswaModal" title="Edit">
                                                <i class="fas fa-pencil-alt text-xs"></i>
                                            </button>
                                            <button class="btn btn-link text-warning mb-0 px-1" title="Banned">
                                                <i class="fas fa-user-slash text-xs"></i>
                                            </button>
                                            <button class="btn btn-link text-danger mb-0 px-1" data-bs-toggle="modal" data-bs-target="#hapusSiswaModal" title="Hapus">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-4 pt-3">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="javascript:;" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="javascript:;">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:;">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:;">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:;">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
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
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">NIS</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Kelas</label>
                                <select class="form-control">
                                    <option value="">Pilih Kelas</option>
                                    <option value="XII IPA 1">XII IPA 1</option>
                                    <option value="XII IPA 2">XII IPA 2</option>
                                    <option value="XII IPA 3">XII IPA 3</option>
                                    <option value="XII IPS 1">XII IPS 1</option>
                                    <option value="XII IPS 2">XII IPS 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Status</label>
                                <select class="form-control">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Nonaktif">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Siswa -->
<div class="modal fade" id="editSiswaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3 focused is-focused">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" value="Ahmad Rizki">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">NIS</label>
                                <input type="text" class="form-control" value="20230001">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="ahmad.rizki@example.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Password (Kosongkan jika tidak diubah)</label>
                                <input type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Kelas</label>
                                <select class="form-control">
                                    <option value="XII IPA 1" selected>XII IPA 1</option>
                                    <option value="XII IPA 2">XII IPA 2</option>
                                    <option value="XII IPA 3">XII IPA 3</option>
                                    <option value="XII IPS 1">XII IPS 1</option>
                                    <option value="XII IPS 2">XII IPS 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Status</label>
                                <select class="form-control">
                                    <option value="Aktif" selected>Aktif</option>
                                    <option value="Nonaktif">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" rows="3">Jl. Merdeka No. 123</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus Siswa -->
<div class="modal fade" id="hapusSiswaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data siswa <strong>Ahmad Rizki</strong>?</p>
                <p class="text-sm text-danger">Data yang dihapus tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Import Excel -->
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info text-white">
                    <i class="fas fa-info-circle me-2"></i>
                    File harus berformat Excel (.xlsx) dengan kolom: Nama, NIS, Email, Kelas
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Pilih File Excel</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="overwriteData">
                    <label class="form-check-label" for="overwriteData">
                        Timpa data yang sudah ada jika NIS sama
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Import</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('be.footer')
@endsection