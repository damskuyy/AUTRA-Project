<!-- Top Bar  -->
<header class="topbar">
    <!-- Hamburger Menu for Mobile -->
    <button class="hamburger-menu" aria-label="Toggle Menu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <div class="page-title">
        <h1>@yield('page-title', 'Dashboard')</h1>
        <p>@yield('page-subtitle', 'Real-time monitoring sensor PLC')</p>
    </div>

    <div class="topbar-right">
        @yield('topbar-actions')

        <div class="user-profile-container">
            <div class="user-profile">
                <div class="user-avatar" style="@auth background: {{ Auth::user()->avatar_color ?? '#f97316' }}@else background: #f97316 @endauth">
                    @auth
                        @php
                            $nameParts = preg_split('/\s+/', trim(Auth::user()->name ?? ''));
                            $initials = strtoupper((isset($nameParts[0]) ? substr($nameParts[0], 0, 1) : '') . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : ''));
                        @endphp
                        {{ $initials ?: 'AU' }}
                    @else
                        AU
                    @endauth
                </div>
                <div class="user-info">
                    <span class="user-name">
                        @auth
                            {{ Auth::user()->name }}
                        @else
                            Admin User
                        @endauth
                    </span>
                    <span class="user-role">
                        @auth
                            {{ ucfirst(Auth::user()->role ?? 'user') }}
                        @else
                            Administrator
                        @endauth
                    </span>
                </div>
                <i class="fa-solid fa-chevron-down"></i>
            </div>

            <!-- User Profile Dropdown Menu -->
            <div class="user-dropdown">
                <div class="dropdown-header">
                    <div class="user-avatar" style="@auth background: {{ Auth::user()->avatar_color ?? '#f97316' }}@else background: #f97316 @endauth">
                        @auth
                            @php
                                $nameParts = preg_split('/\s+/', trim(Auth::user()->name ?? ''));
                                $initials = strtoupper((isset($nameParts[0]) ? substr($nameParts[0], 0, 1) : '') . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : ''));
                            @endphp
                            {{ $initials ?: 'AU' }}
                        @else
                            AU
                        @endauth
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            @auth
                                {{ Auth::user()->name }}
                            @else
                                Admin User
                            @endauth
                        </span>
                        <span class="user-role">
                            @auth
                                {{ ucfirst(Auth::user()->role ?? 'user') }}
                            @else
                                Administrator
                            @endauth
                        </span>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <a href="javascript:void(0)" class="dropdown-item">
                    <i class="fa-solid fa-user"></i>
                    <span>Profile</span>
                </a>
                <a href="javascript:void(0)" class="dropdown-item">
                    <i class="fa-solid fa-cog"></i>
                    <span>Settings</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="javascript:void(0)" id="logoutBtn" class="dropdown-item logout">
                    <i class="fa-solid fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>
</header>