<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AUTRA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at 10% 20%, #ffb84d 0%, transparent 20%), 
                        radial-gradient(circle at 90% 80%, #4b2b10 0%, transparent 25%), 
                        linear-gradient(135deg, #f6ad2d 0%, #4a2b12 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
        }

        .card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 40px 30px;
            box-shadow: 0 25px 65px rgba(0, 0, 0, 0.6);
        }

        .avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #ffc857, #ffb84d);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            box-shadow: 0 8px 20px rgba(255, 184, 77, 0.35);
        }

        .avatar svg {
            width: 40px;
            height: 40px;
            fill: white;
        }

        .alert {
            margin-bottom: 20px;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.2);
            border: 1px solid rgba(34, 197, 94, 0.4);
            color: #bbf7d0;
        }

        .alert-error {
            background: rgba(220, 38, 38, 0.2);
            border: 1px solid rgba(220, 38, 38, 0.4);
            color: #fecaca;
        }

        .alert ul {
            list-style: disc inside;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .input-group {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: box-shadow 0.3s ease;
        }

        .input-group:focus-within {
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
        }

        .input-icon {
            width: 50px;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.05));
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .input-icon svg {
            width: 20px;
            height: 20px;
            stroke: #d97706;
        }

        .login-input {
            flex: 1;
            padding: 12px 16px;
            border: none;
            background: transparent;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            color: #333;
            outline: none;
        }

        .login-input::placeholder {
            color: #aaa;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            font-size: 13px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #fff5e6;
            cursor: pointer;
        }

        .remember-me input {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #ffc857;
        }

        .forgot-password {
            color: #fff5e6;
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-password:hover {
            color: #fff;
        }

        .btn-submit {
            width: 100%;
            padding: 12px 0;
            background: linear-gradient(180deg, #663d1e 0%, #3d2110 100%);
            color: white;
            font-weight: 600;
            font-size: 15px;
            font-family: 'Poppins', sans-serif;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 8px 22px rgba(61, 33, 16, 0.4), inset 0 -2px 0 rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .btn-submit:hover {
            background: linear-gradient(180deg, #794a24 0%, #4a2713 100%);
            transform: translateY(-1px);
            box-shadow: 0 10px 28px rgba(61, 33, 16, 0.5), inset 0 -2px 0 rgba(0, 0, 0, 0.15);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .footer-text {
            text-align: center;
            margin-top: 25px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
        }

        @media (max-width: 640px) {
            .card {
                padding: 30px 20px;
            }

            .avatar {
                width: 64px;
                height: 64px;
                margin-bottom: 20px;
            }

            .avatar svg {
                width: 32px;
                height: 32px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card">
            <!-- Avatar -->
            <div class="avatar">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>

            <!-- Status Messages -->
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ url('/login') }}">
                @csrf

                <!-- Email Field -->
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input 
                            type="email" 
                            name="email" 
                            class="login-input" 
                            placeholder="Email" 
                            value="{{ old('email') }}"
                            required
                        />
                    </div>
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            class="login-input" 
                            placeholder="Password" 
                            required
                        />
                    </div>
                </div>

                <!-- Remember & Forgot -->
                <div class="checkbox-group">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" />
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit">Login</button>
            </form>

            <!-- Footer -->
            <p class="footer-text">Tampilan login responsif untuk desktop & mobile</p>
        </div>
    </div>
</body>
</html>

