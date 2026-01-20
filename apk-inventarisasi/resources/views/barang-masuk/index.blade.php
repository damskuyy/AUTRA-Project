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

    {{-- ================= TABS ================= --}}
    <ul class="nav nav-tabs mb-4" id="inventarisTabs" role="tablist" style="border-radius: 15px;">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="alat-tab" data-bs-toggle="tab" data-bs-target="#tabAlat" type="button">
                <i class="fas fa-tools me-2"></i>Alat
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="bahan-tab" data-bs-toggle="tab" data-bs-target="#tabBahan" type="button">
                <i class="fas fa-flask me-2"></i>Bahan
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link rounded-3 px-4 text-success"
                    data-bs-toggle="tab"
                    data-bs-target="#tabSarpras">
                <i class="fas fa-qrcode me-2"></i>Sarpras
            </button>
        </li>
    </ul>

    <div class="tab-content">

        {{-- ============================ ALAT ============================ --}}
        <div class="tab-pane fade show active" id="tabAlat">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <div class="mb-4">
                        <h5 class="fw-bold text-primary mb-1">Pendataan Alat</h5>
                        <small class="text-muted">Input data alat baru yang masuk ke TOI</small>
                    </div>

                    <form action="{{ route('barang-masuk.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="jenis_barang" value="alat">

                        <div class="row g-3">

                            {{-- Nama Alat --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Alat</label>
                                @if($riwayatNamaAlat->count())
                                    <select name="nama_barang" id="namaAlatSelect" class="form-select">
                                        <option value="">-- pilih alat --</option>
                                        @foreach($riwayatNamaAlat as $alat)
                                            <option value="{{ $alat }}">{{ $alat }}</option>
                                        @endforeach
                                        <option value="__new">+ Tambah Nama Baru</option>
                                    </select>
                                    <input type="text"
                                           name="nama_barang_new"
                                           id="namaAlatNew"
                                           class="form-control mt-2 d-none"
                                           placeholder="Nama alat baru">
                                @else
                                    <input type="text" name="nama_barang" class="form-control">
                                @endif
                            </div>

                            {{-- Merk --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Merk</label>
                                <input type="text"
                                       name="merk"
                                       class="form-control"
                                       placeholder="Bosch, Makita, dll">
                            </div>

                            {{-- Jumlah --}}
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Jumlah</label>
                                <input type="number"
                                       name="jumlah"
                                       class="form-control"
                                       value="1"
                                       min="1">
                            </div>

                            {{-- Ruangan --}}
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Ruangan</label>
                                <select name="ruangan_id" class="form-select">
                                    <option value="">-- pilih ruangan --</option>
                                    @foreach($ruangans as $r)
                                        <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Rak --}}
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Rak</label>
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

                            {{-- Sumber --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Sumber Barang</label>
                                <select name="sumber" id="sumberSelectAlat" class="form-select">
                                    <option value="">-- pilih sumber --</option>
                                    <option value="BOPD">BOPD</option>
                                    <option value="BOS">BOS</option>
                                    <option value="Bantuan Pemerintah">Bantuan Pemerintah</option>
                                    <option value="__manual">Lainnya</option>
                                </select>
                                <input type="text"
                                       name="sumber_manual"
                                       id="sumberManualAlat"
                                       class="form-control mt-2 d-none"
                                       placeholder="Sumber manual">
                            </div>

                            {{-- Tanggal --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" class="form-control">
                            </div>

                            {{-- Catatan --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold">Catatan</label>
                                <textarea name="catatan" class="form-control" rows="2"></textarea>
                            </div>

                        </div>

                        <div class="text-end mt-4">
                            <button class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Simpan Data Alat
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        {{-- ============================ BAHAN ============================ --}}
        <div class="tab-pane fade" id="tabBahan">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <div class="mb-4">
                        <h5 class="fw-bold text-primary mb-1">Pendataan Bahan</h5>
                        <small class="text-muted">Input bahan habis pakai</small>
                    </div>

                    <form action="{{ route('barang-masuk.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="jenis_barang" value="bahan">

                        <div class="row g-3">

                            {{-- Nama --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Bahan</label>
                                @if($riwayatNamaBahan->count())
                                    <select name="nama_barang" id="namaBahanSelect" class="form-select">
                                        <option value="">-- pilih bahan --</option>
                                        @foreach($riwayatNamaBahan as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                        <option value="__new">+ Tambah Nama Baru</option>
                                    </select>
                                    <input type="text"
                                           name="nama_barang_new"
                                           id="namaBahanNew"
                                           class="form-control mt-2 d-none"
                                           placeholder="Nama bahan baru">
                                @else
                                    <input type="text" name="nama_barang" class="form-control">
                                @endif
                            </div>

                            {{-- Merk --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Merk</label>
                                <input type="text" name="merk" class="form-control">
                            </div>

                            {{-- Satuan --}}
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Satuan</label>
                                <input type="text" name="satuan" class="form-control">
                            </div>

                            {{-- Jumlah --}}
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control">
                            </div>

                            {{-- Ruangan --}}
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Ruangan</label>
                                <select name="ruangan_id" class="form-select">
                                    <option value="">-- pilih ruangan --</option>
                                    @foreach($ruangans as $r)
                                        <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Rak --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Rak</label>
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

                            {{-- Sumber --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Sumber</label>
                                <select name="sumber" id="sumberSelectBahan" class="form-select">
                                    <option value="">-- pilih sumber --</option>
                                    <option value="BOPD">BOPD</option>
                                    <option value="BOS">BOS</option>
                                    <option value="Bantuan Pemerintah">Bantuan Pemerintah</option>
                                    <option value="__manual">Lainnya</option>
                                </select>
                                <input type="text"
                                       name="sumber_manual"
                                       id="sumberManualBahan"
                                       class="form-control mt-2 d-none">
                            </div>

                            {{-- Tanggal --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" class="form-control">
                            </div>

                            {{-- Catatan --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold">Catatan</label>
                                <textarea name="catatan" class="form-control" rows="2"></textarea>
                            </div>

                        </div>

                        <div class="text-end mt-4">
                            <button class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Simpan Data Bahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        {{-- ============================ SARPRAS ============================ --}}
        <div class="tab-pane fade" id="tabSarpras">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold text-success mb-3">
                        <i class="fas fa-qrcode me-2"></i>Pendataan Sarpras
                    </h5>

                    {{-- QR INPUT --}}
                    <div class="row g-3 align-items-end mb-2">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Kode QR</label>
                            <input type="text"
                                id="qrSarpras"
                                class="form-control"
                                placeholder="Scan / input kode barang">
                        </div>
                        <div class="col-md-4 d-grid">
                            <button type="button"
                                    class="btn btn-outline-success mb-0"
                                    onclick="openSarprasScanner()">
                                <i class="fas fa-camera me-2"></i>Scan QR
                            </button>
                        </div>
                        {{-- Tombol Input Manual --}}
                        <div class="mt-2" id="manualQrDiv" style="display:none;">
                            <button type="button"
                                    class="btn btn-sm btn-outline-secondary"
                                    onclick="enableManualQr()">
                                Input Manual
                            </button>
                        </div>
                    </div>

                    <div id="sarpras-reader"
                        class="mx-auto mb-4"
                        style="width:280px; display:none;"></div>

                    {{-- FORM --}}
                    <form action="{{ route('sarpras.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kode_unik" id="sp_kode">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama</label>
                                <input type="text" id="sp_nama" name="nama_barang" class="form-control" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Merk</label>
                                <input type="text" id="sp_merk" name="merk" class="form-control" readonly>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Spesifikasi</label>
                                <textarea id="sp_spesifikasi" name="spesifikasi" class="form-control" rows="2" readonly></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Ruangan</label>
                                <select name="ruangan_id" class="form-select" required>
                                    <option value="">-- pilih ruangan --</option>
                                    @foreach($ruangans as $r)
                                        <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="dipinjam">Dipinjam</option>
                                    <option value="rusak">Rusak</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Kondisi</label>
                                <select name="kondisi" class="form-select" required>
                                    <option value="baik">Baik</option>
                                    <option value="cukup">Cukup</option>
                                    <option value="rusak">Rusak</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Foto</label>
                                <img id="sp_foto"
                                    class="img-fluid rounded border"
                                    style="max-height:200px; display:none;">
                                <input type="hidden" name="foto" id="sp_foto_input">
                            </div>

                        </div>

                        <div class="text-end mt-4">
                            <button class="btn btn-success px-4">
                                <i class="fas fa-save me-2"></i>Simpan Sarpras
                            </button>
                        </div>

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

    sarprasScanner.stop();
    document.getElementById('sarpras-reader').style.display = 'none';

    const kode = extractKodeUnik(qrText);

    if (!kode) {
        Swal.fire('QR Tidak Valid', 'Kode tidak dikenali', 'error');
        scanned = false;
        return;
    }

    // tampilkan di input readonly
    qrInput.value = kode;
    qrInput.readOnly = true;

    // tampilkan tombol input manual hanya setelah scan
    document.getElementById('manualQrDiv').style.display = 'block';

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
function enableManualQr() {
    const qrInput = document.getElementById('qrSarpras');
    qrInput.readOnly = false;
    qrInput.value = '';
    qrInput.focus();

    // sembunyikan tombol
    document.getElementById('manualQrDiv').style.display = 'none';

    resetSarprasForm();
}

function resetSarprasForm() {
    document.getElementById('sp_kode').value = '';
    document.getElementById('sp_nama').value = '';
    document.getElementById('sp_merk').value = '';
    document.getElementById('sp_spesifikasi').value = '';

    const foto = document.getElementById('sp_foto');
    foto.src = '';
    foto.style.display = 'none';

    document.getElementById('sp_foto_input').value = '';
}

function fetchSarprasData(kode) {
    resetSarprasForm(); // 🔥 penting

    if (!kode) {
        Swal.fire('Error', 'Kode unik tidak valid', 'error');
        return;
    }

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
                const foto = document.getElementById('sp_foto');
                foto.src = d.foto;
                foto.style.display = 'block';
                document.getElementById('sp_foto_input').value = d.foto;
            }

            Swal.fire('Berhasil', 'Data Sarpras ditemukan', 'success');
        })
        .catch(() => {
            resetSarprasForm(); // 🔥 reset juga kalau gagal
            Swal.fire('Gagal', 'Data Sarpras tidak ditemukan', 'error');
        });
}


const qrInput = document.getElementById('qrSarpras');

if (qrInput) {
    qrInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();

            const kode = extractKodeUnik(this.value);

            if (kode) {
                fetchSarprasData(kode);
            } else {
                Swal.fire('Error', 'Kode tidak valid', 'error');
            }
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
@include('be.footer')
@endsection
