@extends('be.layout')

@php
  $title = 'Riwayat Peminjaman Alat';
  $breadcrumb = 'Peminjaman';
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
            <div class="card border-0 shadow-sm bg-gradient-primary">
                <div class="card-body">
                    <h4 class="mb-1 fw-bold text-white">
                        <i class="fas fa-history me-2"></i> Riwayat Peminjaman Alat
                    </h4>
                    <p class="mb-0 text-sm text-white opacity-8">
                        Monitoring peminjaman alat oleh siswa
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs fw-bold">Nama Alat</th>
                            <th class="text-uppercase text-secondary text-xxs fw-bold">Siswa</th>
                            <th class="text-uppercase text-secondary text-xxs fw-bold">Kelas</th>
                            <th class="text-uppercase text-secondary text-xxs fw-bold">Jam Pinjam</th>
                            <th class="text-uppercase text-secondary text-xxs fw-bold">Jam Kembali</th>
                            <th class="text-uppercase text-secondary text-xxs fw-bold">Keperluan</th>
                            <th class="text-uppercase text-secondary text-xxs fw-bold text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($peminjamans as $p)
                        <tr>

                            <!-- ALAT -->
                            <td>
                                <h6 class="mb-0 text-sm">
                                    {{ $p->inventory->barangMasuk->nama_barang }}
                                </h6>
                            </td>

                            <!-- SISWA -->
                            <td>{{ $p->siswa->nama }}</td>

                            <!-- KELAS -->
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $p->siswa->kelas }}
                                </span>
                            </td>

                            <!-- WAKTU -->
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $p->waktu_pinjam->format('H:i, d-m-Y') }}
                                </span>
                            </td>

                            <!-- JAM KEMBALI -->
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $p->waktu_kembali_aktual ? $p->waktu_kembali_aktual->format('H:i') : '-' }}
                                </span>
                            </td>

                            <!-- KEPERLUAN -->
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $p->keperluan ?? '-' }}
                                </span>
                            </td>

                            <!-- AKSI -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center flex-wrap gap-1">

                                    {{-- KEMBALIKAN --}}
                                    @if(!$p->pengembalian)
                                        <a href="{{ route('pengembalian.create', $p->id) }}"
                                           class="btn btn-sm btn-success mb-0">
                                            Kembalikan
                                        </a>
                                    @endif

                                    

                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session("success") }}',
    confirmButtonText: 'OK'
});
@endif
</script>
@endpush

@section('footer')
    @include('be.footer')
@endsection
