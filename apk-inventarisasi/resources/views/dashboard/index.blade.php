@extends('be.layout')

@php
  $title = 'Dashboard';
  $breadcrumb = 'Dashboard';
@endphp

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">

    {{-- ================= WELCOME CARD ================= --}}
<div class="row mb-4">
    <div class="col-12">
        <div class="card bg-gradient-primary border-0 shadow-sm">
            <div class="card-body py-4 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="text-white mb-1">
                        👋 Selamat Datang, {{ auth()->user()->name ?? 'Admin' }}
                    </h4>
                    <p class="text-white-50 mb-0">
                        Pantau barang di seluruh ruangan secara cepat.
                    </p>
                </div>

                <div class="d-none d-md-block">
                    <i class="fas fa-warehouse text-white opacity-6" style="font-size: 64px;"></i>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- ================= END WELCOME CARD ================= --}}


    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">

                {{-- HEADER CARD --}}
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h6 class="mb-0">Data Barang Tiap Ruangan</h6>
                </div>

                {{-- BODY --}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr class="text-uppercase text-secondary text-xs font-weight-bolder">
                                    <th width="80">No.</th>
                                    <th>Ruangan</th>
                                    <th class="text-center" width="150">List Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ruangans as $index => $ruangan)
                                <tr>
                                    <td class="text-sm">{{ $index + 1 }}</td>
                                    <td class="text-sm fw-semibold">
                                        {{ $ruangan->nama_ruangan }}
                                    </td>
                                    <td class="text-center">
                                        <button
                                            class="btn btn-info btn-sm px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalBarang{{ $ruangan->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
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

    {{-- ================= MODAL LIST BARANG ================= --}}
    @foreach ($ruangans as $ruangan)

        @php
            $barangs = \App\Models\BarangMasuk::select(
                    'nama_barang',
                    DB::raw('SUM(COALESCE(jumlah, 1)) as total_stok')
                )
                ->where('ruangan_id', $ruangan->id)
                ->groupBy('nama_barang')
                ->get();
        @endphp

        <div class="modal fade" id="modalBarang{{ $ruangan->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">

                    <div class="modal-header bg-light">
                        <h6 class="modal-title">
                            Barang di {{ $ruangan->nama_ruangan }}
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th class="text-center" width="120">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($barangs as $barang)
                                <tr>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-primary">
                                            {{ $barang->total_stok }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">
                                        Tidak ada barang
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    @endforeach
    {{-- ================= END MODAL ================= --}}

</div>
@endsection

@section('footer')
    @include('be.footer')
@endsection
