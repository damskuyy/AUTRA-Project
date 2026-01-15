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
                    <input type="text" id="searchAlat" class="form-control w-25" placeholder="Cari alat...">
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

                                <tr class="table-light alat-row" data-search="{{ strtolower($nama.' '.$first->barangMasuk->merk) }}">
                                    <td>
                                        <strong>{{ $nama }}</strong><br>
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
                                <tr class="collapse bg-white alat-detail" id="alat-{{ Str::slug($nama) }}">
                                    <td colspan="3">
                                        <table class="table table-sm table-bordered mb-0">
                                            <thead class="table-secondary">
                                                <tr>
                                                    <th>ID Kode QR</th>
                                                    <th>Jenis</th>
                                                    <th>Merk</th>
                                                    <th>Penempatan Rak</th>
                                                    <th>Status</th>
                                                    <th width="120">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($items as $a)
                                                <tr>
                                                    <td>{{ $a->kode_qr_jurusan ?? '-' }}</td>
                                                    <td>{{ $a->barangMasuk->jenis_barang }}</td>
                                                    <td>{{ $a->barangMasuk->merk ?? '-' }}</td>
                                                    <td>{{ $a->penempatan_rak_label }}</td>
                                                    <td>
                                                        @php
                                                            $statusClass = match ($a->status) {
                                                                'TERSEDIA'   => 'bg-success',
                                                                'DIPINJAM'   => 'bg-warning',
                                                                'HILANG'     => 'bg-danger',
                                                                'DIPERBAIKI' => 'bg-info',
                                                                default      => 'bg-secondary',
                                                            };
                                                        @endphp

                                                        <span class="badge {{ $statusClass }}">
                                                            {{ $a->status }}
                                                        </span>
                                                    <td>
                                                    <a href="{{ route('inventaris.show', $a->id) }}" class="btn btn-xs btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <button type="button"
                                                        class="btn btn-xs btn-secondary"
                                                        onclick="generateQr('{{ route('inventaris.generateQrBulk', $a->barangMasuk->id) }}')">
                                                        <i class="fas fa-qrcode"></i>
                                                    </button>


                                                    <form action="{{ route('inventaris.destroy', $a->id) }}"
                                                        method="POST"
                                                        class="d-inline delete-form">
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
                    <input type="text" id="searchBahan" class="form-control w-25" placeholder="Cari bahan...">
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
                                    <th>Penempatan Rak</th>
                                    <th width="160">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bahan as $b)
                                <tr class="bahan-row"
                                    data-search="{{ strtolower(
                                        $b->barangMasuk->nama_barang.' '.
                                        $b->barangMasuk->jenis_barang.' '.
                                        $b->barangMasuk->merk
                                    ) }}">
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
                                    <td>{{ $b->penempatan_rak_label }}</td>
                                    <td>
                                        <a href="{{ route('inventaris.show', $b->id) }}" class="btn btn-xs btn-info"><i class="fas fa-eye"></i></a>
                                        <button type="button"
                                            class="btn btn-xs btn-secondary"
                                            onclick="generateQr('{{ route('inventaris.generateQrBulk', $b->barangMasuk->id) }}')">
                                            <i class="fas fa-qrcode"></i>
                                        </button>

                                        <a href="{{ route('inventaris.edit', $b->id) }}" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('inventaris.destroy', $b->id) }}"
                                            method="POST"
                                            class="d-inline delete-form">
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

@push('scripts')

<script>
    function generateQr(url) {
        Swal.fire({
            icon: 'success',
            title: 'QR Berhasil Dibuat',
            text: 'QR Code berhasil di-generate',
            showConfirmButton: false,
            timer: 1300,
            timerProgressBar: true
        });

        // redirect setelah swal tampil
        setTimeout(() => {
            window.location.href = url;
        }, 1300);
    }


    // SEARCH ALAT
    document.getElementById('searchAlat').addEventListener('keyup', function () {
        let keyword = this.value.toLowerCase();
        document.querySelectorAll('.alat-row').forEach(row => {
            let text = row.getAttribute('data-search');
            row.style.display = text.includes(keyword) ? '' : 'none';

            // ikut sembunyikan detail-nya
            let targetId = row.querySelector('[data-bs-target]')?.getAttribute('data-bs-target');
            if (targetId) {
                let detailRow = document.querySelector(targetId);
                if (detailRow) detailRow.style.display = row.style.display;
            }
        });
    });

    // SEARCH BAHAN
    document.getElementById('searchBahan').addEventListener('keyup', function () {
        let keyword = this.value.toLowerCase();
        document.querySelectorAll('.bahan-row').forEach(row => {
            let text = row.getAttribute('data-search');
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    });


    // SWEETALERT CONFIRM DELETE
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data yang dihapus tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
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
</script>

@endpush

