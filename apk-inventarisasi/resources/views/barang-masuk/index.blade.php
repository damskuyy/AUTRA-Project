@extends ('be.layout')

@php
  $title = 'Barang Masuk TOI';
  $breadcrumb = 'Barang Masuk';
@endphp

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabAlat">
                <i class="fas fa-tools me-2"></i>Pendataan Alat
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabBahan">
                <i class="fas fa-flask me-2"></i>Pendataan Bahan Habis Pakai
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link text-success"
                    data-bs-toggle="tab"
                    data-bs-target="#tabSarpras">
                <i class="fas fa-qrcode me-2"></i>Pendataan Sarpras
            </button>
        </li>
    </ul>

    <div class="tab-content">

                <!-- ============================ ALAT =============================== -->
        <div class="tab-pane fade show active" id="tabAlat">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h5 class="fw-bold mb-3 text-primary">Form Pendataan Alat</h5>

                    <form action="{{ route('barang-masuk.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="jenis_barang" value="alat">

                        <!-- Inventory -->
                        <!-- <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Inventory</label>
                            <select name="inventory_id" class="form-select">
                                <option value="">-- pilih inventory --</option>
                                @foreach($inventories as $inv)
                                    <option value="{{ $inv->id }}">{{ $inv->nama_barang }}</option>
                                @endforeach
                                
                            </select>
                        </div> -->

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

                        <!-- Merk -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Merk</label>
                            <input
                                type="text"
                                name="merk"
                                class="form-control"
                                placeholder="Contoh: Bosch, Makita, Kenmaster">
                        </div>

                        <!-- Jumlah -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" value="1" min="1">
                        </div>

                        <!-- Ruangan -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Lokasi Penempatan Barang</label>
                            <select name="ruangan_id" class="form-select">
                                <option value="">-- pilih ruangan --</option>
                                @foreach($ruangans as $r)
                                    <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Penempatan Rak -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Penempatan Rak</label>
                            <select name="penempatan_rak" class="form-select" required>
                                <option value="">-- pilih rak --</option>
                                <option value="PT">Power Tools</option>
                                <option value="HT">Hand Tools</option>
                                <option value="RK">Rak Komponen</option>
                                <option value="RBK">Rak Bahan Kecil</option>
                                <option value="RBB">Rak Bahan Besar</option>
                                <option value="UK">Rak Alat Ukur</option>
                                <option value="PPE">Rak PPE</option>
                            </select>
                        </div>

                        <!-- Sumber Manual -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Sumber Barang</label>

                            <select name="sumber" id="sumberSelectAlat" class="form-select">
                                <option value="">-- pilih sumber --</option>
                                <option value="BOPD">BOPD</option>
                                <option value="BOS">BOS</option>
                                <option value="Bantuan Pemerintah">Bantuan Pemerintah</option>
                                <option value="__manual">Lainnya</option>
                            </select>

                            <input
                                type="text"
                                name="sumber_manual"
                                id="sumberManualAlat"
                                class="form-control mt-2 d-none"
                                placeholder="Ketik sumber barang manual">
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

        <!-- ============================= BAHAN =============================== -->
        <div class="tab-pane fade" id="tabBahan">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h5 class="fw-bold mb-3 text-primary">Form Pendataan Bahan Habis Pakai</h5>

                    <form action="{{ route('barang-masuk.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="jenis_barang" value="bahan">

                        <!-- Inventory -->
                        <!-- <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Inventory</label>
                            <select name="inventory_id" class="form-select">
                                <option value="">-- pilih inventory --</option>
                                @foreach($inventories as $inv)
                                    <option value="{{ $inv->id }}">{{ $inv->nama_barang }}</option>
                                @endforeach
                               
                            </select>
                        </div> -->

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

                        <!-- Merk -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Merk</label>
                            <input
                                type="text"
                                name="merk"
                                class="form-control"
                                placeholder="Contoh: AIRTAC, Ebara, dll">
                        </div>


                        <!-- Satuan -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Satuan</label>
                            <input type="text" name="satuan" class="form-control" placeholder="contoh: pcs, gulung">
                        </div>

                        <!-- Ruangan -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Lokasi Penempatan Barang</label>
                            <select name="ruangan_id" class="form-select">
                                <option value="">-- pilih ruangan --</option>
                                @foreach($ruangans as $r)
                                    <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Penempatan Rak -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Penempatan Rak</label>
                            <select name="penempatan_rak" class="form-select" required>
                                <option value="">-- pilih rak --</option>
                                <option value="PT">Power Tools</option>
                                <option value="HT">Hand Tools</option>
                                <option value="RK">Rak Komponen</option>
                                <option value="RBK">Rak Bahan Kecil</option>
                                <option value="RBB">Rak Bahan Besar</option>
                                <option value="UK">Rak Alat Ukur</option>
                                <option value="PPE">Rak PPE</option>
                            </select>
                        </div>

                        <!-- Jumlah -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control">
                        </div>

                        <!-- Sumber -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Sumber Barang</label>

                            <select name="sumber" id="sumberSelectBahan" class="form-select">
                                <option value="">-- pilih sumber --</option>
                                <option value="BOPD">BOPD</option>
                                <option value="BOS">BOS</option>
                                <option value="Bantuan Pemerintah">Bantuan Pemerintah</option>
                                <option value="__manual">Lainnya</option>
                            </select>

                            <input
                                type="text"
                                name="sumber_manual"
                                id="sumberManualBahan"
                                class="form-control mt-2 d-none"
                                placeholder="Ketik sumber barang manual">
                        </div>


                        <!-- Tanggal -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Masuk</label>
                            <input type="datetime-local" name="tanggal_masuk" class="form-control">
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

        <div class="tab-pane fade" id="tabSarpras">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h5 class="fw-bold mb-3 text-success">
                        <i class="fas fa-qrcode me-2"></i>Pendataan Barang Sarpras
                    </h5>

                    {{-- INPUT QR SARPRAS --}}
                    <div class="row mb-3 align-items-end">

                        <div class="col-md-8">
                            <label class="form-label fw-semibold">
                                Kode QR Barang Sarpras
                            </label>
                            <input type="text"
                                id="qrSarpras"
                                class="form-control"
                                placeholder="Scan QR / input manual kode barang"
                                autocomplete="off">
                        </div>

                        <div class="col-md-4 d-grid">
                            <button type="button"
                                    class="btn btn-outline-success mb-0"
                                    onclick="openSarprasScanner()">
                                <i class="fas fa-camera me-1"></i> Scan Kamera
                            </button>
                        </div>

                    </div>


                    {{-- CAMERA --}}
                    <div id="sarpras-reader"
                        class="mb-4 mx-auto"
                        style="width: 280px;; display:none;"></div>

                    {{-- FORM SARPRAS --}}
                    <form action="{{ route('sarpras.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="kode_unik" id="sp_kode">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Nama Barang</label>
                                <input type="text" id="sp_nama" name="nama_barang"
                                    class="form-control" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Merk</label>
                                <input type="text" id="sp_merk" name="merk"
                                    class="form-control" readonly>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-semibold">Spesifikasi</label>
                                <textarea id="sp_spesifikasi"
                                        class="form-control"
                                        rows="2"
                                        readonly></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Ruangan</label>
                                <select name="ruangan_id" class="form-select" required>
                                    <option value="">-- pilih ruangan --</option>
                                    @foreach($ruangans as $r)
                                        <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="dipinjam">Dipinjam</option>
                                    <option value="rusak">Rusak</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold">Kondisi</label>
                                <select name="kondisi" class="form-select" required>
                                    <option value="baik">Baik</option>
                                    <option value="cukup">Cukup</option>
                                    <option value="rusak">Rusak</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Foto</label>
                                <img id="sp_foto"
                                    class="img-fluid rounded border"
                                    style="max-height:200px; display:none;">
                                <input type="hidden" name="foto" id="sp_foto_input">
                            </div>

                        </div>

                        <button class="btn btn-success px-4">
                            <i class="fas fa-save me-2"></i>Simpan Barang Sarpras
                        </button>
                    </form>

                </div>
            </div>
        </div>



    </div>
