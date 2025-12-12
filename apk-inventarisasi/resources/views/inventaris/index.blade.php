@extends('be.layout')

@section('title', 'Inventaris - Sistem Inventaris')

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
            <h4 class="font-weight-bolder text-dark">Data Inventaris</h4>
            <button class="btn btn-primary px-4">
                <i class="fas fa-plus me-2"></i>Tambah Inventaris
            </button>
        </div>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4" id="inventarisTabs" role="tablist" style="border-radius: 15px;">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="alat-tab" data-bs-toggle="tab" data-bs-target="#tabAlat" type="button">
                <i class="fas fa-tools me-2"></i>Alat
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="bahan-tab" data-bs-toggle="tab" data-bs-target="#tabBahan" type="button">
                <i class="fas fa-flask me-2"></i>Bahan
            </button>
        </li>
    </ul>

    <!-- Content Tabs -->
    <div class="tab-content" id="inventarisContent">

        <!-- ==================== TAB ALAT ==================== -->
        <div class="tab-pane fade show active" id="tabAlat">
            <div class="card shadow-sm hover-card border-0">
                <div class="card-body">

                    <!-- Fake Datatable Search -->
                    <div class="d-flex justify-content-between mb-3">
                        <input type="text" class="form-control w-25" placeholder="Cari alat...">
                        <button class="btn btn-secondary"><i class="fas fa-filter me-2"></i>Filter</button>
                    </div>

                    <!-- Tabel Alat -->
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead class="bg-light">
                                <tr>
                                    <th>ID Alat</th>
                                    <th>Nama Alat</th>
                                    <th>Seri</th>
                                    <th>No. Inventaris</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- Contoh Dummy Row -->
                                <tr>
                                    <td>ALT-0021</td>
                                    <td>Multimeter Digital</td>
                                    <td>DT9205A</td>
                                    <td>INV-3342</td>
                                    <td>
                                        <span class="badge bg-success">AVAILABLE</span>
                                    </td>
                                    <td>
    <button class="action-btn action-view">
        <i class="fas fa-eye me-1"></i> Lihat
    </button>

    <button class="action-btn action-edit">
        <i class="fas fa-edit me-1"></i> Edit
    </button>

    <button class="action-btn action-delete">
        <i class="fas fa-trash me-1"></i> Hapus
    </button>
</td>
                                </tr>

                                <tr>
                                    <td>ALT-0047</td>
                                    <td>Obeng Set</td>
                                    <td>PRO-12P</td>
                                    <td>INV-1193</td>
                                    <td>
                                        <span class="badge bg-danger">RUSAK</span>
                                    </td>
                                    <td>
    <button class="action-btn action-view">
        <i class="fas fa-eye me-1"></i> Lihat
    </button>

    <button class="action-btn action-edit">
        <i class="fas fa-edit me-1"></i> Edit
    </button>

    <button class="action-btn action-delete">
        <i class="fas fa-trash me-1"></i> Hapus
    </button>
</td>
                                </tr>

                                <!-- Tambahkan baris baru sesuai kebutuhan tampilan -->
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!-- ==================== TAB BAHAN ==================== -->
        <div class="tab-pane fade" id="tabBahan">
            <div class="card shadow-sm hover-card border-0">
                <div class="card-body">

                    <!-- fake datatable search -->
                    <div class="d-flex justify-content-between mb-3">
                        <input type="text" class="form-control w-25" placeholder="Cari bahan...">
                        <button class="btn btn-secondary"><i class="fas fa-filter me-2"></i>Filter</button>
                    </div>

                    <!-- Tabel Bahan -->
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead class="bg-light">
                                <tr>
                                    <th>ID Bahan</th>
                                    <th>Nama Bahan</th>
                                    <th>Jenis</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- Dummy Row -->
                                <tr>
                                    <td>BHN-0013</td>
                                    <td>Timah Gulung</td>
                                    <td>Elektronik</td>
                                    <td>42</td>
                                    <td>
    <button class="action-btn action-view">
        <i class="fas fa-eye me-1"></i> Lihat
    </button>

    <button class="action-btn action-edit">
        <i class="fas fa-edit me-1"></i> Edit
    </button>

    <button class="action-btn action-delete">
        <i class="fas fa-trash me-1"></i> Hapus
    </button>
</td>
                                </tr>

                                <tr>
                                    <td>BHN-0028</td>
                                    <td>Kabel NYA 1.5mm</td>
                                    <td>Listrik</td>
                                    <td>120</td>
                                    <td>
    <button class="action-btn action-view">
        <i class="fas fa-eye me-1"></i> Lihat
    </button>

    <button class="action-btn action-edit">
        <i class="fas fa-edit me-1"></i> Edit
    </button>

    <button class="action-btn action-delete">
        <i class="fas fa-trash me-1"></i> Hapus
    </button>
</td>
                                </tr>

                                <!-- Tambahan row lainnya jika mau -->
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div><!-- end tab content -->

</div>

<style>
    .action-btn {
        border: none;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        color: #fff;
        cursor: pointer;
        transition: 0.15s ease-in-out;
    }

    .action-view { background-color: #0ea5e9; }   /* biru  */
    .action-edit { background-color: #eab308; }   /* kuning */
    .action-delete { background-color: #ef4444; } /* merah */

    .action-btn:hover {
        opacity: 0.85;
        transform: translateY(-1px);
    }

    td .action-btn + .action-btn {
        margin-left: 6px;
    }
</style>

@endsection

@section('footer')
    @include('be.footer')
@endsection