<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl d-flex align-items-center justify-content-between" id="navbarBlur" navbar-scroll="true">

    <button class="navbar-toggler d-xxl-none" type="button" id="iconNavbarSidenav">
        <i class="fas fa-bars fs-5 text-dark"></i>
    </button>

    <div class="py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
              <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
            </li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
              {{ $breadcrumb ?? 'Dashboard' }}
            </li>
          </ol>
          <h6 class="font-weight-bolder mb-0">
            {{ $title ?? 'Dashboard' }}
          </h6>
        </nav>
    </div>

    <div class="ms-auto d-flex align-items-center">
        <div class="dropdown">
            <button class="btn btn-link p-0 text-decoration-none d-flex align-items-center" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="avatar avatar-sm me-2 d-flex align-items-center justify-content-center bg-primary text-white rounded-circle">
                    <i class="fas fa-user"></i>
                </div>
                <div class="d-none d-md-block text-start">
                    <span class="fw-bold text-dark">{{ Auth::user()->name ?? 'User' }}</span>
                    <br>
                    <small class="text-muted" style="font-size: 11px;">{{ Auth::user()->email ?? 'user@example.com' }}</small>
                </div>
                <i class="fas fa-chevron-down ms-2 text-dark"></i>
            </button>
            
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" aria-labelledby="profileDropdown" style="min-width: 230px; border-radius: 15px;">
                <li class="dropdown-header bg-light text-center py-4" style="border-radius: 15px 15px 0 0;">
                    <div class="avatar avatar-lg mx-auto mb-2 d-flex align-items-center justify-content-center bg-primary text-white rounded-circle shadow">
                        <i class="fas fa-user fa-2x"></i>
                    </div>
                    <h6 class="mb-0 text-dark">{{ Auth::user()->name ?? 'User' }}</h6>
                    <small class="text-muted">{{ Auth::user()->email ?? 'user@example.com' }}</small>
                </li>
                
                <li><hr class="dropdown-divider my-0"></li>
                
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('profile.index') }}">
                        <i class="fas fa-user-cog me-3 text-primary"></i>Profile Settings
                    </a>
                </li>

                <li>
                    {{-- Form Logout dengan ID khusus --}}
                    <form id="logout-form-nav" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    {{-- Tombol Logout yang memicu SweetAlert --}}
                    <button type="button" onclick="confirmLogout()" class="dropdown-item d-flex align-items-center py-2 text-danger">
                        <i class="fas fa-sign-out-alt me-3"></i>Logout
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- SCRIPT SWEETALERT UNTUK LOGOUT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Ingin Keluar?',
            text: "Sesi Anda akan diakhiri.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5e72e4', // Warna Primary Laravel
            cancelButtonColor: '#f5365c', // Warna Danger
            confirmButtonText: 'Ya, Logout!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form-nav').submit();
            }
        })
    }
</script>