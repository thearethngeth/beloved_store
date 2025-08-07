@extends('layouts.default')
@section('title', 'Checkout')
@section('content')

    <style>
        /* Custom styles matching your color palette */
        body {
            background: linear-gradient(135deg, #fafafa 0%, #fce9c2 100%);
            min-height: 100vh;
        }

        .hero-section {
            background: linear-gradient(135deg, #eb8abc, #d67aa8);
            color: white;
            padding: 60px 0;
            margin-bottom: 40px;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .checkout-card {
            background: white;
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(235, 138, 188, 0.15);
            overflow: hidden;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .checkout-card:hover {
            box-shadow: 0 12px 40px rgba(235, 138, 188, 0.2);
        }

        .checkout-header {
            background: linear-gradient(135deg, #eb8abc 0%, #d67aa8 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .checkout-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .checkout-header h3 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 600;
            position: relative;
            z-index: 1;
        }

        .checkout-header .subtitle {
            opacity: 0.9;
            margin-top: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .form-section {
            padding: 2.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 0.9rem 1.2rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #fafafa;
        }

        .form-control:focus {
            border-color: #eb8abc;
            box-shadow: 0 0 0 0.2rem rgba(235, 138, 188, 0.25);
            background-color: white;
            transform: translateY(-2px);
        }

        .form-control:hover {
            border-color: #eb8abc;
            background-color: white;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            display: block;
            font-size: 0.9rem;
            color: #dc3545;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        .btn-primary {
            background: linear-gradient(135deg, #eb8abc, #d67aa8);
            border: none;
            border-radius: 50px;
            padding: 1rem 3rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #d67aa8, #eb8abc);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(235, 138, 188, 0.4);
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 1.2rem 1.5rem;
            font-weight: 500;
            margin-bottom: 2rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f1b0b7 100%);
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .form-floating {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-floating > .form-control {
            height: auto;
            padding: 1.5rem 1.2rem 0.7rem 1.2rem;
        }

        .form-floating > label {
            position: absolute;
            top: 0;
            left: 1.2rem;
            height: 100%;
            padding: 1.5rem 0 0.7rem 0;
            pointer-events: none;
            border: none;
            transform-origin: 0 0;
            transition: opacity 0.1s ease-in-out, transform 0.1s ease-in-out;
            color: #6c757d;
            font-weight: 500;
        }

        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            opacity: 0.65;
            transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
            color: #eb8abc;
        }

        .input-group {
            margin-bottom: 1.5rem;
        }

        .input-group-text {
            background: linear-gradient(135deg, #eb8abc, #d67aa8);
            color: white;
            border: none;
            font-weight: 600;
            border-radius: 12px 0 0 12px;
            padding: 0.9rem 1.2rem;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        .security-badge {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            margin-top: 2rem;
            border: 2px solid rgba(235, 138, 188, 0.1);
        }

        .security-badge .icon {
            font-size: 2rem;
            color: #eb8abc;
            margin-bottom: 0.5rem;
        }

        .security-text {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0;
        }

        .step-indicator {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 2rem 0;
            gap: 1rem;
        }

        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #6c757d;
            position: relative;
        }

        .step.active {
            background: linear-gradient(135deg, #eb8abc, #d67aa8);
            color: white;
        }

        .step-connector {
            width: 60px;
            height: 2px;
            background: #e9ecef;
        }

        .step-connector.active {
            background: linear-gradient(135deg, #eb8abc, #d67aa8);
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 0;
            }
            .hero-title {
                font-size: 2rem;
            }
            .form-section {
                padding: 2rem 1.5rem;
            }
            .btn-primary {
                width: 100%;
                padding: 1rem 2rem;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.8rem;
            }
            .hero-subtitle {
                font-size: 1rem;
            }
            .checkout-header {
                padding: 1.5rem;
            }
            .form-section {
                padding: 1.5rem 1rem;
            }
        }
    </style>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="hero-title">Secure Checkout</h1>
                    <p class="hero-subtitle">Complete your purchase safely and securely</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Step Indicator -->
    <div class="container">
        <div class="step-indicator">
            <div class="step active">1</div>
            <div class="step-connector"></div>
            <div class="step active">2</div>
            <div class="step-connector"></div>
            <div class="step">3</div>
        </div>
        <div class="text-center mb-4">
            <small class="text-muted">Cart → <strong>Shipping Details</strong> → Payment</small>
        </div>
    </div>

    <main class="container" style="max-width: 900px">
        <!-- Alert Messages -->
        @if(session()->has("success"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{session()->get("success")}}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session("error"))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{session("error")}}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <section>
            <div class="checkout-card">
                <div class="checkout-header">
                    <h3>Shipping Information</h3>
                    <p class="subtitle mb-0">Please provide your delivery details</p>
                </div>

                <div class="form-section">
                    <form action="{{route('checkout.post')}}" method="POST">
                        @csrf

                        <!-- Address Field with Floating Label -->
                        <div class="form-floating mb-4">
                            <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                      id="address"
                                      name="address"
                                      rows="3"
                                      style="height: 120px"
                                      placeholder="Enter your full address"
                                      required>{{ old('address') }}</textarea>
                            <label for="address">
                                <i class="fas fa-map-marker-alt me-2"></i>Full Address
                            </label>
                            @error('address')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Phone Field with Input Group -->
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <i class="fas fa-phone"></i>
                            </span>
                            <div class="form-floating flex-fill">
                                <input type="tel" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       pattern="[0-9]{10,15}"
                                       title="Please enter a valid phone number (10-15 digits)"
                                       placeholder="Enter phone number"
                                       required>
                                <label for="phone">Phone Number</label>
                                @error('phone')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Pincode Field with Input Group -->
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <i class="fas fa-mail-bulk"></i>
                            </span>
                            <div class="form-floating flex-fill">
                                <input type="text" class="form-control {{ $errors->has('pincode') ? 'is-invalid' : '' }}"
                                       id="pincode"
                                       name="pincode"
                                       value="{{ old('pincode') }}"
                                       pattern="[0-9]{5,6}"
                                       title="Please enter a valid pincode (5-6 digits)"
                                       maxlength="6"
                                       placeholder="Enter pincode"
                                       required>
                                <label for="pincode">Pincode / ZIP Code</label>
                                @error('pincode')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-credit-card me-2"></i>
                                Proceed to Payment
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class="fas fa-lock me-1"></i>
                                Secure payment powered by industry-leading security
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection
