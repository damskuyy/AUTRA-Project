{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - Automation Monitoring System</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-industry"></i>
            </div>
            <h2>Automation Monitoring</h2>
        </div>
        <nav class="sidebar-menu">
            <a href="dashboard.html" class="menu-item">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="control.html" class="menu-item">
                <i class="fas fa-sliders-h"></i>
                <span>Control</span>
            </a>
            <a href="laporan.html" class="menu-item">
                <i class="fas fa-file-alt"></i>
                <span>Laporan</span>
            </a>
            <a href="notifikasi.html" class="menu-item active">
                <i class="fas fa-bell"></i>
                <span>Notifikasi</span>
            </a>
            <a href="manage-user.html" class="menu-item">
                <i class="fas fa-users-cog"></i>
                <span>Manage User</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="navbar-left">
                <h1>Notifikasi & Alert</h1>
            </div>
            <div class="navbar-right">
                <div class="user-profile">
                    <div class="avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info">
                        <span class="user-name">Admin User</span>
                        <span class="user-role">Administrator</span>
                    </div>
                    <div class="dropdown">
                        <button class="dropdown-toggle">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-user-circle"></i> Profile
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <hr>
                            <a href="#" class="dropdown-item logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Notification Content -->
        <div class="content">
            <div class="page-header">
                <h2>Sistem Notifikasi</h2>
                <p>Peringatan dan informasi dari sistem monitoring</p>
            </div>

            <!-- Notification Stats -->
            <div class="notification-stats">
                <div class="stat-card">
                    <i class="fas fa-exclamation-circle text-danger"></i>
                    <div class="stat-info">
                        <span class="stat-number">3</span>
                        <span class="stat-label">Critical</span>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-exclamation-triangle text-warning"></i>
                    <div class="stat-info">
                        <span class="stat-number">5</span>
                        <span class="stat-label">Warning</span>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-info-circle text-info"></i>
                    <div class="stat-info">
                        <span class="stat-number">12</span>
                        <span class="stat-label">Info</span>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-check-circle text-success"></i>
                    <div class="stat-info">
                        <span class="stat-number">45</span>
                        <span class="stat-label">Resolved</span>
                    </div>
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="notification-tabs">
                <button class="tab-btn active" data-filter="all">
                    <i class="fas fa-list"></i> Semua
                </button>
                <button class="tab-btn" data-filter="critical">
                    <i class="fas fa-exclamation-circle"></i> Critical
                </button>
                <button class="tab-btn" data-filter="warning">
                    <i class="fas fa-exclamation-triangle"></i> Warning
                </button>
                <button class="tab-btn" data-filter="info">
                    <i class="fas fa-info-circle"></i> Info
                </button>
            </div>

            <!-- Notification List -->
            <div class="notification-list">
                <!-- Critical Notification -->
                <div class="notification-card critical">
                    <div class="notification-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-header">
                            <h3>Suhu Melebihi Batas Maksimum</h3>
                            <span class="notification-time">
                                <i class="fas fa-clock"></i> 5 menit yang lalu
                            </span>
                        </div>
                        <p>Sensor suhu mencatat 35.2°C, melebihi ambang batas maksimum 35°C. Segera lakukan pengecekan sistem pendingin.</p>
                        <div class="notification-footer">
                            <span class="notification-badge critical">Critical</span>
                            <div class="notification-actions">
                                <button class="btn-action">
                                    <i class="fas fa-check"></i> Tandai Selesai
                                </button>
                                <button class="btn-action">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Warning Notification -->
                <div class="notification-card warning">
                    <div class="notification-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-header">
                            <h3>Kelembapan Tinggi Terdeteksi</h3>
                            <span class="notification-time">
                                <i class="fas fa-clock"></i> 15 menit yang lalu
                            </span>
                        </div>
                        <p>Kelembapan mencapai 75%, mendekati batas warning 80%. Pertimbangkan untuk mengaktifkan dehumidifier.</p>
                        <div class="notification-footer">
                            <span class="notification-badge warning">Warning</span>
                            <div class="notification-actions">
                                <button class="btn-action">
                                    <i class="fas fa-check"></i> Tandai Selesai
                                </button>
                                <button class="btn-action">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Notification -->
                <div class="notification-card info">
                    <div class="notification-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-header">
                            <h3>Sistem Backup Berhasil</h3>
                            <span class="notification-time">
                                <i class="fas fa-clock"></i> 1 jam yang lalu
                            </span>
                        </div>
                        <p>Backup data sensor harian telah selesai dilakukan. Total 2,456 data points tersimpan dengan sukses.</p>
                        <div class="notification-footer">
                            <span class="notification-badge info">Info</span>
                            <div class="notification-actions">
                                <button class="btn-action">
                                    <i class="fas fa-check"></i> Tandai Selesai
                                </button>
                                <button class="btn-action">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Warning Notification -->
                <div class="notification-card warning">
                    <div class="notification-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-header">
                            <h3>Intensitas Cahaya Rendah</h3>
                            <span class="notification-time">
                                <i class="fas fa-clock"></i> 2 jam yang lalu
                            </span>
                        </div>
                        <p>Sensor cahaya mencatat 380 Lux, di bawah standar operasional 400 Lux. Periksa kondisi pencahayaan area.</p>
                        <div class="notification-footer">
                            <span class="notification-badge warning">Warning</span>
                            <div class="notification-actions">
                                <button class="btn-action">
                                    <i class="fas fa-check"></i> Tandai Selesai
                                </button>
                                <button class="btn-action">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Critical Notification -->
                <div class="notification-card critical">
                    <div class="notification-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-header">
                            <h3>Koneksi PLC Terputus</h3>
                            <span class="notification-time">
                                <i class="fas fa-clock"></i> 3 jam yang lalu
                            </span>
                        </div>
                        <p>Koneksi ke PLC terputus selama 2 menit. Koneksi telah pulih kembali secara otomatis.</p>
                        <div class="notification-footer">
                            <span class="notification-badge critical">Critical</span>
                            <div class="notification-actions">
                                <button class="btn-action">
                                    <i class="fas fa-check"></i> Tandai Selesai
                                </button>
                                <button class="btn-action">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Notification -->
                <div class="notification-card info">
                    <div class="notification-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-header">
                            <h3>Update Sistem Tersedia</h3>
                            <span class="notification-time">
                                <i class="fas fa-clock"></i> 1 hari yang lalu
                            </span>
                        </div>
                        <p>Versi 2.5.1 telah tersedia. Update ini mencakup perbaikan bug dan peningkatan performa sistem monitoring.</p>
                        <div class="notification-footer">
                            <span class="notification-badge info">Info</span>
                            <div class="notification-actions">
                                <button class="btn-action">
                                    <i class="fas fa-download"></i> Update
                                </button>
                                <button class="btn-action">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; 2024 Automation Monitoring System. All rights reserved.</p>
        </footer>
    </div>

    <script src="script.js"></script>
</body>
</html> --}}

