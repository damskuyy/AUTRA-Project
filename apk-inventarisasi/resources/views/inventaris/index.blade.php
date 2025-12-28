@extends('be.layout')

@php
  $title = 'Inventaris';
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

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Daftar Inventaris</h4>
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
                        <div>
                            <button class="btn btn-secondary me-2"><i class="fas fa-filter me-2"></i>Filter</button>
                            <a href="{{ route('inventaris.create', ['type' => 'alat']) }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Tambah Alat
                            </a>
                        </div>
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
                                @foreach ($alat as $a)
                                    <tr>
                                        <td>
                                            {{ $a->barangMasuk->nama_barang }} <br>
                                            @if($a->kode_qr_jurusan)
                                                <small class="text-muted" style="font-size: 10px;">{{ $a->kode_qr_jurusan }}</small>
                                            @else
                                                <small class="text-danger" style="font-size: 10px;">QR Belum Dibuat</small>
                                            @endif
                                        </td>
                                        <td>{{ $a->barangMasuk->nama_barang }}</td>
                                        <td>{{ $a->serial_number ?? '-' }}</td>
                                        <td>{{ $a->nomor_inventaris ?? '-' }}</td>
                                        <td>
                                            <span class="badge {{ $a->status === 'TERSEDIA' ? 'bg-success' : 'bg-warning' }}">
                                                {{ $a->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('inventaris.show', $a->id) }}" class="action-btn action-view">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('inventaris.generateQr', $a->id) }}" 
                                            class="action-btn action-qr" 
                                            title="{{ $a->kode_qr_jurusan ? 'Regenerate QR' : 'Buat QR' }}">
                                                <i class="fas fa-qrcode"></i>
                                            </a>

                                            <a href="{{ route('inventaris.edit', $a->id) }}" class="action-btn action-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <form action="{{ route('inventaris.destroy', $a->id) }}" method="POST" class="d-inline" id="delete-form-{{ $a->id }}">
                                                @csrf @method('DELETE')
                                                <button type="button" class="action-btn action-delete" onclick="confirmDelete({{ $a->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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
                        <div>
                            <button class="btn btn-secondary me-2"><i class="fas fa-filter me-2"></i>Filter</button>
                            <a href="{{ route('inventaris.create', ['type' => 'bahan']) }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Tambah Bahan
                            </a>
                        </div>
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
                                @foreach ($bahan as $b)
                                    <tr>
                                        <td>
                                            {{ $b->barangMasuk->nama_barang }} <br>
                                            @if($b->kode_qr_jurusan)
                                                <small class="text-muted" style="font-size: 10px;">{{ $b->kode_qr_jurusan }}</small>
                                            @else
                                                <small class="text-danger" style="font-size: 10px;">QR Belum Dibuat</small>
                                            @endif
                                        </td>
                                        <td>{{ $b->barangMasuk->nama_barang }}</td>
                                        <td>{{ $b->barangMasuk->jenis_barang }}</td>
                                        <td><span class="badge bg-info">{{ $b->stok }} {{ $b->barangMasuk?->satuan ?? 'Unit' }}</span></td>
                                        <td>
                                            <a href="{{ route('inventaris.show', $b->id) }}" class="action-btn action-view">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            <a href="{{ route('inventaris.generateQr', $b->id) }}" class="action-btn action-qr">
                                                <i class="fas fa-qrcode"></i>
                                            </a>

                                            <a href="{{ route('inventaris.edit', $b->id) }}" class="action-btn action-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('inventaris.destroy', $b->id) }}" method="POST" class="d-inline" id="delete-form-{{ $b->id }}">
                                                @csrf @method('DELETE')
                                                <button type="button" class="action-btn action-delete" onclick="confirmDelete({{ $b->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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
    .action-qr { background-color: #6b7280; }     /* abu */
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

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data inventaris akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>