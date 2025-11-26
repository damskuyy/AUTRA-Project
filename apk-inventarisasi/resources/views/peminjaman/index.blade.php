@extends('be.layout')

@section('title', 'Peminjaman - Sistem Inventaris')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Peminjaman Barang</h5>
                        <small class="text-muted">Proses peminjaman inventaris sekolah — cepat dan mudah</small>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary btn-sm" onclick="history.back()">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </button>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#singlePeminjamanModal">
                            <i class="fas fa-plus me-1"></i> Pinjam Single
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Keranjang --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Keranjang Peminjaman</h6>
                    <span id="cart-badge" class="badge bg-primary">0</span>
                </div>
                <div class="card-body">
                    <div id="cart-empty" class="text-center py-4">
                        <i class="fas fa-shopping-cart text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-2 mb-0">Keranjang masih kosong</p>
                        <p class="text-sm text-muted">Pilih barang dari Inventaris atau tambah langsung</p>
                        <a href="{{ url('/inventaris') }}" class="btn btn-sm btn-outline-primary mt-3">Buka Inventaris</a>
                    </div>

                    <div id="cart-items" class="d-none">
                        <div class="table-responsive">
                            <table class="table table-borderless align-items-center mb-0 small">
                                <thead class="text-secondary text-xxs">
                                    <tr>
                                        <th>Barang</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Jumlah</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="cart-table-body"></tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">Total item: <span id="total-items" class="fw-bold">0</span></small>
                            <div>
                                <button id="clear-cart" class="btn btn-outline-danger btn-sm me-2">Kosongkan</button>
                                <button id="proceed-to-form" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#multiPeminjamanModal">
                                    Lanjutkan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar Peminjaman Aktif (ringkas) --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Peminjaman Aktif</h6>
                        <a href="{{ url('/peminjaman/riwayat') }}" class="btn btn-sm btn-outline-primary">Lihat Riwayat</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm align-items-center mb-0">
                            <thead class="text-secondary text-xxs">
                                <tr>
                                    <th>Kode</th>
                                    <th>Barang</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>OTP</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Contoh statis, tetap tampil ringkas --}}
                                <tr>
                                    <td>PMJ-001</td>
                                    <td>Laptop, Monitor (3)</td>
                                    <td>16 Mar 2024<br><small class="text-muted">08:00 - 10:00</small></td>
                                    <td><span class="badge bg-warning">Menunggu</span></td>
                                    <td><small class="otp-code">123456</small></td>
                                    <td class="text-end"><button class="btn btn-sm btn-outline-danger">Batalkan</button></td>
                                </tr>
                                <tr>
                                    <td>PMJ-002</td>
                                    <td>Mikroskop (1)</td>
                                    <td>15 Mar 2024<br><small class="text-muted">10:00 - 12:00</small></td>
                                    <td><span class="badge bg-success">Disetujui</span></td>
                                    <td><small class="otp-code">789012</small></td>
                                    <td class="text-end"><button class="btn btn-sm btn-success">Kembalikan</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Single Peminjaman (barcode/manual) --}}
<div class="modal fade" id="singlePeminjamanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pinjam Single Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="row gy-3">
                    <div class="col-md-6 text-center">
                        <div class="card border-0">
                            <div class="card-body">
                                <i class="fas fa-camera fa-2x text-primary mb-2"></i>
                                <h6>Scan Barcode</h6>
                                <p class="small text-muted">Gunakan kamera untuk scan kode barang</p>
                                <button class="btn btn-outline-primary btn-sm" data-bs-target="#barcodeModal" data-bs-toggle="modal">Scan</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="card border-0">
                            <div class="card-body">
                                <i class="fas fa-keyboard fa-2x text-info mb-2"></i>
                                <h6>Input Manual</h6>
                                <p class="small text-muted">Masukkan kode barang secara manual</p>
                                <button class="btn btn-outline-info btn-sm" data-bs-target="#manualModal" data-bs-toggle="modal">Input Kode</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Barcode --}}
