<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl d-flex align-items-center justify-content-between" id="navbarBlur" navbar-scroll="true">

    <!-- TOGGLER -->
    <button class="navbar-toggler d-xl-none" type="button" id="iconNavbarSidenav">
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
    {{-- <div class="py-1 px-3 ms-auto">
        <ul class="navbar-nav d-flex align-items-center gap-2" style="flex-direction: row !important;">
            <li class="nav-item d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here..." style="width: 200px;">
                </div>
            </li>
        </ul>
    </div> --}}
    <div class="ms-auto d-flex align-items-center">
        <div class="dropdown">
            <button class="btn btn-link p-0 text-decoration-none d-flex align-items-center" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="avatar avatar-sm me-2 d-flex align-items-center justify-content-center bg-primary text-white rounded-circle">
                    <i class="fas fa-user"></i>
                </div>
                <div class="d-none d-md-block">
                    <span class="fw-bold text-dark">{{ Auth::user()->name ?? 'User' }}</span>
                    <br>
                    <small class="text-muted">{{ Auth::user()->email ?? 'user@example.com' }}</small>
                </div>
                <i class="fas fa-chevron-down ms-2 text-dark"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" aria-labelledby="profileDropdown" style="min-width: 200px;">
                <li class="dropdown-header bg-light text-center py-3">
                    <div class="avatar avatar-lg mx-auto mb-2 d-flex align-items-center justify-content-center bg-primary text-white rounded-circle">
                        <i class="fas fa-user fa-2x"></i>
                    </div>
                    <h6 class="mb-0">{{ Auth::user()->name ?? 'User' }}</h6>
                    <small class="text-muted">{{ Auth::user()->email ?? 'user@example.com' }}</small>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center w-100 border-0 bg-transparent">
                            <i class="fas fa-sign-out-alt me-3"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>