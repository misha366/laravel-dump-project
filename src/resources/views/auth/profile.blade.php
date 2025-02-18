@extends('layouts.auth')

@section('title', 'Profile - Laravel Dump Project')

@section("content")
    <div class="container mt-5">
        <h2 class="text-center mb-4">Profile</h2>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Update Profile Information</div>
            <div class="card-body">
                <form method="post" action="#" class="mt-3">
                    @csrf
                    @method('patch')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="John Doe" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="john@example.com" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Update Password</div>
            <div class="card-body">
                <form method="post" action="#" class="mt-3">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                        @error('current_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Password</button>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Two-Factor Authentication</div>
            <div class="card-body">
                <div class="mt-3">
                    <p>Add additional security to your account using two-factor authentication.</p>
                    
                    <div class="mt-3">
                        <button type="button" class="btn btn-primary" id="enable2FA">
                            Enable Two-Factor Authentication
                        </button>
                    </div>

                    <div class="mt-3 d-none" id="2FAInstructions">
                        <p>When two-factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.</p>
                        
                        <div class="mt-4">
                            <p>Two-factor authentication is now enabled. Scan the following QR code using your phone's authenticator application.</p>
                            
                            <div class="mt-4">
                                <div class="p-4 bg-light text-center">
                                    [QR Code Placeholder]
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-danger text-white">Delete Account</div>
            <div class="card-body">
                <div class="mt-3">
                    <p class="text-muted">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                    
                    <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                        Delete Account
                    </button>

                    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteAccountModalLabel">Delete Account</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="#" id="deleteAccountForm">
                                        @csrf
                                        @method('delete')
                                        
                                        <div class="mb-3">
                                            <label for="delete_password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="delete_password" name="password" required>
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete Account</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

