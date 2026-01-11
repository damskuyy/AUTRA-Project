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

    {{-- Flash Message --}}
    @foreach (['success' => 'success', 'error' => 'danger'] as $key => $type)
        @if(session($key))
        <div class="alert alert-{{ $type }} alert-dismissible fade show shadow-sm">
            {{ session($key) }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
    @endforeach

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Inventaris Barang</h4>
            <small class="text-muted">Kelola alat dan bahan laboratorium</small>
        </div>
    </div>

    {{-- Tabs --}}
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

    <div class="tab-content">

        {{-- ================= TAB ALAT ================= --}}
        <div class="tab-pane fade show active" id="tabAlat">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between">
                    <input type="text" class="form-control w-25" placeholder="Cari alat...">
                    <a href="{{ route('inventaris.create', ['type' => 'alat']) }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Tambah Alat
                    </a>
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <tbody>
                            @foreach ($alat as $nama => $items)
                                @php
                                    $first = $items->first();
                                @endphp

                                <tr class="table-light">
                                    <td>
                                        <strong>{{ $nama }}</strong><br>
                                        <small class="text-muted">{{ $first->barangMasuk->merk ?? '-' }}</small>
                                    </td>
                                    <td width="150">
                                        <span class="badge bg-info">
                                            {{ $items->count() }} {{ $first->barangMasuk->satuan ?? 'Unit' }}
                                        </span>
                                    </td>
                                    <td width="120">
                                        <button class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#alat-{{ Str::slug($nama) }}">
                                            Detail
                                        </button>
                                    </td>
                                </tr>

                                {{-- Detail --}}
                                <tr class="collapse bg-white" id="alat-{{ Str::slug($nama) }}">
                                    <td colspan="3">
                                        <table class="table table-sm table-bordered mb-0">
                                            <thead class="table-secondary">
                                                <tr>
                                                    <th>ID Kode QR</th>
                                                    <th>Seri Alat</th>
                                                    <th width="120">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($items as $a)
                                                <tr>
                                                    <td>{{ $a->kode_qr_jurusan ?? '-' }}</td>
                                                    <td>{{ $a->barangMasuk->nomor_dokumen ?? '-' }}</td>
                                                    <td>
                                                    <a href="{{ route('inventaris.show', $a->id) }}" class="btn btn-xs btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('inventaris.generateQrBulk', $a->barangMasuk->id) }}" class="btn btn-xs btn-secondary">
                                                        <i class="fas fa-qrcode"></i>
                                                    </a>

                                                    <form action="{{ route('inventaris.destroy', $a->id) }}"
                                                        method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Yakin hapus alat ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-xs btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= TAB BAHAN ================= --}}
        <div class="tab-pane fade" id="tabBahan">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between">
                    <input type="text" class="form-control w-25" placeholder="Cari bahan...">
                    <a href="{{ route('inventaris.create', ['type' => 'bahan']) }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Tambah Bahan
                    </a>
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Merk</th>
                                    <th>Stok</th>
                                    <th width="160">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bahan as $b)
                                <tr>
                                    <td>
                                        {{ $b->barangMasuk->nama_barang }}<br>
                                        <small class="text-muted">{{ $b->kode_qr_jurusan ?? 'QR belum ada' }}</small>
                                    </td>
                                    <td>{{ $b->barangMasuk->jenis_barang }}</td>
                                    <td>{{ $b->barangMasuk->merk ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $b->stok }} {{ $b->barangMasuk?->satuan ?? 'Unit' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('inventaris.show', $b->id) }}" class="btn btn-xs btn-info"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('inventaris.generateQrBulk', $b->barangMasuk->id) }}" class="btn btn-xs btn-secondary"><i class="fas fa-qrcode"></i></a>
                                        <a href="{{ route('inventaris.edit', $b->id) }}" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('inventaris.destroy', $b->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin hapus bahan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-xs btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
