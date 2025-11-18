@extends('be.layout')

@section('title', 'Pemakaian - Sistem Inventaris')

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
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Pemakaian Bahan</h6>
                            <p class="text-sm mb-0">Kelola pemakaian bahan habis pakai</p>
                        </div>
                        <div class="d-flex">
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPemakaianModal">
                                <i class="fas fa-plus me-1"></i> Tambah Pemakaian
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Pemakaian -->
    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Hari Ini</p>
                                <h5 class="font-weight-bolder mb-0">5 Items</h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+2</span>
                                    dari kemarin
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="fas fa-calendar-day text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Minggu Ini</p>
                                <h5 class="font-weight-bolder mb-0">18 Items</h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+8</span>
                                    dari minggu lalu
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="fas fa-calendar-week text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Menunggu</p>
                                <h5 class="font-weight-bolder mb-0">3 Items</h5>
                                <p class="mb-0">
                                    <span class="text-warning text-sm font-weight-bolder">Perlu persetujuan</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="fas fa-clock text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Disetujui</p>
                                <h5 class="font-weight-bolder mb-0">25 Items</h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">Bulan ini</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                <i class="fas fa-check-circle text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Pemakaian Aktif -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Pemakaian Aktif</h6>
                        <a href="{{ url('/pemakaian/riwayat') }}" class="btn btn-sm btn-outline-primary">Lihat Riwayat</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bahan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mapel</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <div class="icon icon-shape icon-sm bg-gradient-primary shadow text-center border-radius-md me-3">
                                                    <i class="fas fa-vial text-white opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Tabung Reaksi</h6>
                                                <p class="text-xs text-secondary mb-0">Bahan Kimia</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">5 pcs</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">16 Mar 2024</p>
                                        <p class="text-xs text-secondary mb-0">10:00 WIB</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Kimia</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-warning">Menunggu</span>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-sm btn-outline-danger mb-0">
                                            Batalkan
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <div class="icon icon-shape icon-sm bg-gradient-success shadow text-center border-radius-md me-3">
                                                    <i class="fas fa-wine-glass-alt text-white opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Beker Gelas</h6>
                                                <p class="text-xs text-secondary mb-0">Alat Lab</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">3 pcs</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">15 Mar 2024</p>
                                        <p class="text-xs text-secondary mb-0">08:00 WIB</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Fisika</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-success">Disetujui</span>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-sm btn-outline-info mb-0">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <div class="icon icon-shape icon-sm bg-gradient-info shadow text-center border-radius-md me-3">
                                                    <i class="fas fa-flask text-white opacity-10"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Asam Sulfat</h6>
                                                <p class="text-xs text-secondary mb-0">Bahan Kimia</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">100 ml</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">14 Mar 2024</p>
                                        <p class="text-xs text-secondary mb-0">13:00 WIB</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Kimia</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-danger">Ditolak</span>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-sm btn-outline-danger mb-0">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pemakaian -->
