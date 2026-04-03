@extends('be.layout')

@php
  $title = 'Notifikasi Stok';
  $breadcrumb = 'Notifikasi Stok';
@endphp

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-warning text-white py-3 d-flex align-items-center justify-content-between">
                    <h6 class="mb-0">Notifikasi Stok Bahan Hampir Habis</h6>
                    <span class="badge bg-white text-dark">{{ $lowStockNotifications->count() }} barang</span>
                </div>
                <div class="card-body">
                    @if ($lowStockNotifications->isEmpty())
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-check-circle fa-2x mb-3 text-success"></i>
                            <p class="mb-0">Semua stok bahan masih aman.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr class="text-uppercase text-secondary text-xs font-weight-bolder">
                                        <th>No.</th>
                                        <th>Bahan</th>
                                        <th class="text-center">Stok Tersisa</th>
                                        <th class="text-center">Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lowStockNotifications as $index => $item)
                                        <tr>
                                            <td class="text-sm">{{ $index + 1 }}</td>
                                            <td class="text-sm fw-semibold">{{ $item->nama_barang }}</td>
                                            <td class="text-center text-danger fw-bold">{{ number_format($item->total_stok) }}</td>
                                            <td class="text-center text-sm">{{ $item->satuan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="alert alert-warning mt-4 mb-0" role="alert">
                            Stok bahan sudah hampir habis. Mohon segera lakukan restock agar persediaan tetap aman.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