<div class="modal fade" id="barcodeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Scan Barcode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small">Mata Pelajaran</label>
                        <select class="form-select form-select-sm" id="barcode-mapel">
                            <option value="">Pilih...</option>
                            <option>Fisika</option>
                            <option>Kimia</option>
                        </select>
                        <label class="form-label small mt-2">Ruangan</label>
                        <select class="form-select form-select-sm" id="barcode-ruangan">
                            <option value="">Pilih...</option>
                            <option>Lab Komputer 1</option>
                            <option>Lab IPA</option>
                        </select>
                    </div>
                    <div class="col-md-6 text-center">
                        <div id="barcode-scanner" class="border rounded p-4 mb-2" style="height: 200px; background: #f8f9fa;">
                            <div class="h-100 d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                    <i class="fas fa-camera text-muted" style="font-size: 2.5rem;"></i>
                                    <p class="text-muted small mt-2 mb-0">Tekan Aktifkan Kamera</p>
                                    <button class="btn btn-sm btn-primary mt-2" onclick="startBarcodeScanner()">Aktifkan</button>
                                </div>
                            </div>
                        </div>

                        <div id="scanned-item" class="card d-none">
                            <div class="card-body">
                                <h6 id="scanned-item-name">-</h6>
                                <p class="small text-muted" id="scanned-item-type">-</p>
                                <p class="small">Stok: <span id="scanned-item-stock" class="badge bg-success">-</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button id="submit-barcode" class="btn btn-success btn-sm">Ajukan</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Manual --}}
<div class="modal fade" id="manualModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Kode Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small">Mata Pelajaran</label>
                        <select id="manual-mapel" class="form-select form-select-sm">
                            <option value="">Pilih...</option>
                            <option>Fisika</option>
                            <option>Kimia</option>
                        </select>
                        <label class="form-label small mt-2">Ruangan</label>
                        <select id="manual-ruangan" class="form-select form-select-sm">
                            <option value="">Pilih...</option>
                            <option>Lab Komputer 1</option>
                            <option>Lab IPA</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small">Kode Barang</label>
                        <div class="input-group">
                            <input id="kode-barang" class="form-control form-control-sm" placeholder="Contoh: LP001" />
                            <button id="cari-barang" class="btn btn-sm btn-primary">Cari</button>
                        </div>

                        <div id="barang-info" class="card mt-3 d-none">
                            <div class="card-body">
                                <h6 id="nama-barang">-</h6>
                                <p class="small text-muted" id="jenis-barang">-</p>
                                <p class="small">Stok: <span id="stok-barang" class="badge bg-success">-</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button id="submit-manual" class="btn btn-success btn-sm">Ajukan</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Multi-Item Peminjaman --}}