@extends('layout.master')

@section('title', 'Notifikasi & Alert - Automation System')

@section('page-title', 'Notifikasi & Alert')
@section('page-subtitle')
    <span id="unreadCount">{{ $notifications->where('is_read', false)->count() }}</span> notifikasi belum dibaca
@endsection

@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/notifikasi.css') }}"> --}}
@endpush

@section('content')
    <!-- Mark All Read Button -->
    <div class="notification-actions">
        <button class="btn-mark-all-read" id="markAllRead">
            <i class="fa-solid fa-check-double"></i>
            <span>Tandai Semua Dibaca</span>
        </button>
    </div>

    <!-- Notifications List -->
    <div class="notifications-list">
        @forelse($notifications as $notification)
        <div class="notification-card {{ $notification->is_read ? 'read' : 'unread' }}" data-id="{{ $notification->id }}">
            <!-- Icon based on type -->
            <div class="notification-icon icon-{{ $notification->type }}">
                @if($notification->type == 'warning')
                    <i class="fa-solid fa-triangle-exclamation"></i>
                @elseif($notification->type == 'danger')
                    <i class="fa-solid fa-circle-exclamation"></i>
                @elseif($notification->type == 'info')
                    <i class="fa-solid fa-circle-info"></i>
                @else
                    <i class="fa-solid fa-bell"></i>
                @endif
            </div>

            <!-- Content -->
            <div class="notification-content">
                <div class="notification-header">
                    <h3 class="notification-title">{{ $notification->title }}</h3>
                    @if(!$notification->is_read)
                        <span class="badge-new">Baru</span>
                    @endif
                </div>
                <p class="notification-message">{{ $notification->message }}</p>
                <span class="notification-time">{{ $notification->created_at }}</span>
            </div>

            <!-- Actions -->
            <div class="notification-actions-icons">
                @if(!$notification->is_read)
                    <button class="btn-icon btn-mark-read" data-id="{{ $notification->id }}" title="Tandai telah dibaca">
                        <i class="fa-solid fa-check"></i>
                    </button>
                @endif
                <button class="btn-icon btn-delete" data-id="{{ $notification->id }}" title="Hapus notifikasi">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>
        @empty
        <div class="empty-notifications">
            <i class="fa-solid fa-bell-slash"></i>
            <h3>Tidak ada notifikasi</h3>
            <p>Semua notifikasi akan muncul di sini</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($notifications->hasPages())
    <div class="pagination-container">
        <div class="pagination-info">
            Menampilkan {{ $notifications->firstItem() }} - {{ $notifications->lastItem() }} dari {{ $notifications->total() }} notifikasi
        </div>
        
        <div class="pagination-links">
            {{ $notifications->links() }}
        </div>
    </div>
    @endif
