@extends('be.layout')

@php
    $title = 'Transaksi Massal';
    $breadcrumb = 'Transaksi Massal';
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
            <h4 class="fw-bold mb-0">Riwayat Transaksi Massal</h4>
            <small class="text-muted">Transaksi peminjaman & pemakaian inventaris</small>
        </div>
        <a href="{{ route('transaksi.massal.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Massal
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>Inventaris</th>
                            <th>Jam Transaksi</th>
                            <th>Jam Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $t)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $t->siswa }}</td>
                            <td>
                                @foreach($t->inventaris as $inv)
                                    {{ $inv->barangMasuk->nama_barang }} ({{ $inv->kode_qr_jurusan }})<br>
                                @endforeach
                            </td>
                            <td>{{ \Carbon\Carbon::parse($t->jam_transaksi)->format('d-m-Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($t->jam_kembali)->format('H:i') }}</td>
                            <td>
                                @if($t->dikembalikan)
                                    <span class="badge bg-success">Sudah Dikembalikan</span>
                                @else
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                @endif
                            </td>
                            <td>
                                @if(!$t->dikembalikan)
                                <form method="POST" action="{{ route('transaksi.massal.kembalikan', $t->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm">
                                        <i class="fas fa-undo"></i> Kembalikan
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada transaksi massal.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 1800,
        timerProgressBar: true
    });
</script>
@endif
@endpush
