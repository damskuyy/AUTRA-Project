@extends('be.layout')

@php
  $title = 'Riwayat Pemakaian Bahan';
  $breadcrumb = 'Pemakaian';
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
        <div class="card-header bg-info text-white">
            <h6 class="mb-0">
                <i class="fas fa-history me-2"></i>Riwayat Pemakaian Bahan
            </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Bahan</th>
                            <th>Jumlah</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemakaians as $p)
                        <tr>
                            <td>{{ $p->inventory->barangMasuk->nama_barang }}</td>
                            <td>{{ $p->jumlah }}</td>
                            <td>{{ $p->nama_siswa }}</td>
                            <td>{{ $p->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada data pemakaian
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

@section('footer')
    @include('be.footer')
@endsection
