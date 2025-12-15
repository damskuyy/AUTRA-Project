@extends ('be.layout')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">

    <h4 class="font-weight-bolder text-dark mb-4">Edit Barang Masuk</h4>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('barang-masuk.update', $barangMasuk->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Inventory -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Pilih Inventaris</label>
                    <select class="form-select" name="inventory_id">
                        @foreach ($inventories as $inv)
                            <option value="{{ $inv->id }}"
                                {{ $barangMasuk->inventory_id == $inv->id ? 'selected' : '' }}>
                                {{ $inv->item->nama_item ?? 'Tanpa Nama' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nama Barang -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang" value="{{ $barangMasuk->nama_barang }}">
                </div>

                <!-- Jenis Barang -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Barang</label>
                    <select class="form-select" name="jenis_barang">
                        <option value="bahan" {{ $barangMasuk->jenis_barang == 'bahan' ? 'selected' : '' }}>Bahan</option>
                        <option value="alat" {{ $barangMasuk->jenis_barang == 'alat' ? 'selected' : '' }}>Alat</option>
                    </select>
                </div>

                <!-- Jumlah -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" value="{{ $barangMasuk->jumlah }}">
                </div>

                <!-- Satuan -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Satuan</label>
                    <input type="text" class="form-control" name="satuan" value="{{ $barangMasuk->satuan }}">
                </div>

                <!-- Sumber -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Sumber</label>
                    <select class="form-select" name="sumber">
                        @foreach(['SARPRAS_PUSAT','PEMBELIAN','HIBAH','PENGADAAN','RETUR'] as $src)
                            <option value="{{ $src }}" {{ $barangMasuk->sumber == $src ? 'selected' : '' }}>
                                {{ $src }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nomor Dokumen -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nomor Dokumen</label>
                    <input type="text" class="form-control" name="nomor_dokumen" value="{{ $barangMasuk->nomor_dokumen }}">
                </div>

                <!-- Tanggal -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Masuk</label>
                    <input type="date" class="form-control" name="tanggal_masuk" value="{{ $barangMasuk->tanggal_masuk->format('Y-m-d') }}">
                </div>

                <!-- Catatan -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Catatan</label>
                    <textarea class="form-control" rows="3" name="catatan">{{ $barangMasuk->catatan }}</textarea>
                </div>

                <button class="btn btn-primary px-4 py-2">
                    <i class="fas fa-save me-2"></i> Update Data
                </button>

            </form>

        </div>
    </div>

</div>
@endsection

@section('footer')
    @include('be.footer')
@endsection
