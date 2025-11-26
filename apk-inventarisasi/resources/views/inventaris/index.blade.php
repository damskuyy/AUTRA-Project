@extends('be.layout')

@section('title', 'Inventaris - Sistem Inventaris')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Sistem Inventaris</h6>
                            <p class="text-sm mb-0">Kelola dan pantau inventaris barang di berbagai ruangan</p>
                        </div>
                        <div class="d-flex">
                            <!-- hanya tampilkan 1 button utama (Pinjam Sekarang) + badge count di dalamnya.
                                 tombol kosongkan & indikator lama disembunyikan dan akan ditampilkan
                                 bila diperlukan (di sini kita keep hidden sesuai permintaan). -->
                            <button id="pinjam-btn" class="btn btn-sm bg-gradient-primary" onclick="goToPeminjaman()" disabled>
                                <i class="fas fa-clipboard-check me-1"></i>
                                Pinjam Sekarang
                                <span id="pinjam-count" class="badge bg-light text-dark ms-2 d-none">0</span>
                            </button>
                            <button id="clear-cart-btn" class="btn btn-sm bg-gradient-secondary ms-2 d-none" onclick="clearCart()">
                                <i class="fas fa-trash me-1"></i> Kosongkan Keranjang
                            </button>
                            <span id="cart-indicator" class="badge bg-gradient-primary ms-2 d-none">
                                <i class="fas fa-shopping-cart me-1"></i><span id="cart-count">0</span> items
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Panel Kiri - List Inventaris -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Data Inventaris Ruangan</h6>
                            <p class="text-sm mb-0">Stok real-time per ruangan</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm bg-gradient-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-filter me-1"></i> Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item filter-option" href="javascript:void(0)" data-filter="all">Semua Ruangan</a></li>
                                <li><a class="dropdown-item filter-option" href="javascript:void(0)" data-filter="lab">Lab Komputer</a></li>
                                <li><a class="dropdown-item filter-option" href="javascript:void(0)" data-filter="ipa">Lab IPA</a></li>
                                <li><a class="dropdown-item filter-option" href="javascript:void(0)" data-filter="guru">Ruang Guru</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row" id="ruangan-list">
                        <!-- Ruangan items will be populated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Kanan - Katalog Alat -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Katalog Alat</h6>
                            <p class="text-sm mb-0">Pilih dan pinjam alat yang tersedia</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm bg-gradient-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-sort me-1"></i> Urutkan
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item sort-option" href="javascript:void(0)" data-sort="name">Nama A-Z</a></li>
                                <li><a class="dropdown-item sort-option" href="javascript:void(0)" data-sort="stock">Stok Terbanyak</a></li>
                                <li><a class="dropdown-item sort-option" href="javascript:void(0)" data-sort="category">Kategori</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row" id="katalog-items">
                        <!-- Katalog items will be populated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: daftar barang per ruangan -->
<div class="modal fade" id="roomModal" tabindex="-1" aria-labelledby="roomModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="roomModalLabel">Daftar Barang - <span id="modalRoomName"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row" id="roomItemsList">
            <!-- Room items will be populated by JavaScript -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<script>
    // Data dummy inventaris
    const inventarisData = {
        ruangan: [
            {
                id: 1,
                nama: "Lab Komputer 1",
                kategori: "lab",
                icon: "fa-desktop",
                color: "primary",
                items: [
                    { id: 1, nama: "Laptop", stok: 15, kategori: "elektronik", gambar: "https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" },
                    { id: 2, nama: "Keyboard", stok: 20, kategori: "elektronik", gambar: "https://images.unsplash.com/photo-1541140532154-b024d705b90a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" },
                    { id: 7, nama: "Mouse", stok: 18, kategori: "elektronik", gambar: "https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" }
                ]
            },
            {
                id: 2,
                nama: "Ruang Guru",
                kategori: "guru",
                icon: "fa-chalkboard-teacher",
                color: "success",
                items: [
                    { id: 3, nama: "Proyektor", stok: 0, kategori: "elektronik", gambar: "https://images.unsplash.com/photo-1586953208448-b95a79798f07?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" },
                    { id: 4, nama: "Papan Tulis", stok: 3, kategori: "perlengkapan", gambar: "https://images.unsplash.com/photo-1516834474-48c0abc2a902?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" },
                    { id: 8, nama: "Speaker", stok: 5, kategori: "elektronik", gambar: "https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" }
                ]
            },
            {
                id: 3,
                nama: "Lab IPA",
                kategori: "ipa",
                icon: "fa-flask",
                color: "warning",
                items: [
                    { id: 5, nama: "Tabung Reaksi", stok: 5, kategori: "bahan_kimia", gambar: "https://images.unsplash.com/photo-1536935338788-846bb9981813?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" },
                    { id: 6, nama: "Beker Gelas", stok: 25, kategori: "alat_lab", gambar: "https://images.unsplash.com/photo-1586773860418-d37222d8fce3?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" },
                    { id: 9, nama: "Mikroskop", stok: 8, kategori: "alat_lab", gambar: "https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" }
                ]
            },
            {
                id: 4,
                nama: "Perpustakaan",
                kategori: "umum",
                icon: "fa-book",
                color: "info",
                items: [
                    { id: 10, nama: "Kamera Digital", stok: 4, kategori: "elektronik", gambar: "https://images.unsplash.com/photo-1502920917128-1aa500764cbd?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" },
                    { id: 11, nama: "Tripod", stok: 6, kategori: "perlengkapan", gambar: "https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" }
                ]
            }
        ]
    };

    let cart = JSON.parse(localStorage.getItem('inventoryCart')) || {};
    let currentFilter = 'all';

    document.addEventListener('DOMContentLoaded', function() {
        renderRuanganList();
        renderKatalog();
        updateCartDisplay();
        
        // Event listeners untuk dropdown
        setupDropdownEvents();
    });

    function setupDropdownEvents() {
        // Filter ruangan
        document.querySelectorAll('.filter-option').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const filter = this.getAttribute('data-filter');
                filterRuangan(filter);
            });
        });

        // Sort katalog
        document.querySelectorAll('.sort-option').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const sort = this.getAttribute('data-sort');
                sortKatalog(sort);
            });
        });
    }

    function renderRuanganList() {
        const ruanganList = document.getElementById('ruangan-list');
        ruanganList.innerHTML = '';

        const filteredRuangan = inventarisData.ruangan.filter(ruangan => {
            if (currentFilter === 'all') return true;
            return ruangan.kategori === currentFilter;
        });

        filteredRuangan.forEach(ruangan => {
            const totalItems = ruangan.items.length;
            const totalStok = ruangan.items.reduce((sum, item) => sum + item.stok, 0);
            
            const ruanganElement = document.createElement('div');
            ruanganElement.className = 'col-md-6 mb-4';
            ruanganElement.innerHTML = `
                <div class="card hover-card cursor-pointer" onclick="showRoomItems(${ruangan.id})">
                    <div class="card-body text-center p-3">
                        <div class="icon icon-shape bg-gradient-${ruangan.color} shadow text-center border-radius-lg mx-auto mb-3" style="width: 70px; height: 70px;">
                            <i class="fas ${ruangan.icon} text-white opacity-10" style="font-size: 1.5rem;"></i>
                        </div>
                        <h6 class="mb-1">${ruangan.nama}</h6>
                        <div class="d-flex justify-content-center gap-3 mt-2">
                            <span class="badge badge-sm bg-gradient-secondary">
                                <i class="fas fa-box me-1"></i>${totalItems} Barang
                            </span>
                            <span class="badge badge-sm bg-gradient-primary">
                                <i class="fas fa-cubes me-1"></i>${totalStok} Unit
                            </span>
                        </div>
                        <p class="text-xs text-secondary mt-2 mb-0">Klik untuk lihat detail</p>
                    </div>
                </div>
            `;
            ruanganList.appendChild(ruanganElement);
        });
    }

    function showRoomItems(roomId) {
        const ruangan = inventarisData.ruangan.find(r => r.id === roomId);
        if (!ruangan) return;

        document.getElementById('modalRoomName').textContent = ruangan.nama;
        const roomItemsList = document.getElementById('roomItemsList');
        roomItemsList.innerHTML = '';

        ruangan.items.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'col-md-6 mb-3';
            itemElement.innerHTML = `
                <div class="card border">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <img src="${item.gambar}" alt="${item.nama}" 
                                 class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 text-sm">${item.nama}</h6>
                                <p class="text-xs text-secondary mb-0">${getKategoriName(item.kategori)}</p>
                            </div>
                            <span class="badge badge-sm ${getStockBadgeColor(item.stok)}">
                                ${item.stok} Tersedia
                            </span>
                        </div>
                    </div>
                </div>
            `;
            roomItemsList.appendChild(itemElement);
        });

        new bootstrap.Modal(document.getElementById('roomModal')).show();
    }

    function getKategoriName(kategori) {
        const kategoriNames = {
            elektronik: 'Elektronik',
            alat_lab: 'Alat Laboratorium',
            bahan_kimia: 'Bahan Kimia',
            perlengkapan: 'Perlengkapan'
        };
        return kategoriNames[kategori] || kategori;
    }

    function renderKatalog() {
        const katalogContainer = document.getElementById('katalog-items');
        katalogContainer.innerHTML = '';

        // Flatten all items from all rooms
        const allItems = inventarisData.ruangan.flatMap(ruangan => ruangan.items);

        allItems.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'col-md-6 mb-4';
            itemElement.innerHTML = `
                <div class="card card-blog card-plain border hover-card">
                    <div class="position-relative">
                        <div class="d-block shadow border-radius-lg">
                            <img src="${item.gambar}" alt="${item.nama}" class="img-fluid shadow border-radius-lg" style="height: 160px; width: 100%; object-fit: cover;">
                        </div>
                    </div>
                    <div class="card-body px-1 pb-0 pt-2">
                        <h6 class="text-dark mb-0">${item.nama}</h6>
                        <p class="mb-2 text-sm">Tersedia: <span class="badge badge-sm ${getStockBadgeColor(item.stok)}">${item.stok}</span></p>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-outline-primary btn-xs px-2 py-1 me-1" onclick="updateQuantity(${item.id}, -1)" ${item.stok === 0 ? 'disabled' : ''}>
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="mx-2 fw-bold qty-number">${cart[item.id] || 0}</span>
                                <button class="btn btn-outline-primary btn-xs px-2 py-1 ms-1" onclick="updateQuantity(${item.id}, 1)" ${item.stok === 0 ? 'disabled' : ''}>
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <button class="btn btn-sm ${item.stok > 0 ? 'bg-gradient-primary' : 'bg-gradient-secondary'}" 
                                onclick="addToCart(${item.id})" ${item.stok === 0 ? 'disabled' : ''}>
                                <i class="fas fa-cart-plus me-1"></i> Tambah
                            </button>
                        </div>
                    </div>
                </div>
            `;
            katalogContainer.appendChild(itemElement);
        });
    }

    function getStockBadgeColor(stok) {
        if (stok === 0) return 'bg-gradient-danger';
        if (stok < 5) return 'bg-gradient-warning';
        return 'bg-gradient-success';
    }

    function updateQuantity(itemId, change) {
        const currentQty = cart[itemId] || 0;
        const item = findItemById(itemId);
        
        if (!item) return;

        const newQty = currentQty + change;
        
        if (newQty >= 0 && newQty <= item.stok) {
            if (newQty === 0) {
                delete cart[itemId];
            } else {
                cart[itemId] = newQty;
            }
            localStorage.setItem('inventoryCart', JSON.stringify(cart));
            renderKatalog();
            updateCartDisplay();
        }
    }

    function addToCart(itemId) {
        const item = findItemById(itemId);
        if (!item || item.stok === 0) return;

        const currentQty = cart[itemId] || 0;
        if (currentQty < item.stok) {
            cart[itemId] = currentQty + 1;
            localStorage.setItem('inventoryCart', JSON.stringify(cart));
            renderKatalog();
            updateCartDisplay();
            // notification removed for "tambah barang"
        }
    }

    function findItemById(itemId) {
        for (const ruangan of inventarisData.ruangan) {
            const item = ruangan.items.find(i => i.id === itemId);
            if (item) return item;
        }
        return null;
    }

    function updateCartDisplay() {
        // elemen yang penting untuk header (bisa saja tidak ada yang lain)
        const pinjamBtn = document.getElementById('pinjam-btn');
        const pinjamCount = document.getElementById('pinjam-count');
        const cartIndicator = document.getElementById('cart-indicator');
        const clearCartBtn = document.getElementById('clear-cart-btn');
        const cartCount = document.getElementById('cart-count');

        // hitung total quantity dari cart
        let totalQty = 0;
        for (const itemId in cart) {
            totalQty += parseInt(cart[itemId]) || 0;
        }

        // update tombol Pinjam Sekarang
        if (pinjamBtn) {
            if (totalQty > 0) {
                if (pinjamCount) {
                    pinjamCount.textContent = totalQty;
                    pinjamCount.classList.remove('d-none');
                }
                pinjamBtn.disabled = false;
            } else {
                if (pinjamCount) pinjamCount.classList.add('d-none');
                pinjamBtn.disabled = true;
            }
        }

        // update indicator opsional jika ada
        if (cartCount) cartCount.textContent = totalQty;
        if (cartIndicator) cartIndicator.classList.add('d-none'); // sesuai permintaan, sembunyikan
        if (clearCartBtn) clearCartBtn.classList.add('d-none');

        // jika panel keranjang masih ada di DOM, update isinya (backwards compatible)
        const cartList = document.getElementById('cart-list');
        if (cartList) {
            cartList.innerHTML = '';
            for (const itemId in cart) {
                const item = findItemById(parseInt(itemId));
                if (!item) continue;
                const li = document.createElement('li');
                li.className = 'list-group-item border-0 px-0 pt-0';
                li.innerHTML = `
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape icon-sm bg-gradient-success shadow text-center border-radius-md me-3">
                                <i class="fas fa-box text-white opacity-10"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <h6 class="mb-0 text-sm">${item.nama}</h6>
                                <p class="text-xs text-secondary mb-0">Stok: ${item.stok}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-gradient-primary me-2">${cart[itemId]} unit</span>
                            <button class="btn btn-sm btn-outline-danger btn-xs" onclick="removeFromCart(${itemId})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                cartList.appendChild(li);
            }
            const totalItemsElement = document.getElementById('total-items');
            if (totalItemsElement) totalItemsElement.textContent = totalQty;
            const cartBadge = document.getElementById('cart-badge');
            if (cartBadge) cartBadge.textContent = `${totalQty} item`;
            const cartEmpty = document.getElementById('cart-empty');
            const cartItems = document.getElementById('cart-items');
            if (cartEmpty && cartItems) {
                if (totalQty > 0) {
                    cartEmpty.classList.add('d-none');
                    cartItems.classList.remove('d-none');
                } else {
                    cartEmpty.classList.remove('d-none');
                    cartItems.classList.add('d-none');
                }
            }
        }
    }

    function removeFromCart(itemId) {
        delete cart[itemId];
        localStorage.setItem('inventoryCart', JSON.stringify(cart));
        renderKatalog();
        updateCartDisplay();
        showNotification('Item dihapus dari keranjang', 'info');
    }

    function clearCart() {
        if (Object.keys(cart).length === 0) {
            showNotification('Keranjang sudah kosong', 'info');
            return;
        }

        if (confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
            cart = {};
            localStorage.setItem('inventoryCart', JSON.stringify(cart));
            renderKatalog();
            updateCartDisplay();
            showNotification('Keranjang berhasil dikosongkan', 'success');
        }
    }

    function goToPeminjaman() {
        if (Object.keys(cart).length === 0) {
            showNotification('Keranjang masih kosong', 'warning');
            return;
        }
        window.location.href = '/peminjaman';
    }

    function filterRuangan(kategori) {
        currentFilter = kategori;
        renderRuanganList();
        showNotification(`Filter: ${getFilterName(kategori)}`, 'info');
    }

    function getFilterName(kategori) {
        const filterNames = {
            'all': 'Semua Ruangan',
            'lab': 'Lab Komputer',
            'ipa': 'Lab IPA',
            'guru': 'Ruang Guru'
        };
        return filterNames[kategori] || kategori;
    }

    function sortKatalog(criteria) {
        showNotification(`Diurutkan berdasarkan ${getSortName(criteria)}`, 'info');
    }

    function getSortName(criteria) {
        const sortNames = {
            'name': 'Nama A-Z',
            'stock': 'Stok Terbanyak',
            'category': 'Kategori'
        };
        return sortNames[criteria] || criteria;
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

<style>
.cursor-pointer { cursor: pointer; }
.hover-card { transition: all 0.2s ease; }
.hover-card:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important; }

.icon.icon-shape {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 48px !important;
    height: 48px !important;
    padding: 0 !important;
    margin: 0 !important;
    border-radius: 50% !important;
    box-sizing: border-box !important;
}

/* Sesuaikan ukuran ikon supaya rapi di tengah */
.icon.icon-shape i {
    font-size: 18px !important;
    line-height: 1 !important;
    transform: none !important;
}
</style>

@endsection

@section('footer')
    @include('be.footer')
@endsection