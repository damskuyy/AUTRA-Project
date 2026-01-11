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
                            <th class="text-uppercase text-secondary text-xxs fw-bold">Alat</th>
                            <th class="text-uppercase text-secondary text-xxs fw-bold text-center">Qty</th>
                            <th class="text-uppercase text-secondary text-xxs fw-bold">Siswa</th>
                            <th class="text-uppercase text-secondary text-xxs fw-bold">Kelas</th>
                            <th class="text-uppercase text-secondary text-xxs fw-bold">Waktu</th>
                            <th class="text-uppercase text-secondary text-xxs fw-bold text-center">Poin</th>
                            <th class="text-uppercase text-secondary text-xxs fw-bold text-center">Kondisi</th>
                            <th class="text-uppercase text-secondary text-xxs fw-bold text-center">Status</th>
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

                            <!-- QTY -->
                            <td class="text-center fw-bold">
                                {{ $p->quantity }}
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

                            <!-- POIN -->
                            <td class="text-center">
                                <span class="badge bg-danger">
                                    {{ $p->siswa->total_poin }}
                                </span>
                            </td>

                            <!-- KONDISI -->
                            <td class="text-center">
                                <span class="badge bg-info px-3">
                                    {{ $p->kondisi_pinjam }}
                                </span>
                            </td>

                            <!-- STATUS -->
                            <td class="text-center">
                                @if($p->pengembalian)
                                    <span class="badge bg-success px-3">Selesai</span>
                                @else
                                    <span class="badge bg-warning px-3">Dipinjam</span>
                                @endif
                            </td>

                            <!-- AKSI -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center flex-wrap gap-1">

                                    {{-- KEMBALIKAN --}}
                                    @if(!$p->pengembalian)
                                        <a href="{{ route('pengembalian.create', $p->id) }}"
                                           class="btn btn-sm btn-success">
                                            Kembalikan
                                        </a>
                                    @endif

                                    {{-- BAN / UNBAN --}}
                                    @if(!$p->siswa->is_banned)
                                        <button class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#banModal{{ $p->siswa->id }}">
                                            Banned
                                        </button>
                                    @else
                                        <form action="{{ route('siswa.unban', $p->siswa->id) }}"
                                              method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-secondary">
                                                Unban
                                            </button>
                                        </form>
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

@section('footer')
    @include('be.footer')
@endsection
