{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User - Automation Monitoring System</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-industry"></i>
            </div>
            <h2>Automation Monitoring</h2>
        </div>
        <nav class="sidebar-menu">
            <a href="dashboard.html" class="menu-item">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="control.html" class="menu-item">
                <i class="fas fa-sliders-h"></i>
                <span>Control</span>
            </a>
            <a href="laporan.html" class="menu-item">
                <i class="fas fa-file-alt"></i>
                <span>Laporan</span>
            </a>
            <a href="notifikasi.html" class="menu-item">
                <i class="fas fa-bell"></i>
                <span>Notifikasi</span>
            </a>
            <a href="manage-user.html" class="menu-item active">
                <i class="fas fa-users-cog"></i>
                <span>Manage User</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="navbar-left">
                <h1>Manajemen User</h1>
            </div>
            <div class="navbar-right">
                <div class="user-profile">
                    <div class="avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info">
                        <span class="user-name">Admin User</span>
                        <span class="user-role">Administrator</span>
                    </div>
                    <div class="dropdown">
                        <button class="dropdown-toggle">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-user-circle"></i> Profile
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <hr>
                            <a href="#" class="dropdown-item logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- User Management Content -->
        <div class="content">
            <div class="page-header">
                <h2>Daftar User</h2>
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah User Baru
                </button>
            </div>

            <!-- Search and Filter -->
            <div class="filter-section">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari user..." class="search-input">
                </div>
                <div class="filter-group">
                    <label><i class="fas fa-filter"></i> Role</label>
                    <select class="form-control">
                        <option value="">Semua Role</option>
                        <option value="admin">Administrator</option>
                        <option value="operator">Operator</option>
                        <option value="viewer">Viewer</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label><i class="fas fa-toggle-on"></i> Status</label>
                    <select class="form-control">
                        <option value="">Semua Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <!-- User Table -->
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Terakhir Login</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>Admin User</span>
                                </div>
                            </td>
                            <td>admin@automation.com</td>
                            <td><span class="badge badge-admin">Administrator</span></td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>18 Dec 2024 14:30</td>
                            <td>
                                <button class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>Operator One</span>
                                </div>
                            </td>
                            <td>operator1@automation.com</td>
                            <td><span class="badge badge-operator">Operator</span></td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>18 Dec 2024 13:45</td>
                            <td>
                                <button class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>Operator Two</span>
                                </div>
                            </td>
                            <td>operator2@automation.com</td>
                            <td><span class="badge badge-operator">Operator</span></td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>18 Dec 2024 12:20</td>
                            <td>
                                <button class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>Viewer One</span>
                                </div>
                            </td>
                            <td>viewer1@automation.com</td>
                            <td><span class="badge badge-viewer">Viewer</span></td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>18 Dec 2024 10:15</td>
                            <td>
                                <button class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>Technician One</span>
                                </div>
                            </td>
                            <td>tech1@automation.com</td>
                            <td><span class="badge badge-operator">Operator</span></td>
                            <td><span class="badge badge-warning">Inactive</span></td>
                            <td>17 Dec 2024 16:40</td>
                            <td>
                                <button class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>Supervisor</span>
                                </div>
                            </td>
                            <td>supervisor@automation.com</td>
                            <td><span class="badge badge-admin">Administrator</span></td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>18 Dec 2024 09:30</td>
                            <td>
                                <button class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>Maintenance</span>
                                </div>
                            </td>
                            <td>maintenance@automation.com</td>
                            <td><span class="badge badge-operator">Operator</span></td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>18 Dec 2024 08:15</td>
                            <td>
                                <button class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <button class="btn-page" disabled>
                    <i class="fas fa-chevron-left"></i> Previous
                </button>
                <div class="page-numbers">
                    <button class="btn-page active">1</button>
                    <button class="btn-page">2</button>
                    <button class="btn-page">3</button>
                </div>
                <button class="btn-page">
                    Next <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; 2024 Automation Monitoring System. All rights reserved.</p>
        </footer>
    </div>

    <script src="script.js"></script>
</body>
</html> --}}

@extends('layout.master')

@section('title', 'Manage User - AUTRA')

@section('page-title', 'Manage User')
@section('page-subtitle', 'Kelola pengguna sistem monitoring')

@section('content')
<div class="manage-user-page">
    <div class="page-header">
        <h2></h2>
        <button type="button" class="btn btn-primary" onclick="openAddUserModal()">
            <i class="fa-solid fa-plus"></i> Tambah User
        </button>
    </div>


    <!-- Search Box -->
    <div class="card card-search">
        <div class="search-input">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Cari berdasarkan nama, email, atau role...">
        </div>
    </div>

    <!-- User Table -->
    <div class="card">
        <div class="card-header">
            <h3>
                <i class="fa-solid fa-users"></i>
                Daftar User (4)
            </h3>
        </div>

        <div class="table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#1</td>
                        <td class="fw-bold">Admin Utama</td>
                        <td>admin@automation.com</td>
                        <td>
                            <span class="badge badge-admin">Administrator</span>
                        </td>
                        <td>
                            <span class="badge badge-active">Active</span>
                        </td>
                        <td class="text-center action-btn">
                            <button class="btn-icon btn-edit"
                                onclick="openEditUserModal(
                                'Admin Utama',
                                'admin@automation.com',
                                'Administrator',
                                'Active'
                                )">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="btn-icon btn-delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>#2</td>
                        <td class="fw-bold">Operator 1</td>
                        <td>operator1@automation.com</td>
                        <td>
                            <span class="badge badge-operator">Operator</span>
                        </td>
                        <td>
                            <span class="badge badge-active">Active</span>
                        </td>
                        <td class="text-center action-btn">
                            <button class="btn-icon btn-edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="btn-icon btn-delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>#3</td>
                        <td class="fw-bold">Supervisor</td>
                        <td>supervisor@automation.com</td>
                        <td>
                            <span class="badge badge-supervisor">Supervisor</span>
                        </td>
                        <td>
                            <span class="badge badge-active">Active</span>
                        </td>
                        <td class="text-center action-btn">
                            <button class="btn-icon btn-edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="btn-icon btn-delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>#4</td>
                        <td class="fw-bold">Teknisi</td>
                        <td>teknisi@automation.com</td>
                        <td>
                            <span class="badge badge-technician">Technician</span>
                        </td>
                        <td>
                            <span class="badge badge-inactive">Inactive</span>
                        </td>
                        <td class="text-center action-btn">
                            <button class="btn-icon btn-edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="btn-icon btn-delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- USER MODAL -->
<div id="userModal" class="user-modal-overlay">
    <div class="user-modal">

        <!-- HEADER -->
        <div class="user-modal-header">
            <div class="header-text">
                <h3>Tambah User</h3>
                <span>Isi data pengguna sistem</span>
            </div>
            <button class="close-btn" onclick="closeUserModal()">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- FORM -->
        <form class="user-modal-form" id="userForm">

            <div class="form-section">
                <label>Nama</label>
                <input type="text" placeholder="Nama pengguna" required>
            </div>

            <div class="form-section">
                <label>Email</label>
                <input type="email" placeholder="Email pengguna" required>
            </div>

            <div class="form-row">
                <div class="form-section">
                    <label>Role</label>
                    <select>
                        <option>Administrator</option>
                        <option>Operator</option>
                        <option>Supervisor</option>
                        <option>Teknisi</option>
                    </select>
                </div>

                <div class="form-section">
                    <label>Status</label>
                    <select>
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                    </select>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="user-modal-footer">
                <button type="button" class="btn-cancel" onclick="closeUserModal()">
                    Batal
                </button>

                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
