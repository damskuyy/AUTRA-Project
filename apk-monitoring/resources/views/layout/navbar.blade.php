    <!-- Top Bar  -->
    <header class="topbar">
        <div class="page-title">
            <h1>@yield('page-title', 'Dashboard')</h1>
            <p>@yield('page-subtitle', 'Real-time monitoring sensor PLC')</p>
        </div>

        <div class="topbar-right">
            @yield('topbar-actions')

            <div class="user-profile-container">
                <div class="user-profile">
                    <div class="user-avatar">AU</div>
                    <div class="user-info">
                        <span class="user-name">Admin User</span>
                        <span class="user-role">Administrator</span>
                    </div>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>

                <!-- User Profile Dropdown Menu -->
                <div class="user-dropdown">
                    <div class="dropdown-header">
                        <div class="user-avatar">AU</div>
                        <div class="user-info">
                            <span class="user-name">Admin User</span>
                            <span class="user-role">Administrator</span>
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