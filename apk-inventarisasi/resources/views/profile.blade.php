@extends('be.layout')

@php
    $title = 'Profile Settings';
    $breadcrumb = 'Profile';
@endphp

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-lg border-0" style="border-radius: 20px;">
                <div class="card-header bg-gradient-primary p-4" style="border-radius: 20px 20px 0 0;">
                    <h5 class="text-white mb-0"><i class="fas fa-user-gear me-2"></i>Account Settings</h5>
                    <p class="text-white opacity-8 mb-0 text-sm">Update your profile information and security settings</p>
                </div>
                <div class="card-body p-4">
                    <ul class="nav nav-pills nav-fill p-1 bg-gray-100 border-radius-lg mb-4" id="profileTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 active" id="profile-info-tab" data-bs-toggle="pill" href="#profile-info" role="tab" aria-selected="true">
                                <i class="fas fa-id-card me-2"></i> Personal Info
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1" id="security-tab" data-bs-toggle="pill" href="#security" role="tab" aria-selected="false">
                                <i class="fas fa-shield-halved me-2"></i> Security
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" id="profileTabContent">
                        <div class="tab-pane fade show active" id="profile-info" role="tabpanel" aria-labelledby="profile-info-tab">
                            <form id="formUpdateProfile" action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label text-sm">Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user text-xs"></i></span>
                                        <input class="form-control" type="text" name="name" value="{{ $user->name }}" required>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-control-label text-sm">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope text-xs"></i></span>
                                        <input class="form-control" type="email" name="email" value="{{ $user->email }}" required>
                                    </div>
                                </div>
                                <div class="text-end mt-4">
                                    <button type="button" onclick="askConfirm('formUpdateProfile')" class="btn bg-gradient-primary mb-0">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                            <form id="formUpdatePassword" action="{{ route('profile.password') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label text-sm">Old Password</label>
                                    <input class="form-control" type="password" name="old_password" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-control-label text-sm">New Password</label>
                                    <input class="form-control" type="password" name="password" placeholder="Min. 6 characters" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-control-label text-sm">Confirm New Password</label>
                                    <input class="form-control" type="password" name="password_confirmation" required>
                                </div>
                                <div class="text-end mt-4">
                                    <button type="button" onclick="askConfirm('formUpdatePassword')" class="btn bg-gradient-dark mb-0">
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Fungsi Konfirmasi
    function askConfirm(formId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to apply these changes?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#5e72e4',
            cancelButtonColor: '#f5365c',
            confirmButtonText: 'Yes, Save it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        })
    }

    // Success Alert
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Updated!',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    // Error Alert
    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ $errors->first() }}",
        });
    @endif
</script>
@endpush