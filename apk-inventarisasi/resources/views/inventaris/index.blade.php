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
                            <span class="badge bg-gradient-primary me-2 cart-indicator d-none">
                                <i class="fas fa-shopping-cart me-1"></i>
                                <span id="cart-count">0</span> items
                            </span>
                            <button class="btn btn-sm btn-outline-primary me-2" onclick="clearCart()">
                                <i class="fas fa-trash me-1"></i> Kosongkan Keranjang
                            </button>
                            <button class="btn btn-sm btn-primary" onclick="goToPeminjaman()">
                                <i class="fas fa-clipboard-check me-1"></i> Pinjam Sekarang
                            </button>
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
                            <h6>Daftar Inventaris Ruangan</h6>
                            <p class="text-sm mb-0">Stok real-time per ruangan</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-filter me-1"></i> Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="filterRuangan('all')">Semua Ruangan</a></li>
                                <li><a class="dropdown-item" href="#" onclick="filterRuangan('lab')">Lab Komputer</a></li>
                                <li><a class="dropdown-item" href="#" onclick="filterRuangan('ipa')">Lab IPA</a></li>
                                <li><a class="dropdown-item" href="#" onclick="filterRuangan('guru')">Ruang Guru</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="list-group" id="ruangan-list">
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
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-sort me-1"></i> Urutkan
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="sortKatalog('name')">Nama A-Z</a></li>
                                <li><a class="dropdown-item" href="#" onclick="sortKatalog('stock')">Stok Terbanyak</a></li>
                                <li><a class="dropdown-item" href="#" onclick="sortKatalog('category')">Kategori</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row" id="katalog-items">
                        <!-- Katalog items will be populated by JavaScript -->
                    </div>
                    
                    <!-- Keranjang -->
                    <div class="card mt-4">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Keranjang Peminjaman</h6>
                                <span class="badge bg-gradient-primary" id="cart-badge">0 item</span>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div id="cart-empty" class="text-center py-4">
                                <i class="fas fa-shopping-cart text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-2 mb-0">Keranjang masih kosong</p>
                                <p class="text-sm text-muted">Pilih barang dari katalog di atas</p>
                            </div>
                            <div id="cart-items" class="d-none">
                                <ul class="list-group list-group-flush" id="cart-list">
                                    <!-- Cart items will be populated by JavaScript -->
                                </ul>
                                <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                    <div>
                                        <span class="text-sm">Total Item: <span class="fw-bold" id="total-items">0</span></span>
                                    </div>
                                    <button class="btn btn-sm bg-gradient-success mb-0" onclick="goToPeminjaman()">
                                        <i class="fas fa-clipboard-check me-1"></i> Pinjam Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Data dummy inventaris
    const inventarisData = {
        ruangan: [
            {
                id: 1,
                nama: "Lab Komputer 1",
                kategori: "lab",
                items: [
                    { id: 1, nama: "Laptop", stok: 15, kategori: "elektronik", gambar: "https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" },
                    { id: 2, nama: "Keyboard", stok: 20, kategori: "elektronik", gambar: "https://images.unsplash.com/photo-1541140532154-b024d705b90a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" }
                ]
            },
            {
                id: 2,
                nama: "Ruang Guru",
                kategori: "guru",
                items: [
                    { id: 3, nama: "Proyektor", stok: 0, kategori: "elektronik", gambar: "https://images.unsplash.com/photo-1586953208448-b95a79798f07?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" },
                    { id: 4, nama: "Papan Tulis", stok: 3, kategori: "perlengkapan", gambar: "https://images.unsplash.com/photo-1516834474-48c0abc2a902?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" }
                ]
            },
            {
                id: 3,
                nama: "Lab IPA",
                kategori: "ipa",
                items: [
                    { id: 5, nama: "Tabung Reaksi", stok: 5, kategori: "bahan_kimia", gambar: "https://images.unsplash.com/photo-1536935338788-846bb9981813?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" },
                    { id: 6, nama: "Beker Gelas", stok: 25, kategori: "alat_lab", gambar: "https://images.unsplash.com/photo-1586773860418-d37222d8fce3?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" }
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
    });

    function renderRuanganList() {
        const ruanganList = document.getElementById('ruangan-list');
        ruanganList.innerHTML = '';

        const filteredRuangan = inventarisData.ruangan.filter(ruangan => {
            if (currentFilter === 'all') return true;
            return ruangan.kategori === currentFilter;
        });

        filteredRuangan.forEach(ruangan => {
            const ruanganElement = document.createElement('div');
            ruanganElement.className = 'list-group-item border-0 px-0 mb-3 pt-0';
            ruanganElement.innerHTML = `
                <div class="d-flex align-items-start">
                    <div class="icon icon-shape icon-sm bg-gradient-primary shadow text-center border-radius-md me-3">
                        <i class="fas fa-door-closed text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column w-100">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h6 class="mb-0 text-dark">${ruangan.nama}</h6>
                            <span class="badge badge-sm bg-gradient-primary">${ruangan.items.length} Barang</span>
                        </div>
                        <div class="d-flex flex-column w-100">
                            ${ruangan.items.map(item => `
                                <div class="d-flex justify-content-between align-items-center py-1 border-bottom">
                                    <div class="d-flex align-items-center">
                                        <i class="fas ${getItemIcon(item.kategori)} ${getStockColor(item.stok)} me-2"></i>
                                        <span class="text-sm">${item.nama}</span>
                                    </div>
                                    <span class="badge badge-sm ${getStockBadgeColor(item.stok)}">Tersedia: ${item.stok}</span>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                </div>
            `;
            ruanganList.appendChild(ruanganElement);
        });
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
                                <span class="mx-2 fw-bold">${cart[item.id] || 0}</span>
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

    function getItemIcon(kategori) {
        const icons = {
            elektronik: 'fa-laptop',
            alat_lab: 'fa-microscope',
            bahan_kimia: 'fa-vial',
            perlengkapan: 'fa-chair'
        };
        return icons[kategori] || 'fa-box';
    }

    function getStockColor(stok) {
        if (stok === 0) return 'text-danger';
        if (stok < 5) return 'text-warning';
        return 'text-success';
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
            showNotification(`${item.nama} ditambahkan ke keranjang`, 'success');
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
        const cartEmpty = document.getElementById('cart-empty');
        const cartItems = document.getElementById('cart-items');
        const cartList = document.getElementById('cart-list');
        const totalItemsElement = document.getElementById('total-items');
        const cartBadge = document.getElementById('cart-badge');
        const cartCount = document.getElementById('cart-count');
        const cartIndicator = document.querySelector('.cart-indicator');

        cartList.innerHTML = '';

        let totalItems = 0;
        let totalQty = 0;

        for (const itemId in cart) {
            const item = findItemById(parseInt(itemId));
            if (item) {
                totalItems++;
                totalQty += cart[itemId];
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
        }

        totalItemsElement.textContent = totalQty;
        cartBadge.textContent = `${totalQty} item`;
        cartCount.textContent = totalQty;

        if (totalQty > 0) {
            cartEmpty.classList.add('d-none');
            cartItems.classList.remove('d-none');
            cartIndicator.classList.remove('d-none');
        } else {
            cartEmpty.classList.remove('d-none');
            cartItems.classList.add('d-none');
            cartIndicator.classList.add('d-none');
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
    }

    function sortKatalog(criteria) {
        // Implementation for sorting
        showNotification(`Diurutkan berdasarkan ${criteria}`, 'info');
    }

    function showNotification(message, type) {
        // Simple notification implementation
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