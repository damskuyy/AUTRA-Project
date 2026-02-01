@extends('layout.master')
@section('sidebar')
    @include('layout.sidebar')
@endsection
@section('navbar')
    @include('layout.navbar')
@endsection

@section('title', 'Notifikasi & Alert - Automation System')

@section('page-title', 'Notifikasi & Alert')
@section('page-subtitle')
    <span id="unreadCount">{{ $notifications->where('is_read', false)->count() }}</span> notifikasi belum dibaca
@endsection

@section('content')
    <!-- Mark All Read & Delete All Buttons -->
    <div class="notification-actions">
        <div style="display:flex; gap:12px; align-items:center;">
            <button class="btn-mark-all-read" id="markAllRead">
                <i class="fa-solid fa-check-double"></i>
                <span>Tandai Semua Dibaca</span>
            </button>

            <button class="btn-delete-all" id="btnDeleteAll">
                <i class="fa-solid fa-trash"></i>
                <span>Hapus Semua</span>
            </button>
        </div>
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
// Use event delegation, Fetch API, and SweetAlert2 for confirmation/alerts
const listContainer = document.querySelector('.notifications-list');
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function updateUnreadCount() {
    const unreadCount = document.querySelectorAll('.notification-card.unread').length;
    const counter = document.getElementById('unreadCount');
    if (counter) counter.textContent = unreadCount;
}

function showEmptyState() {
    listContainer.innerHTML = `
        <div class="empty-notifications">
            <i class="fa-solid fa-bell-slash"></i>
            <h3>Tidak ada notifikasi</h3>
            <p>Semua notifikasi akan muncul di sini</p>
        </div>
    `;
}

// Event delegation for mark-read and delete buttons
listContainer.addEventListener('click', async function (e) {
    const markBtn = e.target.closest('.btn-mark-read');
    const deleteBtn = e.target.closest('.btn-delete');

    if (markBtn) {
        e.stopPropagation();
        const id = markBtn.dataset.id;
        const card = markBtn.closest('.notification-card');

        // Send request to mark as read
        try {
            const res = await fetch(`/notifikasi/${id}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            if (!res.ok) throw new Error('Gagal menandai notifikasi.');

            // Update UI
            card.classList.remove('unread');
            card.classList.add('read');
            const badge = card.querySelector('.badge-new'); if (badge) badge.remove();
            const checkBtn = card.querySelector('.btn-mark-read'); if (checkBtn) checkBtn.remove();
            updateUnreadCount();

            Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Notifikasi ditandai sebagai dibaca', timer: 1500, showConfirmButton: false });
        } catch (err) {
            Swal.fire({ icon: 'error', title: 'Error', text: err.message || 'Terjadi kesalahan' });
        }
    }

    if (deleteBtn) {
        e.stopPropagation();
        const id = deleteBtn.dataset.id;
        const card = deleteBtn.closest('.notification-card');

        const result = await Swal.fire({
            title: 'Hapus notifikasi?',
            text: 'Anda akan menghapus notifikasi ini.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
        });

        if (result.isConfirmed) {
            try {
                const res = await fetch(`/notifikasi/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                if (!res.ok) throw new Error('Gagal menghapus notifikasi.');

                const wasUnread = card.classList.contains('unread');
                card.style.animation = 'fadeOut 0.3s ease-out';
                setTimeout(() => card.remove(), 300);
                if (wasUnread) updateUnreadCount();

                const remaining = document.querySelectorAll('.notification-card');
                if (remaining.length === 0) showEmptyState();

                Swal.fire({ icon: 'success', title: 'Dihapus', text: 'Notifikasi berhasil dihapus', timer: 1400, showConfirmButton: false });
            } catch (err) {
                Swal.fire({ icon: 'error', title: 'Error', text: err.message || 'Terjadi kesalahan' });
            }
        }
    }
});

// Mark all read handler
const markAllBtn = document.getElementById('markAllRead');
if (markAllBtn) {
    markAllBtn.addEventListener('click', async function () {
        const unreadCount = document.querySelectorAll('.notification-card.unread').length;
        if (unreadCount === 0) {
            Swal.fire({ icon: 'info', title: 'Info', text: 'Semua notifikasi sudah dibaca', timer: 1200, showConfirmButton: false });
            return;
        }

        const result = await Swal.fire({
            title: 'Tandai semua sebagai dibaca?',
            text: `Tandai ${unreadCount} notifikasi sebagai dibaca?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, tandai',
            cancelButtonText: 'Batal',
        });

        if (!result.isConfirmed) return;

        try {
            const res = await fetch(`/notifikasi/read-all`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            if (!res.ok) throw new Error('Gagal menandai semua notifikasi.');

            // Update UI: remove badges, remove buttons, set read
            document.querySelectorAll('.notification-card.unread').forEach(card => {
                card.classList.remove('unread');
                card.classList.add('read');
                const badge = card.querySelector('.badge-new'); if (badge) badge.remove();
                const checkBtn = card.querySelector('.btn-mark-read'); if (checkBtn) checkBtn.remove();
            });
            updateUnreadCount();

            Swal.fire({ icon: 'success', title: 'Selesai', text: 'Semua notifikasi telah ditandai sebagai dibaca', timer: 1400, showConfirmButton: false });
        } catch (err) {
            Swal.fire({ icon: 'error', title: 'Error', text: err.message || 'Terjadi kesalahan' });
        }
    });
}

// Delete all handler
const btnDeleteAll = document.getElementById('btnDeleteAll');
if (btnDeleteAll) {
    btnDeleteAll.addEventListener('click', async function () {
        const total = document.querySelectorAll('.notification-card').length;
        if (total === 0) {
            Swal.fire({ icon: 'info', title: 'Info', text: 'Tidak ada notifikasi untuk dihapus', timer: 1200, showConfirmButton: false });
            return;
        }

        const result = await Swal.fire({
            title: 'Hapus semua notifikasi?',
            html: `<p>Anda akan menghapus <strong style="color:#ef4444">${total}</strong> notifikasi.</p><p style="font-size:13px;color:#6b7280">Tindakan ini tidak dapat dikembalikan.</p>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus semua',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#ef4444',
            reverseButtons: true
        });

        if (!result.isConfirmed) return;

        try {
            const res = await fetch(`/notifikasi`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            if (!res.ok) throw new Error('Gagal menghapus semua notifikasi.');

            // Clear UI
            showEmptyState();
            updateUnreadCount();

            Swal.fire({ icon: 'success', title: 'Dihapus', text: 'Semua notifikasi berhasil dihapus', timer: 1400, showConfirmButton: false });
        } catch (err) {
            Swal.fire({ icon: 'error', title: 'Error', text: err.message || 'Terjadi kesalahan' });
        }
    });
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOut {
        from { opacity: 1; transform: translateX(0); }
        to { opacity: 0; transform: translateX(100px); }
    }
`;
document.head.appendChild(style);
</script>
@endpush