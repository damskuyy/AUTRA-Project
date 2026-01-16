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
            <h4 class="fw-bold mb-1">Transaksi Massal</h4>
            <span class="text-muted small">
                <i class="fas fa-boxes me-1"></i>
                Peminjaman & pemakaian inventaris secara massal
            </span>
        </div>
        <a href="{{ route('transaksi.massal.create') }}" class="btn btn-primary rounded-pill px-3">
            <i class="fas fa-plus me-1"></i> Tambah Transaksi
        </a>
    </div>

    {{-- Card --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-center small text-uppercase text-muted">
                            <th>No</th>
                            <th>Siswa</th>
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
                            <td class="text-center fw-semibold">{{ $loop->iteration }}</td>

                            <td class="text-center">
                                <div class="fw-semibold">{{ $t->siswa->nama }}</div>
                                <small class="text-muted">{{ $t->siswa->kelas }}</small>
                            </td>

                            <td class="text-center">
                                {{ $t->keperluan ?? '-' }}
                            </td>

                            <td class="text-start">
                                @foreach($t->inventaris as $inv)
                                    <div class="mb-1">
                                        <span class="fw-semibold">
                                            {{ $inv->barangMasuk->nama_barang }}
                                        </span>
                                        <br>
                                        <small class="text-muted">
                                            @if($inv->barangMasuk->jenis_barang == 'bahan')
                                                {{ $inv->pivot->quantity }} {{ $inv->barangMasuk->satuan }}
                                            @else
                                                QR: {{ $inv->kode_qr_jurusan }}
                                            @endif
                                        </small>
                                    </div>
                                @endforeach
                            </td>

                            <td class="text-center">
                                <span class="badge bg-info-subtle text-info">
                                    {{ \Carbon\Carbon::parse($t->jam_transaksi)->format('d-m-Y H:i') }}
                                </span>
                            </td>

                            <td class="text-center">
                                <span class="badge bg-success-subtle text-success">
                                    {{ \Carbon\Carbon::parse($t->jam_kembali)->format('H:i') }}
                                </span>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('transaksi.massal.formKembalikan', $t->id) }}"
                                   class="btn btn-warning btn-sm rounded-pill px-3">
                                    <i class="fas fa-undo me-1"></i> Kembalikan
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2"></i>
                                <div>Belum ada transaksi massal</div>
                            </td>
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
