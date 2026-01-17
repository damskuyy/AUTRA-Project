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

    {{-- ================= HEADER ================= --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-primary rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold text-white mb-1">
                            <i class="fas fa-boxes me-2"></i>
                            Transaksi Massal
                        </h4>
                        <p class="text-sm text-white opacity-8 mb-0">
                            Peminjaman & pemakaian inventaris secara massal
                        </p>
                    </div>

                    <a href="{{ route('transaksi.massal.create') }}"
                       class="btn btn-light rounded-pill px-3 fw-semibold">
                        <i class="fas fa-plus me-1"></i> Tambah Transaksi
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= TABLE CARD ================= --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="small text-uppercase text-muted text-center">
                            <th style="width:5%">No</th>
                            <th style="width:15%">Siswa</th>
                            <th style="width:15%">Keperluan</th>
                            <th>Inventaris</th>
                            <th style="width:15%">Jam Transaksi</th>
                            <th style="width:10%">Jam Kembali</th>
                            <th style="width:10%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transaksis as $t)
                        <tr>

                            {{-- No --}}
                            <td class="text-center fw-semibold">
                                {{ $loop->iteration }}
                            </td>

                            {{-- Siswa --}}
                            <td class="text-center">
                                <div class="fw-semibold">
                                    {{ $t->siswa->nama }}
                                </div>
                                <span class="badge bg-secondary-subtle text-secondary mt-1">
                                    {{ $t->siswa->kelas }}
                                </span>
                            </td>

                            {{-- Keperluan --}}
                            <td class="text-center">
                                <span class="badge bg-info-subtle text-info">
                                    {{ $t->keperluan ?? '-' }}
                                </span>
                            </td>

                            {{-- Inventaris --}}
                            <td>
                                @foreach($t->inventaris as $inv)
                                    <div class="border rounded-3 p-2 mb-2 bg-light">

                                        <div class="fw-semibold">
                                            {{ $inv->barangMasuk->nama_barang }}
                                        </div>

                                        <small class="text-muted">
                                            @if($inv->barangMasuk->jenis_barang == 'bahan')
                                                Digunakan:
                                                <span class="fw-semibold text-danger">
                                                    {{ $inv->pivot->quantity }}
                                                </span>
                                                {{ $inv->barangMasuk->satuan }}
                                            @else
                                                QR:
                                                <span class="fw-semibold">
                                                    {{ $inv->kode_qr_jurusan }}
                                                </span>
                                            @endif
                                        </small>
                                    </div>
                                @endforeach
                            </td>

                            {{-- Jam Transaksi --}}
                            <td class="text-center">
                                <span class="badge bg-primary-subtle text-primary">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ \Carbon\Carbon::parse($t->jam_transaksi)->format('d-m-Y H:i') }}
                                </span>
                            </td>

                            {{-- Jam Kembali --}}
                            <td class="text-center">
                                <span class="badge bg-success-subtle text-success">
                                    <i class="fas fa-hourglass-end me-1"></i>
                                    {{ \Carbon\Carbon::parse($t->jam_kembali)->format('H:i') }}
                                </span>
                            </td>

                            {{-- Aksi --}}
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
                                <div class="fw-semibold">
                                    Belum ada transaksi massal
                                </div>
                                <small>Silakan tambah transaksi baru</small>
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

@section('footer')
    @include('be.footer')
@endsection