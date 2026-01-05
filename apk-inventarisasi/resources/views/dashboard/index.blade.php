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
<div class="row mt-4">
    <div class="col-12">

        <div class="card">
            <div class="card-header pb-0">
                <h6>List Inventaris</h6>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Ruangan</th>
                                <th class="text-center">List Barang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ruangans as $index => $ruangan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $ruangan->nama_ruangan }}</td>
                                    <td class="text-center">
                                        <button
                                            class="btn btn-info btn-sm"
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
                \DB::raw('SUM(jumlah) as total_stok')
            )
            ->where('ruangan_id', $ruangan->id)
            ->groupBy('nama_barang')
            ->get();
    @endphp

    <div class="modal fade" id="modalBarang{{ $ruangan->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        Barang di {{ $ruangan->nama_ruangan }}
                    </h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <div class="modal-body px-4 py-3">

                    <table class="table table-bordered mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Nama Barang</th>
                                <th width="150" class="text-center">Jumlah / Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($barangs as $barang)
                                <tr>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td class="text-center">{{ $barang->total_stok }}</td>
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
@endsection

@section('footer')
    @include('be.footer')
@endsection
