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
    
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    
    @stack('styles')
</head>
<body class="dashboard-page">
    <!-- Sidebar -->
    @yield('sidebar')

    <!-- Top Bar  -->
    {{-- <header class="topbar">
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
    </header> --}}
    @yield('navbar')

    <!-- Main Content -->
    <main class="main-content">
        <div class="dashboard-content">
            @yield('content')
        </div>
    </main>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>
    
    @stack('scripts')
</body>
</html>