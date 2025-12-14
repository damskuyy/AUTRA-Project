@extends ('be.layout')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">

    <h4 class="font-weight-bolder text-dark mb-4">Tambah Barang Masuk</h4>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('barang-masuk.store') }}" method="POST">
                @csrf

                <!-- Inventory -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Pilih Inventaris</label>
                    <select class="form-select" name="inventory_id">
                        <option value="">-- pilih inventaris --</option>
                        @foreach ($inventories as $inv)
                            <option value="{{ $inv->id }}">{{ $inv->item->nama_item ?? 'Tanpa Nama' }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Nama Barang -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang">
                </div>

                <!-- Jenis -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Barang</label>
                    <select class="form-select" name="jenis_barang">
                        <option value="bahan">Bahan</option>
                        <option value="alat">Alat</option>
                    </select>
                </div>

                <!-- Jumlah -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Satuan</label>
                    <input type="text" class="form-control" name="satuan">
                </div>

                <!-- Sumber -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Sumber Barang</label>
                    <select class="form-select" name="sumber">
                        <option>SARPRAS_PUSAT</option>
                        <option>PEMBELIAN</option>
                        <option>HIBAH</option>
                        <option>PENGADAAN</option>
                        <option>RETUR</option>
                    </select>
                </div>

                <!-- Nomor Dokumen -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nomor Dokumen</label>
                    <input type="text" class="form-control" name="nomor_dokumen">
                </div>

                <!-- Tanggal -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Masuk</label>
                    <input type="date" class="form-control" name="tanggal_masuk">
                </div>

                <!-- Catatan -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Catatan</label>
                    <textarea class="form-control" rows="3" name="catatan"></textarea>
                </div>

                <button class="btn btn-primary px-4 py-2">
                    <i class="fas fa-save me-2"></i> Simpan Data
                </button>

            </form>

        </div>
    </div>

</div>
@endsection

@section('footer')
    @include('be.footer')
@endsection
