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
    
    <!-- Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    
    {{-- <style>
        body.login-page {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-wrapper {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px 30px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .logo-icon img {
            height: 50px;
            width: 50px;
        }

        .main-title {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .subtitle {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }

        .login-form {
            margin-top: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .input-container {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            z-index: 1;
        }

        .input-container input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .input-container input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-login:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            font-size: 12px;
            color: #999;
        }

        .login-alert {
            margin-bottom: 20px;
            border-radius: 8px;
            animation: slideDown 0.3s ease;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }

            .main-title {
                font-size: 28px;
            }
        }
    </style> --}}
</head>
<body class="login-page">
    <div class="login-wrapper">
        <div class="login-container">
            <!-- Logo -->
            <div class="logo-section">
                <div class="logo-icon">
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
                    <div class="input-container input-password-group">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" id="password" name="password" placeholder="Masukkan password" autocomplete="current-password">
                        <button type="button" class="btn-toggle-password" id="togglePassword" aria-label="Tampilkan password" aria-pressed="false">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn-login">Login</button>
            </form>

            <!-- Footer -->
            <div class="footer">
                <p>© 2025 AUTRA Monitoring System. All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('togglePassword');
            const pwd = document.getElementById('password');
            if (!toggle || !pwd) return;

            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                const isPassword = pwd.getAttribute('type') === 'password';
                pwd.setAttribute('type', isPassword ? 'text' : 'password');

                const icon = toggle.querySelector('i');
                if (isPassword) {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                    toggle.setAttribute('aria-label', 'Sembunyikan password');
                    toggle.setAttribute('aria-pressed', 'true');
                } else {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                    toggle.setAttribute('aria-label', 'Tampilkan password');
                    toggle.setAttribute('aria-pressed', 'false');
                }
            });

            // Prevent the button from blurring the input when held
            toggle.addEventListener('mousedown', function (e) {
                e.preventDefault();
            });
        });
    </script>

    <style>
        /* Small styles for password toggle on login page */
        .input-password-group { position: relative; }
        .btn-toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 6px;
            font-size: 14px;
        }
        .btn-toggle-password:focus { outline: none; }
    </style>
</body>
</html>