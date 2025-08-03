@extends('layouts.default')
@section('title', 'Change Password')

@section('style')
    <style>
        body {
            background: linear-gradient(135deg, #fce9c2 0%, #eb8abc 100%);
            min-height: 100vh;
        }

        .profile-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            background: white;
        }

        .profile-header {
            background: linear-gradient(135deg, #eb8abc, #d175a3);
            color: white;
            border-radius: 15px 15px 0 0;
        }

        .btn-primary-custom {
            background-color: #eb8abc;
            border-color: #eb8abc;
        }

        .btn-primary-custom:hover {
            background-color: #d175a3;
            border-color: #d175a3;
        }

        .btn-outline-custom {
            color: #eb8abc;
            border-color: #eb8abc;
        }

        .btn-outline-custom:hover {
            background-color: #eb8abc;
            border-color: #eb8abc;
            color: white;
        }

        .text-primary-custom {
            color: #eb8abc !important;
        }

        .form-control:focus {
            border-color: #eb8abc;
            box-shadow: 0 0 0 0.2rem rgba(235, 138, 188, 0.25);
        }

        .password-requirements {
            background: #fce9c2;
            border-left: 4px solid #eb8abc;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                <!-- Change Password Card -->
                <div class="card profile-card">
                    <!-- Header -->
                    <div class="profile-header p-4 text-center">
                        <h3 class="mb-0">
                            <i class="fas fa-key me-2"></i>
                            Change Password
                        </h3>
                    </div>

                    <!-- Form -->
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('profile.password.update') }}">
                            @csrf
                            @method('PUT')

                            <!-- Current Password -->
                            <div class="mb-3">
                                <label for="current_password" class="form-label fw-bold">
                                    <i class="fas fa-lock me-2 text-primary-custom"></i>
                                    Current Password
                                </label>
                                <input type="password"
                                       class="form-control @error('current_password') is-invalid @enderror"
                                       id="current_password"
                                       name="current_password"
                                       required>
                                @error('current_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">
                                    <i class="fas fa-key me-2 text-primary-custom"></i>
                                    New Password
                                </label>
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       id="password"
                                       name="password"
                                       required>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-bold">
                                    <i class="fas fa-check-circle me-2 text-primary-custom"></i>
                                    Confirm New Password
                                </label>
                                <input type="password"
                                       class="form-control"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       required>
                            </div>

                            <!-- Password Requirements -->
                            <div class="password-requirements p-3 rounded mb-4">
                                <h6 class="mb-2">
                                    <i class="fas fa-shield-alt me-2"></i>
                                    Password Requirements
                                </h6>
                                <ul class="mb-0 small">
                                    <li>At least 8 characters long</li>
                                    <li>Must be different from current password</li>
                                    <li>Both new password fields must match</li>
                                </ul>
                            </div>

                            <!-- Security Notice -->
                            <div class="alert alert-warning">
                                <h6 class="alert-heading">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Security Notice
                                </h6>
                                <p class="mb-0 small">
                                    After changing your password, you may need to log in again on other devices.
                                    Make sure to use a strong, unique password for your security.
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center pt-3 border-top">
                                <button type="submit" class="btn btn-primary-custom me-md-2">
                                    <i class="fas fa-save me-2"></i>
                                    Change Password
                                </button>
                                <a href="{{ route('profile.show') }}" class="btn btn-outline-custom">
                                    <i class="fas fa-times me-2"></i>
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show/Hide password toggle (optional enhancement)
        document.addEventListener('DOMContentLoaded', function() {
            // You can add password visibility toggle here if needed
            const passwordInputs = document.querySelectorAll('input[type="password"]');

            passwordInputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    // Add visual feedback for password strength if needed
                });
            });
        });
    </script>
@endsection
