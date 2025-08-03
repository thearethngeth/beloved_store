@extends('layouts.default')
@section('title', 'Payment Successful')
@section('content')

    <main class="container" style="max-width: 900px">
        <section class="text-center py-5">
            <!-- Success Icon -->
            <div class="mb-4">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-success">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22,4 12,14.01 9,11.01"></polyline>
                </svg>
            </div>

            <!-- Success Message -->
            <h1 class="display-4 text-success mb-3">Payment Successful!</h1>
            <p class="lead text-muted mb-4">
                Thank you for your purchase. Your order has been confirmed and is being processed.
            </p>

            <!-- Order Details Card -->
            <div class="card mx-auto" style="max-width: 500px;">
                <div class="card-body">
                    <h5 class="card-title text-start">Order Details</h5>
                    <div class="row text-start">
                        <div class="col-sm-6">
                            <strong>Order ID:</strong>
                        </div>
                        <div class="col-sm-6">
                            #{{ $order->id ?? 'N/A' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row text-start">
                        <div class="col-sm-6">
                            <strong>Total Amount:</strong>
                        </div>
                        <div class="col-sm-6">
                            ${{ number_format($order->total_price ?? 0, 2) }}
                        </div>
                    </div>
                    <hr>
                    <div class="row text-start">
                        <div class="col-sm-6">
                            <strong>Payment Status:</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="badge bg-success">{{ ucfirst($order->payment_status ?? 'Completed') }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-start">
                        <div class="col-sm-6">
                            <strong>Delivery Address:</strong>
                        </div>
                        <div class="col-sm-6">
                            {{ $order->address ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- What's Next Section -->
            <div class="mt-5">
                <h4 class="mb-3">What's Next?</h4>
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary mb-2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <h6>Order Processing</h6>
                                <p class="small text-muted">We'll start preparing your order right away</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-warning mb-2">
                                    <rect x="1" y="3" width="15" height="13"></rect>
                                    <path d="M16 8l4-4V6l-4 4z"></path>
                                </svg>
                                <h6>Email Confirmation</h6>
                                <p class="small text-muted">Check your email for order confirmation</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-info mb-2">
                                    <path d="M16 3h5v5M4 20L21 3M21 16v5h-5M15 15l6 6M4 4l5 5"></path>
                                </svg>
                                <h6>Tracking Updates</h6>
                                <p class="small text-muted">You'll receive tracking information soon</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-5">
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg me-3">
                    Continue Shopping
                </a>
                @auth
                    <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary btn-lg">
                        View Profile
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">
                        Login to Account
                    </a>
                @endauth
            </div>

            <!-- Support Information -->
            <div class="mt-5 p-4 bg-light rounded">
                <h6 class="mb-2">Need Help?</h6>
                <p class="mb-0 text-muted">
                    If you have any questions about your order, please contact our support team at
                    <a href="mailto:support@example.com">support@example.com</a> or call us at (123) 456-7890.
                </p>
            </div>
        </section>
    </main>

@endsection
