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

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h6 class="mb-0">
                <i class="fas fa-history me-2"></i>Riwayat Peminjaman Alat
            </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Alat</th>
                            <th>Jumlah</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Waktu Pinjam</th>
                            <th>Poin</th>
                            <th class="text-center">Kondisi</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjamans as $p)
                        <tr>
                            <td>{{ $p->inventory->barangMasuk->nama_barang }}</td>
                            <td class="text-center fw-bold">
                                {{ $p->quantity }}
                            </td>
                            <td>{{ $p->siswa->nama }}</td>
                            <td>{{ $p->siswa->kelas }}</td>

                            <td>
                                <span class="badge bg-secondary">
                                    {{ $p->waktu_pinjam->format('H:i, d-m-Y') }}
                                </span>
                            </td>

                            {{-- POIN --}}
                            <td class="text-center">
                                <span class="badge bg-danger">
                                    {{ $p->siswa->total_poin }}
                                </span>
                            </td>
                            
                            {{-- KONDISI --}}
                            <td class="text-center align-middle">
                                <span class="badge bg-info px-3">
                                    {{ $p->kondisi_pinjam }}
                                </span>
                            </td>

                            {{-- STATUS --}}
                            <td class="text-center align-middle">
                                @if($p->pengembalian)
                                    <span class="badge bg-success px-3">Selesai</span>
                                @else
                                    <span class="badge bg-warning px-3">Dipinjam</span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center align-middle">
                                
                                {{-- Tombol Kembalikan --}}
                                @if(!$p->pengembalian)
                                    <a href="{{ route('pengembalian.create', $p->id) }}"
                                    class="btn btn-sm btn-success mb-1">
                                        Kembalikan
                                    </a>
                                @endif

                                {{-- Tombol BAN --}}
                                @if(!$p->siswa->is_banned)
                                    <button class="btn btn-sm btn-danger mb-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#banModal{{ $p->siswa->id }}">
                                        Banned
                                    </button>
                                @else
                                    {{-- Tombol UNBAN --}}
                                    <form action="{{ route('siswa.unban', $p->siswa->id) }}"
                                        method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-secondary mb-1">
                                            Unban
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        
                        @endforeach

                    </tbody>
                </table>

                {{-- ================= MODAL BANNED SISWA ================= --}}
                @foreach($peminjamans as $p)
                <div class="modal fade" id="banModal{{ $p->siswa->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form action="{{ route('siswa.ban', $p->siswa->id) }}" method="POST" class="d-inline">
                            @csrf

                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Banned Siswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <p class="mb-2">
                                        <strong>Nama:</strong> {{ $p->siswa->nama }} <br>
                                        <strong>Kelas:</strong> {{ $p->siswa->kelas }}
                                    </p>

                                    <div class="mb-3">
                                        <label class="form-label">Banned Sampai</label>
                                        <input type="date"
                                            name="banned_until"
                                            class="form-control"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Alasan Banned</label>
                                        <textarea name="alasan_ban"
                                                class="form-control"
                                                rows="3"
                                                required></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-danger">
                                        Konfirmasi Banned
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
                {{-- ====================================================== --}}

            </div>
        </div>
    </div>

</div>
@endsection

@section('footer')
    @include('be.footer')
@endsection
