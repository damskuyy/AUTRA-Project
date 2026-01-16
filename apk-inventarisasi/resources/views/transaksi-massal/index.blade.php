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
            <h4 class="fw-bold mb-0">Transaksi Massal</h4>
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
                        <tr class="text-center">
                            <th>No.</th>
                            <th>Nama Siswa</th>
                            <th>Keperluan</th>
                            <th>Inventaris</th>
                            <th>Jam Transaksi</th>
                            <th>Jam Kembali</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $t)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $t->siswa->nama }} ({{$t->siswa->kelas}})</td>
                            <td class="text-center">{{ $t->keperluan }}</td>
                            <td class="text-center">
                                @foreach($t->inventaris as $inv)
                                    {{ $inv->barangMasuk->nama_barang }}
                                    @if($inv->barangMasuk->jenis_barang == 'bahan')
                                        ({{ $inv->pivot->quantity }} {{ $inv->barangMasuk->satuan }})
                                    @else
                                        ({{ $inv->kode_qr_jurusan }})
                                    @endif
                                    <br>
                                @endforeach
                            </td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($t->jam_transaksi)->format('d-m-Y H:i') }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($t->jam_kembali)->format('H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('transaksi.massal.formKembalikan', $t->id) }}"
                                    class="btn btn-warning btn-sm">
                                    Kembalikan
                                </a>
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