<div class="modal fade" id="tambahPemakaianModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pemakaian Bahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-pemakaian">
                    <!-- Form 1: Data Pemakaian -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">Data Pemakaian</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Siswa</label>
                                        <input type="text" class="form-control" value="Ahmad Rizki" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kelas</label>
                                        <input type="text" class="form-control" value="XII IPA 1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                                        <select class="form-control" id="pemakaian-mapel" required>
                                            <option value="">Pilih Mata Pelajaran</option>
                                            <option value="Fisika">Fisika</option>
                                            <option value="Kimia">Kimia</option>
                                            <option value="Biologi">Biologi</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Ruangan <span class="text-danger">*</span></label>
                                        <select class="form-control" id="pemakaian-ruangan" required>
                                            <option value="">Pilih Ruangan</option>
                                            <option value="Lab Komputer 1">Lab Komputer 1</option>
                                            <option value="Lab IPA">Lab IPA</option>
                                            <option value="Ruang Praktek">Ruang Praktek</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Waktu Pemakaian <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" id="waktu-pemakaian" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control" rows="3" placeholder="Jelaskan tujuan pemakaian bahan..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Form 2: Pilih Barang -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Pilih Bahan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bahan</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stok</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bahan-table">
                                        <!-- Bahan items will be populated by JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-3" onclick="tambahBarisBahan()">
                                <i class="fas fa-plus me-1"></i> Tambah Bahan Lain
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="form-pemakaian" class="btn bg-gradient-success">Ajukan Pemakaian</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Data dummy bahan habis pakai
    const bahanData = [
        { id: 1, nama: "Tabung Reaksi", stok: 50, satuan: "pcs", kategori: "bahan_kimia" },
        { id: 2, nama: "Beker Gelas", stok: 30, satuan: "pcs", kategori: "alat_lab" },
        { id: 3, nama: "Asam Sulfat", stok: 2000, satuan: "ml", kategori: "bahan_kimia" },
        { id: 4, nama: "Aquades", stok: 5000, satuan: "ml", kategori: "bahan_kimia" },
        { id: 5, nama: "Kertas Lakmus", stok: 100, satuan: "lembar", kategori: "bahan_kimia" }
    ];

    document.addEventListener('DOMContentLoaded', function() {
        renderBahanTable();
        
        // Event listener untuk form pemakaian
        document.getElementById('form-pemakaian').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validasi form
            const mapel = document.getElementById('pemakaian-mapel').value;
            const ruangan = document.getElementById('pemakaian-ruangan').value;
            const waktu = document.getElementById('waktu-pemakaian').value;
            
            if (!mapel || !ruangan || !waktu) {
                showNotification('Harap lengkapi semua field yang wajib diisi', 'warning');
                return;
            }
            
            // Validasi bahan yang dipilih
            const selectedBahan = getSelectedBahan();
            if (selectedBahan.length === 0) {
                showNotification('Pilih minimal satu bahan', 'warning');
                return;
            }
            
            showNotification('Pemakaian bahan berhasil diajukan! Menunggu persetujuan guru.', 'success');
            $('#tambahPemakaianModal').modal('hide');
        });
    });

    function renderBahanTable() {
        const bahanTable = document.getElementById('bahan-table');
        bahanTable.innerHTML = '';

        bahanData.forEach((bahan, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <div class="d-flex align-items-center">
                        <div class="form-check">
                            <input class="form-check-input bahan-checkbox" type="checkbox" id="bahan-${bahan.id}" data-id="${bahan.id}">
                        </div>
                        <label class="form-check-label ms-2" for="bahan-${bahan.id}">
                            ${bahan.nama}
                        </label>
                    </div>
                </td>
                <td>
                    <span class="badge badge-sm ${bahan.stok > 10 ? 'bg-gradient-success' : bahan.stok > 0 ? 'bg-gradient-warning' : 'bg-gradient-danger'}">${bahan.stok}</span>
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm jumlah-bahan" data-id="${bahan.id}" 
                           placeholder="0" min="0" max="${bahan.stok}" style="width: 80px;" disabled>
                </td>
                <td>
                    <span class="text-sm">${bahan.satuan}</span>
                </td>
            `;
            bahanTable.appendChild(tr);
        });

        // Event listener untuk checkbox
        document.querySelectorAll('.bahan-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const bahanId = this.getAttribute('data-id');
                const jumlahInput = document.querySelector(`.jumlah-bahan[data-id="${bahanId}"]`);
                jumlahInput.disabled = !this.checked;
                if (!this.checked) {
                    jumlahInput.value = '';
                }
            });
        });
    }

    function tambahBarisBahan() {
        const bahanTable = document.getElementById('bahan-table');
        const newId = Date.now(); // ID unik untuk baris baru
        
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>
                <select class="form-control form-control-sm" id="bahan-select-${newId}">
                    <option value="">Pilih Bahan</option>
                    ${bahanData.map(bahan => `
                        <option value="${bahan.id}">${bahan.nama}</option>
                    `).join('')}
                </select>
            </td>
            <td>
                <span class="badge badge-sm bg-gradient-secondary" id="stok-${newId}">-</span>
            </td>
            <td>
                <input type="number" class="form-control form-control-sm" placeholder="0" min="1" style="width: 80px;">
            </td>
            <td>
                <span class="text-sm" id="satuan-${newId}">-</span>
            </td>
        `;
        bahanTable.appendChild(tr);

        // Event listener untuk select bahan
        document.getElementById(`bahan-select-${newId}`).addEventListener('change', function() {
            const selectedId = this.value;
            const bahan = bahanData.find(b => b.id == selectedId);
            if (bahan) {
                document.getElementById(`stok-${newId}`).textContent = bahan.stok;
                document.getElementById(`stok-${newId}`).className = `badge badge-sm ${bahan.stok > 10 ? 'bg-gradient-success' : 'bg-gradient-warning'}`;
                document.getElementById(`satuan-${newId}`).textContent = bahan.satuan;
            } else {
                document.getElementById(`stok-${newId}`).textContent = '-';
                document.getElementById(`stok-${newId}`).className = 'badge badge-sm bg-gradient-secondary';
                document.getElementById(`satuan-${newId}`).textContent = '-';
            }
        });
    }

    function getSelectedBahan() {
        const selectedBahan = [];
        
        // Bahan dari checkbox
        document.querySelectorAll('.bahan-checkbox:checked').forEach(checkbox => {
            const bahanId = checkbox.getAttribute('data-id');
            const jumlahInput = document.querySelector(`.jumlah-bahan[data-id="${bahanId}"]`);
            const jumlah = parseInt(jumlahInput.value) || 0;
            
            if (jumlah > 0) {
                const bahan = bahanData.find(b => b.id == bahanId);
                if (bahan) {
                    selectedBahan.push({
                        id: bahan.id,
                        nama: bahan.nama,
                        jumlah: jumlah,
                        satuan: bahan.satuan
                    });
                }
            }
        });

        // Bahan dari select tambahan
        document.querySelectorAll('select[id^="bahan-select-"]').forEach(select => {
            if (select.value) {
                const bahanId = select.value;
                const row = select.closest('tr');
                const jumlahInput = row.querySelector('input[type="number"]');
                const jumlah = parseInt(jumlahInput.value) || 0;
                
                if (jumlah > 0) {
                    const bahan = bahanData.find(b => b.id == bahanId);
                    if (bahan) {
                        selectedBahan.push({
                            id: bahan.id,
                            nama: bahan.nama,
                            jumlah: jumlah,
                            satuan: bahan.satuan
                        });
                    }
                }
            }
        });

        return selectedBahan;
    }

    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(notification);
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 3000);
    }
</script>
@endsection

@section('footer')
    @include('be.footer')
@endsection