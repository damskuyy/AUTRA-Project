{{--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/logo/logo-autra-nonBG.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/img/logo/logo-autra-nonBG.png')}}">
    <title>
        AUTRA - Monitoring Dashboard
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{asset('assets/css/soft-ui-dashboard.css?v=1.1.0')}}" rel="stylesheet" />
    @vite('resources/css/app.css')
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <style>
        #sidenav-main {
            position: fixed !important;
            top: 0 !important;
            bottom: auto !important;
            height: auto !important;
            max-height: none !important;
            overflow: visible !important;
            padding-bottom: 30px !important;
            z-index: 1050 !important;
        }

        #sidenav-collapse-main {
            max-height: none !important;
            overflow: visible !important;
            display: flex !important;
            flex-direction: column !important;
        }

        .navbar-nav {
            display: flex !important;
            flex-direction: column !important;
            width: 100% !important;
            overflow: visible !important;
        }

        .sidenav {
            overflow: visible !important;
        }

        .g-sidenav-show .sidenav {
            transform: translateX(0) !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .g-sidenav-pinned .sidenav {
            transform: translateX(0) !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        /* Force sidebar visible on all screen sizes */
        .sidenav {
            display: block !important;
            position: fixed !important;
            left: 0 !important;
            top: 0 !important;
            width: 280px !important;
            height: 100vh !important;
            z-index: 1050 !important;
            transform: translateX(0) !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .nav-link[data-bs-toggle="collapse"]::after {
            content: '';
            display: inline-block;
            width: 16px;
            height: 16px;
            margin-left: auto;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            transition: transform 0.3s ease;
        }

        .nav-link[data-bs-toggle="collapse"][aria-expanded="true"]::after {
            transform: rotate(180deg);
        }
    </style>
</head>

<body class="g-sidenav-show g-sidenav-pinned bg-gray-100">

    @yield('sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg"
        style="margin-left: 280px !important;">
        @yield('navbar')
        @yield('main')
        @yield('footer')
    </main>
    <!--   Core JS Files   -->
    <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
    @vite('resources/js/app.js')

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{asset('assets/js/soft-ui-dashboard.min.js?v=1.1.0')}}"></script>
</body>

</html> --}}

{{--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Automation System</title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])
</head>

<body>
    <div class="layout-root">
        @include('layout.sidebar')

        <div class="layout-main">
            @include('layout.navbar')

            <main class="layout-content">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/logo/logo-autra-nonBG.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/img/logo/logo-autra-nonBG.png')}}">
    <title>@yield('title', 'Automation System')</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    
    @stack('styles')
</head>
<body class="dashboard-page">
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

            <a href="{{ url('/control') }}" class="nav-item {{ Request::is('control') ? 'active' : '' }}">
                <i class="fa-solid fa-sliders"></i>
                <span>Control</span>
            </a>

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

    <!-- Top Bar (SEJAJAR dengan sidebar, BUKAN di dalam main) -->
    <header class="topbar">
        <div class="page-title">
            <h1>@yield('page-title', 'Dashboard')</h1>
            <p>@yield('page-subtitle', 'Real-time monitoring sensor PLC')</p>
        </div>

        <div class="topbar-right">
            @yield('topbar-actions')

            <div class="user-profile">
                <div class="user-avatar">AU</div>
                <div class="user-info">
                    <span class="user-name">Admin User</span>
                    <span class="user-role">Administrator</span>
                </div>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </div>
    </header>

    <!-- Main Content (HANYA content, TANPA navbar) -->
    <main class="main-content">
        <div class="dashboard-content">
            @yield('content')
        </div>
    </main>

    <!-- Made with Emergent Badge -->
    {{-- <div class="emergent-badge">
        <i class="fa-solid fa-circle-check"></i>
        <span>Made with Emergent</span>
    </div> --}}

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    
    @stack('scripts')
</body>
</html>