<div class="modal fade" id="multiPeminjamanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Peminjaman (Multi Item)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <form id="peminjaman-form" novalidate>
                    <div class="mb-2">
                        <label class="form-label small">Nama Peminjam</label>
                        <input type="text" class="form-control form-control-sm" value="Ahmad Rizki" readonly>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label small">Mata Pelajaran <span class="text-danger">*</span></label>
                            <select id="mata-pelajaran" class="form-select form-select-sm" required>
                                <option value="">Pilih...</option>
                                <option>Fisika</option>
                                <option>Kimia</option>
                                <option>Biologi</option>
                                <option>Matematika</option>
                                <option>Informatika</option>
                            </select>
                            <div class="invalid-feedback">Pilih mata pelajaran.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small">Ruangan <span class="text-danger">*</span></label>
                            <select id="ruangan" class="form-select form-select-sm" required>
                                <option value="">Pilih...</option>
                                <option>Lab Komputer 1</option>
                                <option>Lab IPA</option>
                                <option>Ruang Guru</option>
                            </select>
                            <div class="invalid-feedback">Pilih ruangan.</div>
                        </div>
                    </div>

                    <div class="row g-2 mt-2">
                        <div class="col-md-6">
                            <label class="form-label small">Waktu Pinjam <span class="text-danger">*</span></label>
                            <input id="waktu-pinjam" type="datetime-local" class="form-control form-control-sm" required>
                            <div class="invalid-feedback">Isi waktu pinjam.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small">Waktu Kembali <span class="text-danger">*</span></label>
                            <input id="waktu-kembali" type="datetime-local" class="form-control form-control-sm" required>
                            <div class="invalid-feedback">Isi waktu kembali.</div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label small">Detail Barang</label>
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead class="text-secondary text-xxs">
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody id="form-items-table"></tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label small">Keterangan (opsional)</label>
                        <textarea id="keterangan" class="form-control form-control-sm" rows="2" placeholder="Contoh: Butuh untuk praktikum"></textarea>
                    </div>
                </form>

                {{-- OTP area --}}
                <div id="otp-card" class="card mt-3 d-none shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="mb-2">Kode OTP</h6>
                        <h2 id="otp-code" class="fw-bold">------</h2>
                        <small class="text-muted">Berlaku: <span id="countdown">00:00</span></small>
                        <div class="mt-3 d-flex justify-content-center gap-2">
                            <button class="btn btn-sm btn-outline-secondary" onclick="printOTP()"><i class="fas fa-print me-1"></i> Cetak</button>
                            <button id="copy-otp" class="btn btn-sm btn-outline-primary"><i class="fas fa-copy me-1"></i> Salin</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="w-100 d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    </div>
                    <div>
                        <button type="submit" id="submit-peminjaman" form="peminjaman-form" class="btn btn-primary btn-sm">
                            <i class="fas fa-paper-plane me-1"></i> Ajukan Peminjaman
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Toast container --}}
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
    <div id="toast-container"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Dummy localStorage cart
    let cart = JSON.parse(localStorage.getItem('inventoryCart')) || {};

    const stockData = {
        1: { nama: 'Laptop', stok: 15, kategori: 'elektronik' },
        2: { nama: 'Monitor', stok: 8, kategori: 'elektronik' },
        3: { nama: 'Keyboard', stok: 20, kategori: 'elektronik' },
        4: { nama: 'Proyektor', stok: 0, kategori: 'elektronik' },
        6: { nama: 'Mikroskop', stok: 12, kategori: 'alat_lab' },
        7: { nama: 'Tabung Reaksi', stok: 5, kategori: 'bahan_kimia' },
        8: { nama: 'Beker Gelas', stok: 25, kategori: 'alat_lab' }
    };

    const kodeBarangMap = {
        'LP001': 1, 'MN002': 2, 'KB003': 3, 'PJ004': 4, 'MK006': 6, 'TR007': 7, 'BG008': 8
    };

    // Elemen
    const cartEmptyEl = document.getElementById('cart-empty');
    const cartItemsEl = document.getElementById('cart-items');
    const cartTableBody = document.getElementById('cart-table-body');
    const totalItemsEl = document.getElementById('total-items');
    const totalBadge = document.getElementById('cart-badge');
    const formItemsTable = document.getElementById('form-items-table');
    const proceedBtn = document.getElementById('proceed-to-form');
    const submitPeminjamanBtn = document.getElementById('submit-peminjaman');
    const otpCard = document.getElementById('otp-card');
    const otpCodeEl = document.getElementById('otp-code');
    const countdownEl = document.getElementById('countdown');
    const toastContainer = document.getElementById('toast-container');
    const clearCartBtn = document.getElementById('clear-cart');

    // Inisialisasi tampilan
    renderCart();

    // Render cart & form list
    function renderCart() {
        cartTableBody.innerHTML = '';
        formItemsTable.innerHTML = '';
        let total = 0;

        Object.keys(cart).forEach(id => {
            const qty = cart[id];
            const item = stockData[id];
            if (!item) return;
            total += qty;

            // Keranjang row
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <div class="d-flex align-items-center">
                        <div class="me-3"><i class="fas fa-box text-primary"></i></div>
                        <div><div class="text-sm">${escapeHtml(item.nama)}</div></div>
                    </div>
                </td>
                <td class="text-center"><span class="badge ${item.stok>5?'bg-success': item.stok>0?'bg-warning':'bg-danger'}">${item.stok}</span></td>
                <td class="text-center">
                    <div class="d-flex justify-content-center align-items-center gap-1">
                        <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity(${id}, -1)" aria-label="Kurangi ${escapeHtml(item.nama)}">-</button>
                        <div class="px-2">${qty}</div>
                        <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity(${id}, 1)" aria-label="Tambah ${escapeHtml(item.nama)}">+</button>
                    </div>
                </td>
                <td class="text-end"><button class="btn btn-sm btn-outline-danger" onclick="removeFromCart(${id})"><i class="fas fa-trash"></i></button></td>
            `;
            cartTableBody.appendChild(tr);

            // Form row (ringkas)
            const ftr = document.createElement('tr');
            ftr.innerHTML = `
                <td>${escapeHtml(item.nama)}</td>
                <td class="text-center"><span class="badge ${item.stok>5?'bg-success': item.stok>0?'bg-warning':'bg-danger'}">${item.stok}</span></td>
                <td class="text-center">${qty} unit</td>
            `;
            formItemsTable.appendChild(ftr);
        });

        totalItemsEl.textContent = total;
        totalBadge.textContent = total;
        if (total > 0) {
            cartEmptyEl.classList.add('d-none');
            cartItemsEl.classList.remove('d-none');
            proceedBtn.disabled = false;
            submitPeminjamanBtn.disabled = false;
            clearCartBtn.disabled = false;
        } else {
            cartEmptyEl.classList.remove('d-none');
            cartItemsEl.classList.add('d-none');
            proceedBtn.disabled = true;
            submitPeminjamanBtn.disabled = true;
            clearCartBtn.disabled = true;
        }

        // Simpan ke localStorage
        localStorage.setItem('inventoryCart', JSON.stringify(cart));
    }

    // Helper safe text
    function escapeHtml(text){ 
        return text ? text.toString().replace(/[&<>"']/g, function(m){ 
            return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]; 
        }) : ''; 
    }

    // Update quantity (global untuk dipanggil dari onclick)
    window.updateQuantity = function(id, delta) {
        id = String(id);
        if (!stockData[id]) return;
        const current = cart[id] || 0;
        const next = current + delta;
        if (next <= 0) {
            delete cart[id];
            renderCart();
            showToast('Item dihapus dari keranjang', 'info');
            return;
        }
        if (next > stockData[id].stok) {
            showToast(`Stok ${stockData[id].nama} hanya ${stockData[id].stok}`, 'warning');
            return;
        }
        cart[id] = next;
        renderCart();
    };

    window.removeFromCart = function(id) {
        id = String(id);
        delete cart[id];
        renderCart();
        showToast('Item dihapus', 'info');
    };

    clearCartBtn.addEventListener('click', function(){
        if (!confirm('Kosongkan keranjang?')) return;
        cart = {};
        renderCart();
        showToast('Keranjang dikosongkan', 'success');
    });

    // Event listener untuk modal multi peminjaman
    const multiPeminjamanModal = document.getElementById('multiPeminjamanModal');
    multiPeminjamanModal.addEventListener('show.bs.modal', function () {
        // Pastikan form items ter-update
        renderCart();
        
        // Reset form validation
        const form = document.getElementById('peminjaman-form');
        form.classList.remove('was-validated');
        
        // Sembunyikan OTP card jika sebelumnya ditampilkan
        otpCard.classList.add('d-none');
        
        // Reset form fields
        document.getElementById('mata-pelajaran').value = '';
        document.getElementById('ruangan').value = '';
        document.getElementById('waktu-pinjam').value = '';
        document.getElementById('waktu-kembali').value = '';
        document.getElementById('keterangan').value = '';
    });

    // Form submit
    document.getElementById('peminjaman-form').addEventListener('submit', function(e){
        e.preventDefault();
        const mapel = document.getElementById('mata-pelajaran').value.trim();
        const ruangan = document.getElementById('ruangan').value.trim();
        const waktuPinjam = document.getElementById('waktu-pinjam').value;
        const waktuKembali = document.getElementById('waktu-kembali').value;
        
        // Validasi form
        if (!mapel || !ruangan || !waktuPinjam || !waktuKembali) {
            showToast('Lengkapi semua field wajib', 'warning');
            // Simple validation UI
            ['mata-pelajaran','ruangan','waktu-pinjam','waktu-kembali'].forEach(id => {
                const el = document.getElementById(id);
                if (el && !el.value) el.classList.add('is-invalid');
                else if (el) el.classList.remove('is-invalid');
            });
            return;
        }

        if (Object.keys(cart).length === 0) {
            showToast('Keranjang kosong — tambahkan barang terlebih dahulu', 'warning');
            return;
        }

        // Generate OTP (tanpa spasi untuk salin)
        const rawOtp = Math.floor(100000 + Math.random() * 900000).toString();
        otpCodeEl.textContent = rawOtp.replace(/(\d{1})/g, '$1 ').trim(); // tampil spaced
        otpCodeEl.dataset.raw = rawOtp;

        // Simpan peminjaman ringkas ke localStorage (contoh)
        const peminjamanData = {
            items: cart,
            mapel, ruangan, waktuPinjam, waktuKembali,
            otp: rawOtp,
            note: document.getElementById('keterangan').value || ''
        };
        localStorage.setItem('lastPeminjaman', JSON.stringify(peminjamanData));

        // Kosongkan cart
        cart = {};
        renderCart();

        // Tampilkan OTP dan mulai countdown
        otpCard.classList.remove('d-none');
        startCountdown(10 * 60);
        showToast('Peminjaman diajukan — tunjukkan kode OTP ke guru/admin', 'success');
        
        // Nonaktifkan tombol submit setelah berhasil
        submitPeminjamanBtn.disabled = true;
    });

    // Countdown
    let countdownInterval = null;
    function startCountdown(duration) {
        clearInterval(countdownInterval);
        let timer = duration;
        updateCountdownDisplay(timer);
        countdownInterval = setInterval(() => {
            timer--;
            if (timer < 0) {
                clearInterval(countdownInterval);
                updateCountdownDisplay(0);
                showToast('Kode OTP telah kedaluwarsa', 'warning');
                return;
            }
            updateCountdownDisplay(timer);
        }, 1000);
    }
    function updateCountdownDisplay(sec) {
        const m = String(Math.floor(sec / 60)).padStart(2, '0');
        const s = String(sec % 60).padStart(2, '0');
        countdownEl.textContent = `${m}:${s}`;
    }

    // Copy OTP
    document.getElementById('copy-otp').addEventListener('click', function(){
        const raw = otpCodeEl.dataset.raw || otpCodeEl.textContent.replace(/\s/g,'');
        navigator.clipboard.writeText(raw).then(() => showToast('OTP disalin', 'success'));
    });

    // Print OTP
    window.printOTP = function() {
        const raw = otpCodeEl.dataset.raw || otpCodeEl.textContent.replace(/\s/g,'');
        const content = `
            <div style="text-align:center;padding:20px;font-family:Arial">
                <h3>Kode OTP Peminjaman</h3>
                <h1 style="letter-spacing:12px;margin:20px 0">${raw}</h1>
                <p>Berlaku hingga: ${countdownEl.textContent}</p>
                <p style="font-size:12px;color:#666">${new Date().toLocaleString()}</p>
            </div>`;
        const w = window.open('', '_blank');
        w.document.write(content);
        w.document.close();
        w.print();
    };

    // Toast helper (Bootstrap-like)
    function showToast(message, type='info', timeout=3500) {
        const id = 't'+Date.now();
        const bg = type === 'success' ? 'bg-success text-white' : 
                   type === 'warning' ? 'bg-warning' : 
                   type === 'danger' || type === 'error' ? 'bg-danger text-white' : 
                   'bg-secondary text-white';
        const el = document.createElement('div');
        el.id = id;
        el.className = `toast align-items-center ${bg} border-0 mb-2`;
        el.style.minWidth = '240px';
        el.innerHTML = `<div class="d-flex">
            <div class="toast-body small">${escapeHtml(message)}</div>
            <button type="button" class="btn-close btn-close-white me-2 mt-2" aria-label="Close"></button>
        </div>`;
        toastContainer.appendChild(el);
        // close button
        el.querySelector('.btn-close').addEventListener('click', () => el.remove());
        setTimeout(()=> el.remove(), timeout);
    }

    // Manual search kode barang
    document.getElementById('cari-barang').addEventListener('click', function(e){
        e.preventDefault();
        const kode = document.getElementById('kode-barang').value.trim().toUpperCase();
        if (!kode) { showToast('Masukkan kode barang', 'warning'); return; }
        const id = kodeBarangMap[kode];
        if (id && stockData[id]) {
            const it = stockData[id];
            document.getElementById('nama-barang').textContent = it.nama;
            document.getElementById('jenis-barang').textContent = getJenisBarang(it.kategori);
            document.getElementById('stok-barang').textContent = it.stok;
            document.getElementById('stok-barang').className = `badge ${it.stok>0?'bg-success':'bg-danger'}`;
            document.getElementById('barang-info').classList.remove('d-none');
            showToast('Barang ditemukan', 'success');
        } else {
            document.getElementById('barang-info').classList.add('d-none');
            showToast('Kode barang tidak ditemukan', 'danger');
        }
    });

    // Submit manual peminjaman (single)
    document.getElementById('submit-manual').addEventListener('click', function(){
        const info = document.getElementById('barang-info');
        if (info.classList.contains('d-none')) { showToast('Cari barang terlebih dahulu', 'warning'); return; }
        const mapel = document.getElementById('manual-mapel').value;
        const ruang = document.getElementById('manual-ruangan').value;
        if (!mapel || !ruang) { showToast('Lengkapi data peminjaman', 'warning'); return; }
        showToast('Peminjaman single diajukan', 'success');
        bootstrap.Modal.getOrCreateInstance(document.getElementById('manualModal')).hide();
        bootstrap.Modal.getOrCreateInstance(document.getElementById('singlePeminjamanModal')).hide();
    });

    // Simulasi barcode scanner
    window.startBarcodeScanner = function(){
        const box = document.getElementById('barcode-scanner');
        box.innerHTML = `<div class="text-center">
            <div class="spinner-border text-primary mb-2" role="status"></div>
            <div class="small text-muted">Mengaktifkan kamera...</div>
        </div>`;
        setTimeout(()=> {
            const random = [1,2,6,8][Math.floor(Math.random()*4)];
            const it = stockData[random];
            box.innerHTML = `<div class="text-center"><i class="fas fa-check-circle text-success" style="font-size:2rem"></i><div class="small text-success mt-1">Ter-scan</div></div>`;
            document.getElementById('scanned-item-name').textContent = it.nama;
            document.getElementById('scanned-item-type').textContent = getJenisBarang(it.kategori);
            document.getElementById('scanned-item-stock').textContent = it.stok;
            document.getElementById('scanned-item-stock').className = `badge ${it.stok>0?'bg-success':'bg-danger'}`;
            document.getElementById('scanned-item').classList.remove('d-none');
            showToast(it.nama + ' berhasil di-scan', 'success');
        }, 1600);
    };

    // Submit barcode single
    document.getElementById('submit-barcode').addEventListener('click', function(){
        const scanned = document.getElementById('scanned-item');
        if (scanned.classList.contains('d-none')) { showToast('Scan barang terlebih dahulu', 'warning'); return; }
        const mapel = document.getElementById('barcode-mapel').value;
        const ruang = document.getElementById('barcode-ruangan').value;
        if (!mapel || !ruang) { showToast('Lengkapi data peminjaman', 'warning'); return; }
        showToast('Peminjaman single diajukan', 'success');
        bootstrap.Modal.getOrCreateInstance(document.getElementById('barcodeModal')).hide();
        bootstrap.Modal.getOrCreateInstance(document.getElementById('singlePeminjamanModal')).hide();
    });

    // Utility: map kategori
    function getJenisBarang(k) {
        const m = {'elektronik':'Elektronik','alat_lab':'Alat Laboratorium','bahan_kimia':'Bahan Kimia','perlengkapan':'Perlengkapan'};
        return m[k] || 'Lainnya';
    }

    // Tambahan: contoh menambahkan item ke cart (untuk demo) - bisa dihapus/di-link ke halaman inventaris
    window.addToCart = function(id, qty = 1) {
        id = String(id);
        if (!stockData[id]) return showToast('Barang tidak ditemukan', 'danger');
        const next = (cart[id] || 0) + qty;
        if (next > stockData[id].stok) return showToast('Jumlah melebihi stok', 'warning');
        cart[id] = next;
        renderCart();
        showToast(`${stockData[id].nama} ditambahkan ke keranjang`, 'success');
    };

    // Auto-add satu item untuk demo (opsional)
    if (Object.keys(cart).length === 0) {
        // addToCart(1,1); // Uncomment jika ingin ada item demo otomatis
    }
});
</script>
@endsection

@section('footer')
    @include('be.footer')
@endsection