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
    <div class="py-1 px-3 ms-auto">
        <ul class="navbar-nav d-flex align-items-center gap-2" style="flex-direction: row !important;">
            <li class="nav-item d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here..." style="width: 200px;">
                </div>
            </li>
        </ul>
    </div>
</nav>