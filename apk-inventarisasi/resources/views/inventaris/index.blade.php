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
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-primary">
                <div class="card-body">
                    <h4 class="mb-1 fw-bold text-white">
                        <i class="fas fa-history me-2"></i> Inventaris Barang
                    </h4>
                    <p class="mb-0 text-sm text-white opacity-8">
                        Kelola alat dan bahan laboratorium
                    </p>
                </div>
            </div>
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

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="sarpras-tab" data-bs-toggle="tab" data-bs-target="#tabSarpras" type="button">
                <i class="fas fa-building me-2"></i>Sarpras
            </button>
        </li>
    </ul>

    <div class="tab-content">

        {{-- ================= TAB ALAT ================= --}}
        <div class="tab-pane fade show active" id="tabAlat">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between">
                    <input type="text" id="searchAlat" class="form-control w-25" placeholder="Cari alat...">
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
                                        <button class="btn btn-sm btn-outline-primary mb-0"
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
                                                            // Jika bahan dan stok 0, tampilkan HABIS
                                                            $displayStatus = $a->status;
                                                            if ($a->barangMasuk?->jenis_barang === 'bahan' && $a->stok <= 0) {
                                                                $displayStatus = 'HABIS';
                                                            }

                                                            $statusClass = match ($displayStatus) {
                                                                'TERSEDIA'   => 'bg-success',
                                                                'DIPINJAM'   => 'bg-warning',
                                                                'HILANG'     => 'bg-danger',
                                                                'DIPERBAIKI' => 'bg-info',
                                                                'HABIS'      => 'bg-danger',
                                                                default      => 'bg-secondary',
                                                            };
                                                        @endphp

                                                        <span class="badge {{ $statusClass }}">
                                                            {{ $displayStatus }}
                                                        </span>
                                                    <td>
                                                    <a href="{{ route('inventaris.show', $a->id) }}" class="btn btn-xs btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('inventaris.generateQrBulk', $a->barangMasuk->id) }}"
                                                    class="btn btn-xs btn-secondary">
                                                        <i class="fas fa-qrcode"></i>
                                                    </a>



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
                                        <a href="{{ route('inventaris.generateQrBulk', $b->barangMasuk->id) }}"
                                        class="btn btn-xs btn-secondary">
                                        <i class="fas fa-qrcode"></i>
                                        </a>
                                        
                                        {{-- Tombol edit dihilangkan untuk bahan --}}
                                        <form action="{{ route('inventaris.destroy', $b->id) }}"
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
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= TAB SARPRAS ================= --}}
        <div class="tab-pane fade" id="tabSarpras">
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 d-flex justify-content-between">
                    <input type="text" id="searchSarpras" class="form-control w-25" placeholder="Cari sarpras...">
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <tbody>

                            @foreach ($sarpras as $nama => $items)
                                @php $first = $items->first(); @endphp

                                {{-- HEADER BARANG --}}
                                <tr class="table-light sarpras-row"
                                    data-search="{{ strtolower($nama.' '.$first->barangMasuk->merk) }}">
                                    <td>
                                        <strong>{{ $nama }}</strong><br>
                                    </td>
                                    <td width="150">
                                        <span class="badge bg-info">
                                            {{ $items->count() }} {{ $first->barangMasuk->satuan ?? 'Unit' }}
                                        </span>
                                    </td>
                                    <td width="120">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-primary mb-0"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#sarpras-{{ Str::slug($nama) }}">
                                            Detail
                                        </button>
                                    </td>
                                </tr>

                                {{-- DETAIL --}}
                                <tr class="collapse bg-white" id="sarpras-{{ Str::slug($nama) }}">
                                    <td colspan="3">
                                        <table class="table table-sm table-bordered mb-0">
                                            <thead class="table-secondary">
                                                <tr>
                                                    <th>Kode Unik</th>
                                                    <th>Merk</th>
                                                    <th>Ruangan</th>
                                                    <th>Status</th>
                                                    <th>Kondisi</th>
                                                    <th width="90">Foto</th>
                                                    <th width="70">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @foreach ($items as $s)
                                                <tr>
                                                    <td>{{ $s->barangMasuk->kode_unik }}</td>
                                                    <td>{{ $s->barangMasuk->merk ?? '-' }}</td>
                                                    <td>{{ $s->barangMasuk->ruangan->nama_ruangan ?? '-' }}</td>

                                                    <td>
                                                        <span class="badge bg-success">
                                                           {{ strtoupper($s->status ?? '-') }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <span class="badge bg-info">
                                                            {{ strtoupper($s->kondisi ?? '-') }}
                                                        </span>
                                                    </td>

                                                    {{-- FOTO --}}
                                                    <td class="text-center">
                                                        @if($s->barangMasuk->foto)
                                                            <img src="{{ $s->barangMasuk->foto }}"
                                                                class="img-thumbnail sarpras-foto"
                                                                style="
                                                                    width: 60px;
                                                                    height: 60px;
                                                                    object-fit: cover;
                                                                    cursor: pointer;"
                                                                data-img="{{ $s->barangMasuk->foto }}">
                                                        @else
                                                            -
                                                        @endif
                                                    </td>

                                                    {{-- AKSI --}}
                                                    <td class="text-center">
                                                        <form action="{{ route('inventaris.destroy', $s->id) }}"
                                                            method="POST"
                                                            class="delete-form">
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


    </div>
</div>

{{-- ================= MODAL FOTO SARPRAS ================= --}}
<div class="modal fade" id="fotoModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img id="modalFoto" class="img-fluid rounded">
      </div>
    </div>
  </div>
</div>

@endsection



@push('scripts')

<script>
    // MODAL FOTO SARPRAS
    document.querySelectorAll('.sarpras-foto').forEach(img => {
        img.addEventListener('click', function () {
            document.getElementById('modalFoto').src = this.dataset.img;
            new bootstrap.Modal(document.getElementById('fotoModal')).show();
        });
    });
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

    // SEARCH SARPRAS
    document.getElementById('searchSarpras').addEventListener('keyup', function () {
        let keyword = this.value.toLowerCase();
        document.querySelectorAll('.sarpras-row').forEach(row => {
            let text = row.getAttribute('data-search');
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    });

    // Prevent Enter key in search inputs from triggering form submission (avoids accidental delete)
    document.querySelectorAll('#searchAlat, #searchBahan, #searchSarpras').forEach(input => {
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                // Trigger the same filtering logic as if keyup happened
                this.dispatchEvent(new Event('keyup'));
            }
        });
    });


    /// DELETE SARPRAS
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Hapus Sarpras?',
                text: 'Data sarpras akan dihapus, inventaris tidak terpengaruh',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

</script>

@if(session('qr_generated'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'QR Berhasil Dibuat',
        text: 'QR Code berhasil di‑generate',
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true
    });
</script>
@endif

{{-- Show success or error messages from session (e.g., setelah hapus) --}}
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: @json(session('success')),
        showConfirmButton: false,
        timer: 1800,
        timerProgressBar: true
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: @json(session('error')),
        showConfirmButton: true
    });
</script>
@endif

@endpush

