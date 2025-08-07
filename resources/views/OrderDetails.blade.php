@extends("layouts.default")
@section("title","Order Details - beloved")
@section("content")
    <main class="container" style="max-width: 1000px;">
        <section>
            <style>
                .order-container {
                    background: #ffffff;
                    min-height: 100vh;
                    padding: 20px 0;
                }

                .breadcrumb-custom {
                    font-size: 14px;
                    color: #6c757d;
                    margin-bottom: 2rem;
                }

                .breadcrumb-custom a {
                    color: #6c757d;
                    text-decoration: none;
                }

                .breadcrumb-custom a:hover {
                    color: #dc9bb9;
                }

                .order-header {
                    background: #f8f9fa;
                    border: 1px solid #e9ecef;
                    border-radius: 12px;
                    padding: 24px;
                    margin-bottom: 24px;
                }

                .order-number {
                    font-size: 1.5rem;
                    font-weight: 700;
                    color: #333;
                }

                .order-date {
                    color: #dc9bb9;
                    font-size: 14px;
                }

                .status-badge {
                    padding: 8px 16px;
                    border-radius: 20px;
                    font-size: 12px;
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                }

                .status-pending {
                    background: #fff3cd;
                    color: #856404;
                    border: 1px solid #ffeaa7;
                }

                .status-processing {
                    background: #f3c6dd;
                    color: #ff69d3;
                    border: 1px solid #ff90df;
                }

                .status-completed {
                    background: #d4edda;
                    color: #155724;
                    border: 1px solid #c3e6cb;
                }

                .status-shipped {
                    background: #d4edda;
                    color: #155724;
                    border: 1px solid #c3e6cb;
                }

                .status-delivered {
                    background: #d1ecf1;
                    color: #0c5460;
                    border: 1px solid #bee5eb;
                }

                .status-cancelled {
                    background: #f8d7da;
                    color: #721c24;
                    border: 1px solid #f5c6cb;
                }

                .order-section {
                    background: white;
                    border: 1px solid #e9ecef;
                    border-radius: 12px;
                    padding: 24px;
                    margin-bottom: 24px;
                }

                .section-title {
                    font-size: 1.25rem;
                    font-weight: 600;
                    color: #333;
                    margin-bottom: 20px;
                    padding-bottom: 12px;
                    border-bottom: 2px solid #f8f9fa;
                }

                .order-item {
                    display: flex;
                    align-items: center;
                    padding: 16px 0;
                    border-bottom: 1px solid #f8f9fa;
                }

                .order-item:last-child {
                    border-bottom: none;
                }

                .item-image {
                    width: 80px;
                    height: 80px;
                    object-fit: cover;
                    border-radius: 8px;
                    background: #f8f9fa;
                    border: 1px solid #e9ecef;
                }

                .item-details {
                    flex: 1;
                    margin-left: 16px;
                }

                .item-name {
                    font-weight: 600;
                    color: #333;
                    margin-bottom: 4px;
                }

                .item-price {
                    color: #6c757d;
                    font-size: 14px;
                }

                .item-quantity {
                    color: #6c757d;
                    font-size: 14px;
                }

                .item-total {
                    font-weight: 600;
                    color: #333;
                    text-align: right;
                }

                .order-summary {
                    background: #f8f9fa;
                    border-radius: 8px;
                    padding: 20px;
                }

                .summary-row {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 12px;
                }

                .summary-row:last-child {
                    margin-bottom: 0;
                    padding-top: 12px;
                    border-top: 2px solid #dee2e6;
                    font-weight: 600;
                    font-size: 1.1rem;
                }

                .summary-label {
                    color: #6c757d;
                }

                .summary-value {
                    font-weight: 500;
                    color: #333;
                }

                .address-block {
                    background: #f8f9fa;
                    border-radius: 8px;
                    padding: 16px;
                    margin-bottom: 16px;
                }

                .address-title {
                    font-weight: 600;
                    color: #333;
                    margin-bottom: 8px;
                }

                .address-text {
                    color: #6c757d;
                    line-height: 1.5;
                    margin: 0;
                }

                .tracking-info {
                    background: #e8f5e8;
                    border: 1px solid #c8e6c9;
                    border-radius: 8px;
                    padding: 16px;
                    margin-top: 16px;
                }

                .tracking-title {
                    color: #2e7d32;
                    font-weight: 600;
                    margin-bottom: 8px;
                }

                .tracking-number {
                    font-family: 'Courier New', monospace;
                    background: white;
                    padding: 8px 12px;
                    border-radius: 4px;
                    color: #333;
                    font-weight: 500;
                }

                .action-buttons {
                    display: flex;
                    gap: 12px;
                    flex-wrap: wrap;
                }

                .btn-reorder {
                    background: #ff90df;
                    color: white;
                    border: none;
                    border-radius: 8px;
                    padding: 12px 24px;
                    font-weight: 600;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    transition: background-color 0.2s;
                }

                .btn-reorder:hover {
                    background: #333;
                    color: white;
                }

                .btn-track {
                    background: white;
                    color: #333;
                    border: 1px solid #dee2e6;
                    border-radius: 8px;
                    padding: 12px 24px;
                    font-weight: 600;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    transition: all 0.2s;
                }

                .btn-track:hover {
                    background: #f8f9fa;
                    color: #333;
                    border-color: #adb5bd;
                }

                .btn-back {
                    background: #ff90df;
                    color: white;
                    border: none;
                    border-radius: 8px;
                    padding: 8px 16px;
                    font-weight: 600;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    transition: background-color 0.2s;
                    margin-bottom: 20px;
                }

                .btn-back:hover {
                    background: #e4c2e4;
                    color: white;
                }

                @media (max-width: 768px) {
                    .order-item {
                        flex-direction: column;
                        align-items: flex-start;
                        text-align: left;
                    }

                    .item-details {
                        margin-left: 0;
                        margin-top: 12px;
                        width: 100%;
                    }

                    .item-total {
                        text-align: left;
                        margin-top: 8px;
                    }

                    .action-buttons {
                        flex-direction: column;
                    }

                    .btn-reorder,
                    .btn-track {
                        justify-content: center;
                    }
                }
            </style>

            <div class="order-container">
                <!-- Back Button -->
                <a href="{{ route('orders.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Back to Orders
                </a>

                <!-- Breadcrumb -->
                <nav class="breadcrumb-custom">
                    <a href="{{ route('home') }}">Home</a> >
                    <a href="{{ route('orders.index') }}">My Orders</a> >
                    Order Details
                </nav>

                <!-- Alert Messages -->
                @if(session()->has("success"))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{session()->get("success")}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session()->has("error"))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        {{session()->get("error")}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Order Header -->
                <div class="order-header">
                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                        <div>
                            <div class="order-number">
                                Order #{{ $orderData->order_number ?? str_pad($orderData->id, 6, '0', STR_PAD_LEFT) }}
                            </div>
                            <div class="order-date">
                                Placed on {{ $orderData->created_at->format('F j, Y \a\t g:i A') }}
                            </div>
                        </div>
                        <span class="status-badge status-{{ strtolower($orderData->payment_status ?? $orderData->status ?? 'processing') }}">
                            {{ ucfirst($orderData->payment_status ?? $orderData->status ?? 'Processing') }}
                        </span>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="order-section">
                    <h3 class="section-title">Order Items</h3>
                    @foreach($orderData->items as $item)
                        <div class="order-item">
                            <img src="{{ $item->product->image ?? '/images/placeholder.png' }}"
                                 alt="{{ $item->product->name ?? $item->product->title ?? 'Product' }}"
                                 class="item-image">
                            <div class="item-details">
                                <div class="item-name">
                                    {{ $item->product->name ?? $item->product->title ?? $item->product->description ?? 'Product' }}
                                </div>
                                <div class="item-price">
                                    ${{ number_format($item->price, 2) }} each
                                </div>
                                <div class="item-quantity">
                                    Quantity: {{ $item->quantity }}
                                </div>
                            </div>
                            <div class="item-total">
                                ${{ number_format($item->total, 2) }}
                            </div>
                        </div>
                    @endforeach

                    <!-- Order Summary -->
                    <div class="order-summary mt-3">
                        <div class="summary-row">
                            <span class="summary-label">Subtotal:</span>
                            <span class="summary-value">${{ number_format($orderData->subtotal ?? $orderData->total_price, 2) }}</span>
                        </div>
                        @if(isset($orderData->shipping_cost) && $orderData->shipping_cost > 0)
                            <div class="summary-row">
                                <span class="summary-label">Shipping:</span>
                                <span class="summary-value">${{ number_format($orderData->shipping_cost, 2) }}</span>
                            </div>
                        @endif
                        @if(isset($orderData->tax) && $orderData->tax > 0)
                            <div class="summary-row">
                                <span class="summary-label">Tax:</span>
                                <span class="summary-value">${{ number_format($orderData->tax, 2) }}</span>
                            </div>
                        @endif
                        <div class="summary-row">
                            <span class="summary-label">Total:</span>
                            <span class="summary-value">${{ number_format($orderData->total ?? $orderData->total_price, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Shipping Information -->
                    <div class="col-md-6">
                        <div class="order-section">
                            <h3 class="section-title">Shipping Information</h3>
                            <div class="address-block">
                                <div class="address-title">Delivery Address</div>
                                <div class="address-text">
                                    {{ $orderData->shipping_name ?? auth()->user()->name }}<br>
                                    {{ $orderData->shipping_address ?? $orderData->address }}<br>
                                    {{ $orderData->shipping_city ?? 'Phnom Penh' }}, {{ $orderData->shipping_state ?? 'Cambodia' }} {{ $orderData->shipping_zip ?? $orderData->pincode }}<br>
                                    Phone: {{ $orderData->shipping_phone ?? $orderData->phone }}
                                </div>
                            </div>

                            @if(in_array(strtolower($orderData->payment_status ?? $orderData->status ?? 'processing'), ['shipped', 'delivered']))
                                <div class="tracking-info">
                                    <div class="tracking-title">
                                        <i class="fas fa-truck"></i>
                                        Tracking Information
                                    </div>
                                    <div class="tracking-number">
                                        {{ $orderData->tracking_number ?? 'TRK' . strtoupper(substr(md5($orderData->id), 0, 10)) }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="col-md-6">
                        <div class="order-section">
                            <h3 class="section-title">Payment Information</h3>
                            <div class="address-block">
                                <div class="address-title">Billing Address</div>
                                <div class="address-text">
                                    {{ $orderData->billing_name ?? auth()->user()->name }}<br>
                                    {{ $orderData->billing_address ?? $orderData->address }}<br>
                                    {{ $orderData->billing_city ?? 'Phnom Penh' }}, {{ $orderData->billing_state ?? 'Cambodia' }} {{ $orderData->billing_zip ?? $orderData->pincode }}<br>
                                    Phone: {{ $orderData->billing_phone ?? $orderData->phone }}
                                </div>
                            </div>

                            <div class="address-block">
                                <div class="address-title">Payment Method</div>
                                <div class="address-text">
                                    {{ $orderData->payment_method ?? 'Credit Card' }}
                                    @if(isset($orderData->card_last_four))
                                        <br>**** **** **** {{ $orderData->card_last_four }}
                                    @endif
                                    @if($orderData->payment_id)
                                        <br><small class="text-muted">Payment ID: {{ Str::limit($orderData->payment_id, 20) }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </section>
    </main>
@endsection
