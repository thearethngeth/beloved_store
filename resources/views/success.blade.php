@extends('layouts.default')
@section('title', 'Payment Successful')
@section('content')

    <style>
        /* Custom styles matching your product page palette */
        body {
            background: linear-gradient(135deg, #fafafa 0%, #fce9c2 100%);
            min-height: 100vh;
        }

        .success-hero {
            background: linear-gradient(135deg, #eb8abc, #d67aa8);
            color: white;
            padding: 60px 0 40px 0;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .success-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="25" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="25" cy="75" r="1" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
            opacity: 0.3;
        }

        .success-hero .container {
            position: relative;
            z-index: 1;
        }

        .success-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1));
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            animation: successPulse 2s ease-in-out infinite;
        }

        @keyframes successPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .success-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .success-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .order-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(235, 138, 188, 0.15);
            overflow: hidden;
            margin-bottom: 30px;
            background: white;
        }

        .order-card .card-header {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            border-bottom: 2px solid #eb8abc;
            padding: 20px;
            font-weight: 600;
            color: #333;
            font-size: 1.1rem;
        }

        .order-card .card-body {
            padding: 25px;
        }

        .order-detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .order-detail-row:last-child {
            border-bottom: none;
        }

        .order-label {
            font-weight: 600;
            color: #555;
            font-size: 0.95rem;
        }

        .order-value {
            font-weight: 500;
            color: #333;
            text-align: right;
        }

        .status-badge {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
            margin: 40px 0;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #eb8abc, #d67aa8);
            border: none;
            border-radius: 30px;
            padding: 15px 35px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(235, 138, 188, 0.3);
            text-decoration: none;
            color: white;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-custom:hover {
            background: linear-gradient(135deg, #d67aa8, #eb8abc);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(235, 138, 188, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-secondary-custom {
            background: white;
            border: 2px solid #eb8abc;
            color: #eb8abc;
            border-radius: 30px;
            padding: 15px 35px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-secondary-custom:hover {
            background: #eb8abc;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(235, 138, 188, 0.3);
            text-decoration: none;
        }

        .support-section {
            background: linear-gradient(135deg, rgba(255,255,255,0.9), rgba(252,233,194,0.3));
            border: 1px solid rgba(235, 138, 188, 0.2);
            border-radius: 20px;
            padding: 30px;
            margin-top: 40px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(235, 138, 188, 0.1);
        }

        .support-title {
            color: #eb8abc;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .support-text {
            color: #666;
            line-height: 1.6;
            margin: 0;
        }

        .support-link {
            color: #eb8abc;
            text-decoration: none;
            font-weight: 500;
            border-bottom: 1px dotted #eb8abc;
            transition: all 0.3s ease;
        }

        .support-link:hover {
            color: #d67aa8;
            border-bottom: 1px solid #d67aa8;
            text-decoration: none;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .success-hero {
                padding: 40px 0 30px 0;
            }

            .success-title {
                font-size: 2rem;
            }

            .success-subtitle {
                font-size: 1.1rem;
            }

            .success-icon {
                width: 80px;
                height: 80px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-primary-custom,
            .btn-secondary-custom {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .success-title {
                font-size: 1.8rem;
            }

            .order-detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .order-value {
                text-align: left;
            }

            .support-section {
                padding: 20px;
            }
        }
    </style>

    <!-- Success Hero Section -->
    <div class="success-hero">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <!-- Success Icon -->
                    <div class="success-icon">
                        <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22,4 12,14.01 9,11.01"></polyline>
                        </svg>
                    </div>

                    <h1 class="success-title">Payment Successful!</h1>
                    <p class="success-subtitle">
                        Thank you for your purchase. Your order has been confirmed and is being processed.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <main class="container" style="max-width: 800px">
        <!-- Order Details Card -->
        <div class="card order-card">
            <div class="card-header text-center">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                </svg>
                Order Details
            </div>
            <div class="card-body">
                <div class="order-detail-row">
                <span class="order-label">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                    </svg>
                    Order ID:
                </span>
                    <span class="order-value">#{{ $order->id ?? 'N/A' }}</span>
                </div>

                <div class="order-detail-row">
                <span class="order-label">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    Total Amount:
                </span>
                    <span class="order-value" style="color: #eb8abc; font-size: 1.2rem; font-weight: 600;">
                    ${{ number_format($order->total_price ?? 0, 2) }}
                </span>
                </div>

                <div class="order-detail-row">
                <span class="order-label">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                    </svg>
                    Payment Status:
                </span>
                    <span class="order-value">
                    <span class="status-badge">{{ ucfirst($order->payment_status ?? 'Completed') }}</span>
                </span>
                </div>

                <div class="order-detail-row">
                <span class="order-label">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9,22 9,12 15,12 15,22"></polyline>
                    </svg>
                    Delivery Address:
                </span>
                    <span class="order-value" style="max-width: 60%; text-align: right;">
                    {{ $order->address ?? 'N/A' }}
                </span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('home') }}" class="btn-primary-custom">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9,22 9,12 15,12 15,22"></polyline>
                </svg>
                Continue Shopping
            </a>

            @auth
                <a href="{{ route('orders.index') }}" class="btn-secondary-custom">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14,2 14,8 20,8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10,9 9,9 8,9"></polyline>
                    </svg>
                    View Orders
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-secondary-custom">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                        <polyline points="10,17 15,12 10,7"></polyline>
                        <line x1="15" y1="12" x2="3" y2="12"></line>
                    </svg>
                    Login to Account
                </a>
            @endauth
        </div>

        <!-- Support Information -->
        <div class="support-section">
            <h6 class="support-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 12l2 2 4-4"></path>
                    <path d="M21 12c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1z"></path>
                    <path d="M3 12c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1z"></path>
                    <path d="M12 3c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1z"></path>
                    <path d="M12 21c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1z"></path>
                </svg>
                Need Help?
            </h6>
            <p class="support-text">
                If you have any questions about your order, please contact our support team at
                <a href="mailto:thearethngeth123@gmail.com" class="support-link">support@example.com</a>
                or call us at
                <a href="tel:+11234567890" class="support-link">(123) 456-7890</a>.
            </p>
        </div>
    </main>

@endsection
