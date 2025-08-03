@extends('layouts.default')
@section('title', 'Edit Profile')

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
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                <!-- Edit Profile Card -->
                <div class="card profile-card">
                    <!-- Header -->
                    <div class="profile-header p-4 text-center">
                        <h3 class="mb-0">
                            <i class="fas fa-edit me-2"></i>
                            Edit Profile
                        </h3>
                    </div>

                    <!-- Form -->
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')

                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-user me-2 text-primary-custom"></i>
                                    Full Name
                                </label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $user->name) }}"
                                       required>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold">
                                    <i class="fas fa-envelope me-2 text-primary-custom"></i>
                                    Email Address
                                </label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email', $user->email) }}"
                                       required>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Current Information Display -->
                            <div class="alert alert-info">
                                <h6 class="alert-heading">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Current Information
                                </h6>
                                <p class="mb-1"><strong>Name:</strong> {{ $user->name }}</p>
                                <p class="mb-1"><strong>Email:</strong> {{ $user->email }}</p>
                                <p class="mb-0 small text-muted">Member since {{ $user->created_at->format('F d, Y') }}</p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center pt-3 border-top">
                                <button type="submit" class="btn btn-primary-custom me-md-2">
                                    <i class="fas fa-save me-2"></i>
                                    Save Changes
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
@endsection
