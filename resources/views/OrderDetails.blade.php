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
                    color: #007bff;
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
                    color: #6c757d;
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
                    background: #cce5ff;
                    color: #0066cc;
                    border: 1px solid #99d6ff;
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
                    background: #000;
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
                <!-- Breadcrumb -->
                <nav class="breadcrumb-custom">
                    <a href="#">Home</a> >
                    <a href="#">My Account</a> >
                    <a href="#">Orders</a> >
                    <span class="text-dark">Order #{{$order->order_number ?? 'ORD-2024-001'}}</span>
                </nav>

                <!-- Alert Messages -->
                @if(session()->has("success"))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{session()->get("success")}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Order Header -->
                <div class="order-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="order-number">Order #{{$order->order_number ?? 'ORD-2024-001'}}</div>
                            <div class="order-date">Placed on {{$order->created_at ? $order->created_at->format('F j, Y') : 'January 15, 2024'}}</div>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            <span class="status-badge status-{{strtolower($order->status ?? 'processing')}}">
                                {{ucfirst($order->status ?? 'Processing')}}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Left Column - Order Items -->
                    <div class="col-lg-8">
                        <!-- Order Items Section -->
                        <div class="order-section">
                            <h3 class="section-title">
                                <i class="fas fa-box me-2"></i>
                                Order Items
                            </h3>

                            @if(isset($order->items) && $order->items->count() > 0)
                                @foreach($order->items as $item)
                                    <div class="order-item">
                                        <img src="{{$item->product->image ?? 'https://via.placeholder.com/80x80?text=Product'}}"
                                             alt="{{$item->product->title ?? 'Product'}}"
                                             class="item-image">
                                        <div class="item-details">
                                            <div class="item-name">{{$item->product->title ?? 'Sample Product Name'}}</div>
                                            <div class="item-price">${{number_format($item->price ?? 9.00, 2)}} each</div>
                                            <div class="item-quantity">Quantity: {{$item->quantity ?? 1}}</div>
                                        </div>
                                        <div class="item-total">
                                            ${{number_format(($item->price ?? 9.00) * ($item->quantity ?? 1), 2)}}
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Sample items for demonstration -->
                                <div class="order-item">
                                    <img src="https://via.placeholder.com/80x80?text=Product" alt="Sample Product" class="item-image">
                                    <div class="item-details">
                                        <div class="item-name">Hatomugi Beauty Mask 7 Sheets</div>
                                        <div class="item-price">$9.00 each</div>
                                        <div class="item-quantity">Quantity: 2</div>
                                    </div>
                                    <div class="item-total">$18.00</div>
                                </div>
                                <div class="order-item">
                                    <img src="https://via.placeholder.com/80x80?text=Product" alt="Sample Product 2" class="item-image">
                                    <div class="item-details">
                                        <div class="item-name">Vitamin C Serum</div>
                                        <div class="item-price">$25.00 each</div>
                                        <div class="item-quantity">Quantity: 1</div>
                                    </div>
                                    <div class="item-total">$25.00</div>
                                </div>
                            @endif
                        </div>

                        <!-- Shipping Information -->
                        <div class="order-section">
                            <h3 class="section-title">
                                <i class="fas fa-shipping-fast me-2"></i>
                                Shipping Information
                            </h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="address-block">
                                        <div class="address-title">Shipping Address</div>
                                        <p class="address-text">
                                            {{$order->shipping_name ?? 'John Doe'}}<br>
                                            {{$order->shipping_address ?? '123 Main Street'}}<br>
                                            {{$order->shipping_city ?? 'Phnom Penh'}}, {{$order->shipping_state ?? 'Cambodia'}} {{$order->shipping_zip ?? '12000'}}<br>
                                            {{$order->shipping_phone ?? '+855 12 345 678'}}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-block">
                                        <div class="address-title">Billing Address</div>
                                        <p class="address-text">
                                            {{$order->billing_name ?? 'John Doe'}}<br>
                                            {{$order->billing_address ?? '123 Main Street'}}<br>
                                            {{$order->billing_city ?? 'Phnom Penh'}}, {{$order->billing_state ?? 'Cambodia'}} {{$order->billing_zip ?? '12000'}}<br>
                                            {{$order->billing_phone ?? '+855 12 345 678'}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if(isset($order->tracking_number))
                                <div class="tracking-info">
                                    <div class="tracking-title">
                                        <i class="fas fa-truck me-2"></i>
                                        Tracking Information
                                    </div>
                                    <div class="tracking-number">{{$order->tracking_number}}</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right Column - Order Summary -->
                    <div class="col-lg-4">
                        <div class="order-section">
                            <h3 class="section-title">
                                <i class="fas fa-receipt me-2"></i>
                                Order Summary
                            </h3>

                            <div class="order-summary">
                                <div class="summary-row">
                                    <span class="summary-label">Subtotal:</span>
                                    <span class="summary-value">${{number_format($order->subtotal ?? 43.00, 2)}}</span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-label">Shipping:</span>
                                    <span class="summary-value">${{number_format($order->shipping_cost ?? 5.00, 2)}}</span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-label">Tax:</span>
                                    <span class="summary-value">${{number_format($order->tax ?? 3.84, 2)}}</span>
                                </div>
                                @if(isset($order->discount) && $order->discount > 0)
                                    <div class="summary-row">
                                        <span class="summary-label">Discount:</span>
                                        <span class="summary-value text-success">-${{number_format($order->discount, 2)}}</span>
                                    </div>
                                @endif
                                <div class="summary-row">
                                    <span class="summary-label">Total:</span>
                                    <span class="summary-value">${{number_format($order->total ?? 51.84, 2)}}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="order-section">
                            <h3 class="section-title">
                                <i class="fas fa-credit-card me-2"></i>
                                Payment Method
                            </h3>

                            <div class="d-flex align-items-center">
                                <i class="fas fa-credit-card me-3 text-muted"></i>
                                <div>
                                    <div class="fw-semibold">{{$order->payment_method ?? 'Credit Card'}}</div>
                                    <div class="text-muted small">****{{$order->card_last_four ?? '1234'}}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="order-section">
                            <div class="action-buttons">
                                <a href="#" class="btn-reorder">
                                    <i class="fas fa-redo"></i>
                                    Reorder
                                </a>
                                @if(isset($order->tracking_number))
                                    <a href="#" class="btn-track">
                                        <i class="fas fa-truck"></i>
                                        Track Order
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
