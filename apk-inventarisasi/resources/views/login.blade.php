<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('be/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('be/img/favicon.png')}}">
    <title>Login - AUTRA Inventaris</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    
    <!-- Soft UI Dashboard CSS -->
    <link id="pagestyle" href="{{asset('be/css/soft-ui-dashboard.css?v=1.1.0')}}" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-auto">
                            <div class="card shadow-lg mt-3">
                                <div class="card-header pb-0 text-center bg-transparent">
                                    <h4 class="font-weight-bolder mb-1">Login</h4>
                                    <p class="mb-0 text-sm">Masukkan email dan password Anda</p>
                                </div>
                                
                                <div class="card-body pt-0">
                                    <!-- Status Messages -->
                                    @if(session('status'))
                                        <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
                                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                            <span class="alert-text">{{ session('status') }}</span>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    @if($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                                            <span class="alert-icon"><i class="fas fa-times"></i></span>
                                            <span class="alert-text">
                                                <ul class="mb-0 ps-3">
                                                    @foreach($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </span>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <!-- Login Form -->
                                    <form method="POST" action="{{ url('/login') }}" role="form">
                                        @csrf
                                        
                                        <!-- Email Field -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                                <input 
                                                    type="email" 
                                                    class="form-control" 
                                                    id="email"
                                                    name="email" 
                                                    placeholder="Email" 
                                                    value="{{ old('email') }}"
                                                    required
                                                />
                                            </div>
                                        </div>

                                        <!-- Password Field -->
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                                <input 
                                                    type="password" 
                                                    class="form-control" 
                                                    id="password"
                                                    name="password" 
                                                    placeholder="Password" 
                                                    required
                                                />
                                            </div>
                                        </div>

                                        <!-- Remember & Forgot -->
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                                                <label class="form-check-label" for="rememberMe">Ingat Saya</label>
                                            </div>
                                            <a href="#" class="text-primary text-gradient font-weight-bold text-xs">Lupa Password?</a>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-primary w-100 mt-2 mb-0">
                                                <i class="fas fa-sign-in-alt me-2"></i>Login
                                            </button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Core JS -->
    <script src="{{asset('be/js/core/popper.min.js')}}"></script>
    <script src="{{asset('be/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('be/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('be/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script src="{{asset('be/js/soft-ui-dashboard.min.js?v=1.1.0')}}"></script>
</body>
</html>