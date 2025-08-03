@extends('layouts.default')
@section('title', 'Profile')

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

        .profile-avatar {
            width: 100px;
            height: 100px;
            background: white;
            color: #eb8abc;
            border: 4px solid white;
            position: relative;
            overflow: hidden;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-avatar .avatar-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            background: #f8f9fa;
        }

        .photo-upload-btn {
            position: absolute;
            bottom: -5px;
            right: -5px;
            width: 35px;
            height: 35px;
            background: #ffffff;
            border: 2px solid white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .photo-upload-btn:hover {
            background: #dc9bb9;
            transform: scale(1.1);
        }

        .photo-upload-btn i {
            color: white;
            font-size: 14px;
        }

        #photo-upload {
            display: none;
        }

        .info-card {
            background: #ffffff;
            border-left: 4px solid #eb8abc;
            border-radius: 8px;
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

        .badge-custom {
            background-color: #eb8abc;
            color: white;
        }

        /* Photo preview modal styles */
        .photo-preview {
            max-width: 100%;
            max-height: 400px;
            object-fit: contain;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <!-- Success Message -->
        @if(session('success'))
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">

                <!-- Main Profile Card -->
                <div class="card profile-card mb-4">
                    <!-- Profile Header -->
                    <div class="profile-header p-4 text-center">
                        <div class="profile-avatar rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="rounded-circle">
                            @else
                                <div class="avatar-placeholder">
                                    <i class="fas fa-user fa-2x"></i>
                                </div>
                            @endif

                            <!-- Photo Upload Button -->
                            <div class="photo-upload-btn" onclick="document.getElementById('photo-upload').click()">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                        <h3 class="mb-1">{{ $user->name }}</h3>
                        <p class="mb-2 opacity-75">{{ $user->email }}</p>
                        <small class="opacity-75">
                            <i class="fas fa-calendar me-1"></i>
                            Member since {{ $user->created_at->format('M Y') }}
                        </small>
                    </div>

                    <!-- Hidden Photo Upload Form -->
                    <form id="photo-form" action="{{ route('profile.photo.upload') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                        @csrf
                        <input type="file" id="photo-upload" name="profile_photo" accept="image/*" onchange="previewAndUpload(this)">
                    </form>

                    <!-- Profile Information -->
                    <div class="card-body">
                        <h5 class="text-primary-custom mb-3">
                            <i class="fas fa-user-circle me-2"></i>
                            Personal Information
                        </h5>

                        <div class="info-card p-3 mb-3">
                            <div class="row">
                                <div class="col-sm-4">
                                    <strong>Full Name:</strong>
                                </div>
                                <div class="col-sm-8">
                                    {{ $user->name }}
                                </div>
                            </div>
                        </div>

                        <div class="info-card p-3 mb-3">
                            <div class="row">
                                <div class="col-sm-4">
                                    <strong>Email:</strong>
                                </div>
                                <div class="col-sm-8">
                                    {{ $user->email }}
                                    <span class="badge badge-custom ms-2">Verified</span>
                                </div>
                            </div>
                        </div>

                        <div class="info-card p-3 mb-3">
                            <div class="row">
                                <div class="col-sm-4">
                                    <strong>Member Since:</strong>
                                </div>
                                <div class="col-sm-8">
                                    {{ $user->created_at->format('F d, Y') }}
                                    <br><small class="text-muted">({{ $user->created_at->diffForHumans() }})</small>
                                </div>
                            </div>
                        </div>

                        <div class="info-card p-3 mb-4">
                            <div class="row">
                                <div class="col-sm-4">
                                    <strong>Status:</strong>
                                </div>
                                <div class="col-sm-8">
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i>Active
                                </span>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <h5 class="text-primary-custom mb-3">
                            <i class="fas fa-clock me-2"></i>
                            Recent Activity
                        </h5>

                        <div class="list-group list-group-flush mb-4">
                            <div class="list-group-item border-0 px-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-sign-in-alt me-2 text-success"></i>
                                        Last login
                                    </div>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                            </div>
                            <div class="list-group-item border-0 px-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-edit me-2 text-primary"></i>
                                        Profile updated
                                    </div>
                                    <small class="text-muted">5 days ago</small>
                                </div>
                            </div>
                            <div class="list-group-item border-0 px-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-user-plus me-2 text-info"></i>
                                        Account created
                                    </div>
                                    <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="text-center border-top pt-3">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary-custom me-2 mb-2">
                                <i class="fas fa-edit me-2"></i>Edit Profile
                            </a>
                            <a href="{{ route('profile.password.edit') }}" class="btn btn-outline-custom me-2 mb-2">
                                <i class="fas fa-key me-2"></i>Change Password
                            </a>
                            @if($user->profile_photo)
                                <form action="{{ route('profile.photo.delete') }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger me-2 mb-2" onclick="return confirm('Are you sure you want to delete your profile photo?')">
                                        <i class="fas fa-trash me-2"></i>Remove Photo
                                    </button>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Photo Preview Modal -->
    <div class="modal fade" id="photoPreviewModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Profile Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="preview-image" src="" alt="Preview" class="photo-preview mb-3">
                    <p>Do you want to upload this photo as your profile picture?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary-custom" onclick="uploadPhoto()">
                        <i class="fas fa-upload me-2"></i>Upload Photo
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function previewAndUpload(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Validate file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB');
                    return;
                }

                // Validate file type
                if (!file.type.match('image.*')) {
                    alert('Please select a valid image file');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                    const modal = new bootstrap.Modal(document.getElementById('photoPreviewModal'));
                    modal.show();
                }
                reader.readAsDataURL(file);
            }
        }

        function uploadPhoto() {
            document.getElementById('photo-form').submit();
        }</script>
@endsection
