@extends('layout.master')
@section('sidebar')
    @include('layout.sidebar')
@endsection
@section('navbar')
    @include('layout.navbar')
@endsection

@section('title', 'Manage User - AUTRA')

@section('page-title', 'Manage User')
@section('page-subtitle', 'Kelola pengguna sistem monitoring')

@section('content')
    <!-- Header Section with Add Button -->
    <div class="page-header-section">
        <div class="header-left">
            <h2 class="section-title">
                <i class="fa-solid fa-users"></i>
                Daftar User
            </h2>
            <p class="section-subtitle">Kelola semua pengguna sistem</p>
        </div>
        <button class="btn-add-user" id="btnAddUser">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah User</span>
        </button>
    </div>

    <!-- Search Section -->
    <div class="search-section">
        <div class="search-container">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" class="search-input" id="searchInput" placeholder="Cari berdasarkan nama, email, atau role...">
        </div>
    </div>

    <!-- User Table Section -->
    <div class="user-table-section">
        <div class="table-header">
            <div class="table-title">
                <i class="fa-solid fa-users"></i>
                <h3>Daftar User (<span id="userCount">{{ $users->count() }}</span>)</h3>
            </div>
        </div>

        <div class="table-container">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    @forelse($users as $user)
                    <tr data-user-id="{{ $user->id }}">
                        <td class="id-cell">#{{ $user->id }}</td>
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar-table" style="background: {{ $user->avatar_color ?? '#f97316' }}">
                                    {{ $user->initials }}
                                </div>
                                <span class="user-name-table">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td><span class="role-badge role-{{ strtolower($user->role) }}">{{ ucfirst($user->role) }}</span></td>
                        <td><span class="status-badge badge-{{ $user->status }}">{{ ucfirst($user->status) }}</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-edit" data-id="{{ $user->id }}" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="btn-action btn-delete" data-id="{{ $user->id }}" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class="fa-solid fa-users-slash"></i>
                            <p>Belum ada user yang terdaftar</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form Add/Edit User -->
    <div class="modal-overlay" id="userModal">
        <div class="modal-container">
            <div class="modal-header">
                <h2 id="modalTitle">Tambah User Baru</h2>
                <button class="btn-close-modal" id="btnCloseModal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="userForm" class="modal-form">
                @csrf
                <input type="hidden" id="userId" name="id">
                <input type="hidden" id="formMethod" name="_method" value="POST">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="userName">Nama Lengkap <span class="required">*</span></label>
                        <div class="input-container">
                            <i class="fa-solid fa-user input-icon"></i>
                            <input type="text" id="userName" name="name" placeholder="Masukkan nama lengkap" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="userRole">Role <span class="required">*</span></label>
                        <div class="input-container">
                            <i class="fa-solid fa-user-tag input-icon"></i>
                            <select id="userRole" name="role" required>
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="guru">Guru</option>
                                <option value="siswa">Siswa</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="userEmail">Email <span class="required">*</span></label>
                        <div class="input-container input-email-group">
                            <i class="fa-solid fa-envelope input-icon"></i>
                            <input type="text" id="userEmail" name="email_prefix" placeholder="nama" required>
                            <span class="email-domain">@autra.com</span>
                        </div>
                        <small class="form-hint">Format: nama@autra.com</small>
                    </div>

                    <div class="form-group">
                        <label for="userStatus">Status <span class="required">*</span></label>
                        <div class="input-container">
                            <i class="fa-solid fa-toggle-on input-icon"></i>
                            <select id="userStatus" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="passwordGroup">
                    <label for="userPassword">Password <span class="required">*</span></label>
                    <div class="input-container">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" id="userPassword" name="password" placeholder="Masukkan password">
                        <button type="button" class="btn-toggle-password" id="togglePassword">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    <small class="form-hint">Minimal 8 karakter</small>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-cancel" id="btnCancel">
                        <i class="fa-solid fa-xmark"></i>
                        <span>Batal</span>
                    </button>
                    <button type="submit" class="btn-submit" id="btnSubmit">
                        <i class="fa-solid fa-check"></i>
                        <span>Simpan User</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection