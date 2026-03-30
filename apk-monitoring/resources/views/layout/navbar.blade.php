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

        <!-- MQTT Service Button -->
        <div class="mqtt-service-container">
            <button class="mqtt-service-btn" id="mqttServiceBtn">
                <i class="fa-solid fa-satellite-dish"></i>
                <span class="mqtt-status-text">MQTT</span>
                <span class="mqtt-status-badge" id="mqttStatusBadge">
                    <i class="fa-solid fa-circle"></i>
                </span>
            </button>

            <!-- MQTT Dropdown Menu -->
            <div class="mqtt-dropdown" id="mqttDropdown">
                <div class="mqtt-dropdown-header">
                    <i class="fa-solid fa-satellite-dish"></i>
                    <div class="mqtt-info">
                        <span class="mqtt-title">MQTT Service</span>
                        <span class="mqtt-status-label" id="mqttStatusLabel">Checking...</span>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                
                <button class="mqtt-action-btn" id="mqttStartBtn" style="display: none;">
                    <i class="fa-solid fa-play"></i>
                    <span>Start Service</span>
                </button>
                
                <button class="mqtt-action-btn" id="mqttStopBtn" style="display: none;">
                    <i class="fa-solid fa-stop"></i>
                    <span>Stop Service</span>
                </button>
                
                <button class="mqtt-action-btn" id="mqttRestartBtn" style="display: none;">
                    <i class="fa-solid fa-rotate"></i>
                    <span>Restart Service</span>
                </button>
                
                <div class="dropdown-divider"></div>
                
                <button class="mqtt-action-btn" id="mqttLogsBtn">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>View Logs</span>
                </button>
            </div>
        </div>

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