@endsection

@push('scripts')
<script>
// Get CSRF token
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Mark single notification as read
document.querySelectorAll('.btn-mark-read').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const notifId = this.dataset.id;
        const card = this.closest('.notification-card');
        
        markAsRead(notifId, card);
    });
});

// Mark all notifications as read
const markAllBtn = document.getElementById('markAllRead');
if (markAllBtn) {
    markAllBtn.addEventListener('click', function() {
        const unreadCards = document.querySelectorAll('.notification-card.unread');
        
        if (unreadCards.length === 0) {
            showNotification('Semua notifikasi sudah dibaca', 'info');
            return;
        }
        
        const confirmed = confirm(`Tandai ${unreadCards.length} notifikasi sebagai sudah dibaca?`);
        
        if (confirmed) {
            markAllAsRead();
        }
    });
}

// Delete notification
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const notifId = this.dataset.id;
        const card = this.closest('.notification-card');
        
        const confirmed = confirm('Apakah Anda yakin ingin menghapus notifikasi ini?');
        
        if (confirmed) {
            deleteNotification(notifId, card);
        }
    });
});

// Function to mark as read
function markAsRead(notifId, card) {
    fetch(`/notifikasi/${notifId}/read`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove unread class
            card.classList.remove('unread');
            card.classList.add('read');
            
            // Remove "Baru" badge
            const badge = card.querySelector('.badge-new');
            if (badge) {
                badge.remove();
            }
            
            // Remove check button
            const checkBtn = card.querySelector('.btn-mark-read');
            if (checkBtn) {
                checkBtn.remove();
            }
            
            // Update counter
            updateUnreadCount();
            
            // Add animation
            card.style.animation = 'markRead 0.5s ease-out';
            setTimeout(() => {
                card.style.animation = '';
            }, 500);
        } else {
            showNotification('Gagal menandai notifikasi sebagai dibaca', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat memproses notifikasi', 'error');
    });
}

// Function to mark all as read
function markAllAsRead() {
    fetch('/notifikasi/mark-all-read', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update all unread cards
            const unreadCards = document.querySelectorAll('.notification-card.unread');
            unreadCards.forEach(card => {
                card.classList.remove('unread');
                card.classList.add('read');
                
                const badge = card.querySelector('.badge-new');
                if (badge) badge.remove();
                
                const checkBtn = card.querySelector('.btn-mark-read');
                if (checkBtn) checkBtn.remove();
                
                card.style.animation = 'markRead 0.5s ease-out';
                setTimeout(() => {
                    card.style.animation = '';
                }, 500);
            });
            
            updateUnreadCount();
            showNotification('Semua notifikasi ditandai sebagai dibaca', 'success');
        } else {
            showNotification('Gagal menandai semua notifikasi sebagai dibaca', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat memproses notifikasi', 'error');
    });
}

// Function to delete notification
function deleteNotification(notifId, card) {
    fetch(`/notifikasi/${notifId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Add fade out animation
            card.style.animation = 'fadeOut 0.3s ease-out';
            
            setTimeout(() => {
                const wasUnread = card.classList.contains('unread');
                card.remove();
                
                if (wasUnread) {
                    updateUnreadCount();
                }
                
                // Check if list is empty
                const remainingCards = document.querySelectorAll('.notification-card');
                if (remainingCards.length === 0) {
                    showEmptyState();
                }
                
                showNotification('Notifikasi berhasil dihapus', 'success');
            }, 300);
        } else {
            showNotification('Gagal menghapus notifikasi', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat menghapus notifikasi', 'error');
    });
}

// Update unread counter
function updateUnreadCount() {
    const unreadCount = document.querySelectorAll('.notification-card.unread').length;
    const counter = document.getElementById('unreadCount');
    
    if (counter) {
        counter.textContent = unreadCount;
    }
}

// Show notification message
function showNotification(message, type) {
    // Simple notification - you can replace with a proper toast library
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'error' ? 'danger' : type}`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        padding: 15px;
        border-radius: 5px;
        color: white;
        background-color: ${type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : '#17a2b8'};
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        max-width: 300px;
    `;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Show empty state
function showEmptyState() {
    const listContainer = document.querySelector('.notifications-list');
    listContainer.innerHTML = `
        <div class="empty-notifications">
            <i class="fa-solid fa-bell-slash"></i>
            <h3>Tidak ada notifikasi</h3>
            <p>Semua notifikasi akan muncul di sini</p>
        </div>
    `;
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(100px);
        }
    }
    
    @keyframes markRead {
        0% { transform: scale(1); }
        50% { transform: scale(0.98); }
        100% { transform: scale(1); }
    }
`;
document.head.appendChild(style);
</script>
@endpush