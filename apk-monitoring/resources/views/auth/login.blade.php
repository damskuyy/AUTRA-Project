<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/logo/logo-autra-nonBG.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/img/logo/logo-autra-nonBG.png')}}">
    <title>Login - AUTRA Monitoring</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body class="login-page">
    <div class="login-wrapper">
        <div class="login-container">
            <!-- Logo -->
            <div class="logo-section">
                <div class="logo-icon">
                    {{-- <i class="fa-solid fa-sliders"></i> --}}
                    <img src="{{ asset('assets/img/logo/logo-autra-nonBG.png') }}" alt="Logo" style="height: 60px; width: 60px;">  
                </div>
            </div>

            <!-- Title -->
            <h1 class="main-title">AUTRA</h1>
            <p class="subtitle">Monitoring Control System</p>

            <!-- Login Form -->
            <form id="loginForm" class="login-form">
                @csrf
                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-container">
                        <i class="fa-solid fa-user input-icon"></i>
                        <input type="text" id="username" name="username" placeholder="Masukkan username" autocomplete="username">
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-container">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" id="password" name="password" placeholder="Masukkan password" autocomplete="current-password">
                    </div>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn-login">Login</button>

                <!-- Demo Text -->
                <p class="demo-info">Demo: username & password apapun</p>
            </form>

            <!-- Footer -->
            <div class="footer">
                <p>© 2025 AUTRA Monitoring System. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>