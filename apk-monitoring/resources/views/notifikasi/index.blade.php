@extends('layout.master')

@section('title', 'Notifikasi & Alert - Automation System')

@section('page-title', 'Notifikasi & Alert')
@section('page-subtitle')
    <span id="unreadCount">{{ $notifications->where('is_read', false)->count() }}</span> notifikasi belum dibaca
@endsection

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
// Mark single notification as read
document.querySelectorAll('.btn-mark-read').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const notifId = this.dataset.id;
        const card = this.closest('.notification-card');
        
        // Simulate API call
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
            unreadCards.forEach(card => {
                const notifId = card.dataset.id;
                markAsRead(notifId, card);
            });
            
            showNotification('Semua notifikasi ditandai sebagai dibaca', 'success');
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
    // In production, you would make an AJAX call here
    // For now, we'll just update the UI
    
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
}

// Function to delete notification
function deleteNotification(notifId, card) {
    // In production, you would make an AJAX call here
    
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
}

// Update unread counter
function updateUnreadCount() {
    const unreadCount = document.querySelectorAll('.notification-card.unread').length;
    const counter = document.getElementById('unreadCount');
    
    if (counter) {
        counter.textContent = unreadCount;
    }
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