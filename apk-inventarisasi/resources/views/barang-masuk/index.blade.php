@extends ('be.layout')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4 class="font-weight-bolder text-dark">Barang Masuk</h4>
        </div>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabBahan">
                <i class="fas fa-flask me-2"></i>Bahan (Habis Pakai)
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabAlat">
                <i class="fas fa-tools me-2"></i>Alat (Non-Habis Pakai)
            </button>
        </li>
    </ul>

    <div class="tab-content">

        <!-- ============================= BAHAN =============================== -->
        <div class="tab-pane fade show active" id="tabBahan">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h5 class="fw-bold mb-3 text-primary">Pemasukan Bahan</h5>

                    <form action="{{ route('barang-masuk.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="jenis_barang" value="bahan">

                        <!-- Inventory -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Inventory</label>
                            <select name="inventory_id" class="form-select" required>
                                <option value="">-- pilih inventory --</option>
                                @foreach($inventories as $inv)
                                    <option value="{{ $inv->id }}">{{ $inv->nama_barang }}</option>
                                @endforeach
                                <option value="__new">+ Inventory Baru</option>
                            </select>
                        </div>

                        <!-- Nama Bahan -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Bahan</label>

                            @if($riwayatNamaBahan->count())
                                <select name="nama_barang" id="namaBahanSelect" class="form-select">
                                    <option value="">-- pilih bahan --</option>
                                    @foreach($riwayatNamaBahan as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                    <option value="__new">+ Tambah Nama Baru</option>
                                </select>
                                <input type="text" name="nama_barang_new" id="namaBahanNew"
                                       class="form-control mt-2 d-none">
                            @else
                                <input type="text" name="nama_barang" class="form-control"
                                       placeholder="ketik nama bahan...">
                            @endif
                        </div>

                        <!-- Satuan -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Satuan</label>
                            <input type="text" name="satuan" class="form-control" placeholder="contoh: pcs, gulung">
                        </div>

                        <!-- Jumlah -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control">
                        </div>

                        <!-- Sumber Manual -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Sumber Barang</label>
                            <input type="text" name="sumber" class="form-control"
                                   placeholder="Ketik sumber barang...">
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Catatan</label>
                            <textarea name="catatan" class="form-control"></textarea>
                        </div>

                        <button class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Simpan Data Bahan
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <!-- ============================ ALAT =============================== -->
        <div class="tab-pane fade" id="tabAlat">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h5 class="fw-bold mb-3 text-primary">Pemasukan Alat</h5>

                    <form action="{{ route('barang-masuk.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="jenis_barang" value="alat">

                        <!-- Inventory -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Inventory</label>
                            <select name="inventory_id" class="form-select" required>
                                <option value="">-- pilih inventory --</option>
                                @foreach($inventories as $inv)
                                    <option value="{{ $inv->id }}">{{ $inv->nama_barang }}</option>
                                @endforeach
                                <option value="__new">+ Inventory Baru</option>
                            </select>
                        </div>

                        <!-- Nama Alat -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Alat</label>

                            @if($riwayatNamaAlat->count())
                                <select name="nama_barang" id="namaAlatSelect" class="form-select">
                                    <option value="">-- pilih alat --</option>
                                    @foreach($riwayatNamaAlat as $alat)
                                        <option value="{{ $alat }}">{{ $alat }}</option>
                                    @endforeach
                                    <option value="__new">+ Tambah Nama Baru</option>
                                </select>
                                <input type="text" name="nama_barang_new" id="namaAlatNew"
                                       class="form-control mt-2 d-none">
                            @else
                                <input type="text" name="nama_barang" class="form-control">
                            @endif
                        </div>

                        <!-- Seri Alat -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Seri Alat</label>

                            @if($riwayatSeriAlat->count())
                                <select name="nomor_dokumen" id="seriSelect" class="form-select">
                                    <option value="">-- pilih seri --</option>
                                    @foreach($riwayatSeriAlat as $seri)
                                        <option value="{{ $seri }}">{{ $seri }}</option>
                                    @endforeach
                                    <option value="__new">+ Tambah Seri Baru</option>
                                </select>
                                <input type="text" name="nomor_dokumen_new" id="seriNew"
                                       class="form-control mt-2 d-none">
                            @else
                                <input type="text" name="nomor_dokumen" class="form-control">
                            @endif
                        </div>

                        <!-- Sumber Manual -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Sumber Barang</label>
                            <input type="text" name="sumber" class="form-control">
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control">
                        </div>

                        <!-- Catatan -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Catatan</label>
                            <textarea name="catatan" class="form-control"></textarea>
                        </div>

                        <button class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Simpan Data Alat
                        </button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

<script>
document.getElementById('namaBahanSelect')?.addEventListener('change', function () {
    document.getElementById('namaBahanNew').classList.toggle('d-none', this.value !== '__new');
});

document.getElementById('namaAlatSelect')?.addEventListener('change', function () {
    document.getElementById('namaAlatNew').classList.toggle('d-none', this.value !== '__new');
});

document.getElementById('seriSelect')?.addEventListener('change', function () {
    document.getElementById('seriNew').classList.toggle('d-none', this.value !== '__new');
});
</script>

@endsection

@section('footer')
    @include('be.footer')
@endsection
