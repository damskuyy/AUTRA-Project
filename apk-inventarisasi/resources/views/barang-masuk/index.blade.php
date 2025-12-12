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
    <ul class="nav nav-tabs mb-4" id="barangMasukTabs" role="tablist" style="border-radius: 15px;">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="bahan-tab" data-bs-toggle="tab" data-bs-target="#tabBahan" type="button">
                <i class="fas fa-flask me-2"></i>Bahan (Habis Pakai)
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="alat-tab" data-bs-toggle="tab" data-bs-target="#tabAlat" type="button">
                <i class="fas fa-tools me-2"></i>Alat (Non-Habis Pakai)
            </button>
        </li>
    </ul>

    <div class="tab-content" id="barangMasukContent">

        <!-- ===================================================== -->
        <!-- ===================== TAB BAHAN ===================== -->
        <!-- ===================================================== -->
        <div class="tab-pane fade show active" id="tabBahan">

            <div class="card shadow-sm hover-card border-0">
                <div class="card-body">

                    <h5 class="fw-bold mb-3 text-primary">Pemasukan Bahan</h5>
                    <p class="text-muted mb-4">Gunakan form ini untuk menambahkan bahan habis pakai atau menambah stok.</p>

                    <form>

                        <!-- Nama Bahan -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Bahan</label>
                            <select class="form-select">
                                <option>-- pilih bahan --</option>
                                <option>Timah Gulung</option>
                                <option>Kabel NYA 1.5mm</option>
                                <option>Tambah Bahan Baru...</option>
                            </select>
                        </div>

                        <!-- Jenis & Satuan -->
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold">Jenis Bahan</label>
                                <select class="form-select">
                                    <option>Elektronik</option>
                                    <option>Listrik</option>
                                    <option>Mekanik</option>
                                </select>
                            </div>

                            <div class="col-6">
                                <label class="form-label fw-semibold">Satuan</label>
                                <input type="text" class="form-control" placeholder="contoh: gulung, pcs, meter">
                            </div>
                        </div>

                        <!-- Jumlah Masuk -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jumlah Masuk</label>
                            <input type="number" class="form-control" placeholder="misal: 20">
                        </div>

                        <!-- Sumber Barang -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Sumber Barang</label>
                            <select class="form-select">
                                <option>Pembelian</option>
                                <option>Hibah</option>
                                <option>Pengadaan</option>
                                <option>Retur</option>
                            </select>
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Masuk</label>
                            <input type="date" class="form-control">
                        </div>

                        <!-- Catatan -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Catatan (Opsional)</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Submit -->
                        <button class="btn btn-primary px-4 py-2">
                            <i class="fas fa-save me-2"></i>Simpan Data Bahan
                        </button>

                    </form>

                </div>
            </div>
        </div>

        <!-- ===================================================== -->
        <!-- ===================== TAB ALAT ====================== -->
        <!-- ===================================================== -->
        <div class="tab-pane fade" id="tabAlat">

            <div class="card shadow-sm hover-card border-0">
                <div class="card-body">

                    <h5 class="fw-bold mb-3 text-primary">Pemasukan Alat</h5>
                    <p class="text-muted mb-4">Digunakan untuk mencatat alat baru atau menambah unit alat lama.</p>

                    <form>

                        <!-- Nama Alat -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Alat</label>
                            <input type="text" class="form-control" placeholder="Contoh: Multimeter Digital">
                        </div>

                        <!-- Seri + No Inventaris -->
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold">Seri Alat</label>
                                <input type="text" class="form-control" placeholder="Contoh: DT9205A">
                            </div>

                            <div class="col-6">
                                <label class="form-label fw-semibold">Nomor Inventaris</label>
                                <input type="text" class="form-control" placeholder="Contoh: INV-3342">
                            </div>
                        </div>

                        <!-- Sumber + Kondisi -->
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold">Sumber Barang</label>
                                <select class="form-select">
                                    <option>Pembelian</option>
                                    <option>Hibah</option>
                                    <option>Pengadaan</option>
                                    <option>Retur</option>
                                </select>
                            </div>

                            <div class="col-6">
                                <label class="form-label fw-semibold">Kondisi Awal</label>
                                <select class="form-select">
                                    <option>AVAILABLE</option>
                                    <option>CADANGAN</option>
                                </select>
                            </div>
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Masuk</label>
                            <input type="date" class="form-control">
                        </div>

                        <!-- Catatan -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Catatan (Opsional)</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Submit -->
                        <button class="btn btn-primary px-4 py-2">
                            <i class="fas fa-save me-2"></i>Simpan Data Alat
                        </button>

                    </form>

                </div>

            </div>
        </div>

    </div><!-- end tab content -->

</div>
@endsection

@section('footer')
    @include('be.footer')
@endsection