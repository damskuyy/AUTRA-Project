    <!-- Sidebar -->
    <aside class="sidebar">
        <!-- Logo & Brand -->
        <div class="sidebar-header">
            <div class="logo-icon">
                {{-- <i class="fa-solid fa-sliders"></i> --}}
                <img src="{{ asset('assets/img/logo/logo-autra-nonBG.png') }}" alt="Logo" style="height: 40px; width: 40px;">
            </div>
            <div class="brand-text">
                <h2>AUTRA</h2>
                <p>Monitoring System</p>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="sidebar-nav">
            <a href="{{ url('/dashboard') }}" class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Dashboard</span>
            </a>

            <!-- <a href="{{ url('/control') }}" class="nav-item {{ Request::is('control') ? 'active' : '' }}">
                <i class="fa-solid fa-sliders"></i>
                <span>Control</span>
            </a> -->

            <a href="{{ url('/laporan') }}" class="nav-item {{ Request::is('laporan') ? 'active' : '' }}">
                <i class="fa-solid fa-file-lines"></i>
                <span>Laporan</span>
            </a>

            <a href="{{ url('/notifikasi') }}" class="nav-item {{ Request::is('notifikasi') ? 'active' : '' }}">
                <i class="fa-solid fa-bell"></i>
                <span>Notifikasi</span>
            </a>

            <a href="{{ url('/manage-user') }}" class="nav-item {{ Request::is('manage-user') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i>
                <span>Manage User</span>
            </a>
        </nav>

        <!-- Footer Copyright -->
        <div class="sidebar-footer">
            <p>© 2025 AUTRA Monitoring System</p>
        </div>
    </aside>