</div>

<script>
function handleSumber(selectId, inputId) {
    const select = document.getElementById(selectId);
    const input  = document.getElementById(inputId);

    if (!select || !input) return;

    select.addEventListener('change', function () {
        input.classList.toggle('d-none', this.value !== '__manual');
    });
}

handleSumber('sumberSelectAlat', 'sumberManualAlat');
handleSumber('sumberSelectBahan', 'sumberManualBahan');
document.getElementById('namaBahanSelect')?.addEventListener('change', function () {
    document.getElementById('namaBahanNew').classList.toggle('d-none', this.value !== '__new');
});

document.getElementById('namaAlatSelect')?.addEventListener('change', function () {
    document.getElementById('namaAlatNew').classList.toggle('d-none', this.value !== '__new');
});

</script>

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
let sarprasScanner;
let scanned = false;

/* ======================
   BUKA SCANNER
====================== */
function openSarprasScanner() {
    const reader = document.getElementById('sarpras-reader');
    reader.style.display = 'block';

    sarprasScanner = new Html5Qrcode("sarpras-reader");

    sarprasScanner.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: 250 },
        onSarprasScanSuccess
    );
}

/* ======================
   CALLBACK SCAN
====================== */
function onSarprasScanSuccess(qrText) {
    if (scanned) return;
    scanned = true;

    console.log('QR RAW:', qrText);

    sarprasScanner.stop();
    document.getElementById('sarpras-reader').style.display = 'none';

    const kode = extractKodeUnik(qrText);

    console.log('KODE FINAL:', kode);

    if (!kode) {
        Swal.fire('QR Tidak Valid', 'Kode tidak dikenali', 'error');
        scanned = false;
        return;
    }

    fetchSarprasData(kode);

    setTimeout(() => scanned = false, 3000);
}

/* ======================
   NORMALISASI KODE
====================== */
function extractKodeUnik(text) {
    if (!text) return null;

    text = text.trim();

    console.log('QR RAW:', text);

    // Cari pola kodeunik=XXXX
    const match = text.match(/kodeunik=([A-Za-z0-9.\-_]+)/);

    if (match && match[1]) {
        console.log('KODE FINAL:', match[1]);
        return match[1];
    }

    // fallback: kalau isinya langsung kode
    if (/^[0-9]+\.[0-9]+\.[0-9]+$/.test(text)) {
        console.log('KODE FINAL (DIRECT):', text);
        return text;
    }

    console.warn('Kode unik tidak ditemukan dari QR');
    return null;
}



/* ======================
   FETCH API
====================== */
function fetchSarprasData(kode) {
    fetch(`/api/sarpras/by-kode-barang/${encodeURIComponent(kode)}`)
        .then(res => {
            if (!res.ok) throw new Error('404');
            return res.json();
        })
        .then(res => {
            const d = res.data;

            document.getElementById('sp_kode').value = d.kodeUnik;
            document.getElementById('sp_nama').value = d.namaBarang;
            document.getElementById('sp_merk').value = d.merk ?? '';
            document.getElementById('sp_spesifikasi').value = d.spesifikasi ?? '';

            if (d.foto) {
                document.getElementById('sp_foto').src = d.foto;
                document.getElementById('sp_foto').style.display = 'block';
                document.getElementById('sp_foto_input').value = d.foto;
            }

            Swal.fire('Berhasil', 'Data Sarpras ditemukan', 'success');
        })
        .catch(() => {
            Swal.fire('Gagal', 'Data Sarpras tidak ditemukan', 'error');
        });
}


const qrInput = document.getElementById('qrSarpras');
if (qrInput) {
    qrInput.addEventListener('change', function () {
        if (this.value.trim()) {
            fetchSarprasData(extractKodeUnik(this.value));
        }
    });
}


@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session("success") }}',
    timer: 3000,
    showConfirmButton: false,
    timerProgressBar: true
});
@endif
</script>

@endpush

@endsection

@section('footer')
    @include('be.footer')
@endsection
