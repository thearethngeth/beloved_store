@extends("layouts.default")
@section("title","beloved-Cart")
@section("content")

    <style>
        /* Custom styles matching your design palette */
        body {
            background: linear-gradient(135deg, #fafafa 0%, #fce9c2 100%);
            min-height: 100vh;
        }

        .cart-hero {
            background: linear-gradient(135deg, #eb8abc, #d67aa8);
            color: white;
            padding: 50px 0;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .cart-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="cart-pattern" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23cart-pattern)"/></svg>') repeat;
            opacity: 0.3;
        }

        .cart-hero .container {
            position: relative;
            z-index: 1;
        }

        .cart-title {
            font-size: 2.2rem;
            font-weight: bold;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .cart-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1));
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .cart-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0;
        }

        .cart-item-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 6px 25px rgba(235, 138, 188, 0.15);
            margin-bottom: 25px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: white;
        }

        .cart-item-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(235, 138, 188, 0.25);
        }

        .cart-item-image {
            height: 180px;
            object-fit: cover;
            border-radius: 15px 0 0 15px;
            transition: transform 0.3s ease;
        }

        .cart-item-card:hover .cart-item-image {
            transform: scale(1.02);
        }

        .product-link {
            color: #333;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .product-link:hover {
            color: #eb8abc;
            text-decoration: none;
        }

        .price-info {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            border-radius: 15px;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #eb8abc;
        }

        .price-label {
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .price-value {
            font-size: 1rem;
            color: #333;
            font-weight: 600;
        }

        .subtotal-value {
            font-size: 1.2rem;
            color: #eb8abc;
            font-weight: bold;
        }

        .quantity-controls {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            border-radius: 15px;
            padding: 15px;
            border: 1px solid rgba(235, 138, 188, 0.1);
        }

        .quantity-btn {
            background: linear-gradient(135deg, #eb8abc, #d67aa8);
            border: none;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .quantity-btn:hover {
            background: linear-gradient(135deg, #d67aa8, #eb8abc);
            transform: scale(1.05);
            color: white;
            text-decoration: none;
        }

        .quantity-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .quantity-display {
            background: white;
            border: 2px solid #eb8abc;
            border-radius: 25px;
            padding: 8px 16px;
            font-weight: bold;
            color: #eb8abc;
            min-width: 50px;
            text-align: center;
            margin: 0 10px;
        }

        .remove-btn {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            background: linear-gradient(135deg, #c82333, #dc3545);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        }

        .remove-single-btn {
            background: none;
            border: 2px solid #dc3545;
            color: #dc3545;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            font-size: 1rem;
            position: absolute;
            top: 15px;
            right: 15px;
        }

        .remove-single-btn:hover {
            background: #dc3545;
            color: white;
            transform: scale(1.1);
        }

        .cart-summary-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(235, 138, 188, 0.2);
            background: linear-gradient(135deg, #ffffff, #fafafa);
            position: sticky;
            top: 20px;
        }

        .cart-summary-header {
            background: linear-gradient(135deg, #eb8abc, #d67aa8);
            color: white;
            border-radius: 20px 20px 0 0;
            padding: 20px;
            font-weight: 600;
            font-size: 1.2rem;
            text-align: center;
            border: none;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .summary-row:last-child {
            border-bottom: none;
            font-size: 1.1rem;
            font-weight: bold;
            color: #eb8abc;
            padding-top: 15px;
            border-top: 2px solid #eb8abc;
            margin-top: 10px;
        }

        .checkout-btn {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            border-radius: 25px;
            padding: 15px 25px;
            font-weight: 600;
            font-size: 1rem;
            color: white;
            text-decoration: none;
            display: block;
            text-align: center;
            transition: all 0.3s ease;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .checkout-btn:hover {
            background: linear-gradient(135deg, #20c997, #28a745);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
            color: white;
            text-decoration: none;
        }

        .clear-cart-btn {
            background: none;
            border: 2px solid #dc3545;
            color: #dc3545;
            border-radius: 25px;
            padding: 12px 25px;
            font-weight: 500;
            width: 100%;
            transition: all 0.3s ease;
        }

        .clear-cart-btn:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        .empty-cart-card {
            border: none;
            border-radius: 30px;
            box-shadow: 0 10px 40px rgba(235, 138, 188, 0.2);
            background: linear-gradient(135deg, #ffffff, #fafafa);
            text-align: center;
            padding: 40px 20px;
        }

        .empty-cart-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.7;
        }

        .continue-shopping-btn {
            background: linear-gradient(135deg, #eb8abc, #d67aa8);
            border: none;
            border-radius: 25px;
            padding: 15px 30px;
            font-weight: 600;
            color: white;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(235, 138, 188, 0.3);
        }

        .continue-shopping-btn:hover {
            background: linear-gradient(135deg, #d67aa8, #eb8abc);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(235, 138, 188, 0.4);
            color: white;
            text-decoration: none;
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 15px;
            padding: 15px 20px;
            margin-bottom: 25px;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(32, 201, 151, 0.1));
            border-left: 4px solid #28a745;
            color: #155724;
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.1), rgba(200, 35, 51, 0.1));
            border-left: 4px solid #dc3545;
            color: #721c24;
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin: 2rem 0;
        }

        .pagination .page-link {
            color: #eb8abc;
            background-color: white;
            border: 2px solid #eb8abc;
            border-radius: 50px;
            padding: 12px 18px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(235, 138, 188, 0.1);
        }

        .pagination .page-link:hover {
            color: white;
            background-color: #eb8abc;
            border-color: #eb8abc;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(235, 138, 188, 0.3);
        }

        .pagination .page-item.active .page-link {
            background-color: #eb8abc;
            border-color: #eb8abc;
            color: white;
            box-shadow: 0 4px 15px rgba(235, 138, 188, 0.4);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .cart-hero {
                padding: 30px 0;
            }

            .cart-title {
                font-size: 1.8rem;
                flex-direction: column;
                gap: 10px;
            }

            .cart-item-image {
                height: 150px;
                border-radius: 15px 15px 0 0;
            }

            .quantity-controls {
                text-align: center;
            }

            .remove-single-btn {
                position: relative;
                top: auto;
                right: auto;
                margin-top: 10px;
            }

            .cart-summary-card {
                position: relative;
                top: auto;
                margin-top: 30px;
            }
        }

        @media (max-width: 576px) {
            .cart-title {
                font-size: 1.6rem;
            }

            .price-info {
                padding: 10px;
            }

            .quantity-controls {
                padding: 10px;
            }
        }
    </style>

    <!-- Cart Hero Section -->
    <div class="cart-hero">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="cart-title">
                        <div class="cart-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 7h16l-1 10H5L4 7z"/>
                                <path d="M4 7L2 3H1"/>
                                <circle cx="9" cy="20" r="1" fill="currentColor"/>
                                <circle cx="20" cy="20" r="1" fill="currentColor"/>
                            </svg>
                        </div>
                        Your Shopping Cart
                    </h1>
                    <p class="cart-subtitle">Review your items and proceed to checkout</p>
                </div>
            </div>
        </div>
    </div>

    <main class="container">
        <section>
            <!-- Success/Error Messages -->
            @if(session()->has("success"))
                <div class="alert alert-success alert-dismissible fade show">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22,4 12,14.01 9,11.01"></polyline>
                    </svg>
                    {{session()->get("success")}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session("error"))
                <div class="alert alert-danger alert-dismissible fade show">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    {{session("error")}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($cartItems->count() > 0)
                <div class="row">
                    <!-- Cart Items -->
                    <div class="col-lg-8">
                        @foreach($cartItems as $cart)
                            <div class="cart-item-card position-relative">
                                <!-- Remove Single Item Button -->
                                <form method="POST" action="{{route('cart.remove', $cart->product_id)}}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="remove-single-btn" title="Remove one item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </form>

                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{$cart->image}}" class="cart-item-image w-100" alt="{{$cart->title}}">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body p-4">
                                            <h5 class="card-title mb-3">
                                                <a href="{{route('products.details', $cart->slug)}}" class="product-link">
                                                    {{$cart->title}}
                                                </a>
                                            </h5>

                                            <!-- Price Information -->
                                            <div class="price-info">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="price-label">Unit Price</div>
                                                        <div class="price-value">${{number_format($cart->price, 2)}}</div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="price-label">Quantity</div>
                                                        <div class="price-value">{{$cart->quantity}} items</div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="price-label">Subtotal</div>
                                                        <div class="subtotal-value">${{number_format($cart->subtotal, 2)}}</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Quantity Controls -->
                                            <div class="quantity-controls">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                                    <div class="d-flex align-items-center">
                                                        <!-- Decrease Quantity -->
                                                        @if($cart->quantity > 1)
                                                            <form method="POST" action="{{route('cart.remove', $cart->product_id)}}" class="d-inline">
                                                                @csrf
                                                                <input type="hidden" name="quantity" value="1">
                                                                <button type="submit" class="quantity-btn">
                                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button class="quantity-btn" disabled>
                                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                                </svg>
                                                            </button>
                                                        @endif

                                                        <span class="quantity-display">{{$cart->quantity}}</span>

                                                        <!-- Increase Quantity -->
                                                        <a href="{{route('cart.add', $cart->product_id)}}" class="quantity-btn">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                            </svg>
                                                        </a>
                                                    </div>

                                                    <!-- Remove All Button -->
                                                    <form method="POST" action="{{route('cart.remove', $cart->product_id)}}" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="quantity" value="{{$cart->quantity}}">
                                                        <button type="submit" class="remove-btn">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;">
                                                                <polyline points="3,6 5,6 21,6"></polyline>
                                                                <path d="m19,6v14a2,2 0 0,1 -2,2H7a2,2 0 0,1 -2,-2V6m3,0V4a2,2 0 0,1 2,-2h4a2,2 0 0,1 2,2v2"></path>
                                                            </svg>
                                                            Remove All
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{$cartItems->links()}}
                        </div>
                    </div>

                    <!-- Cart Summary -->
                    <div class="col-lg-4">
                        <div class="card cart-summary-card">
                            <div class="cart-summary-header">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                    <line x1="8" y1="21" x2="16" y2="21"></line>
                                    <line x1="12" y1="17" x2="12" y2="21"></line>
                                </svg>
                                Cart Summary
                            </div>
                            <div class="card-body p-4">
                                <div class="summary-row">
                                    <span>Total Items:</span>
                                    <span>{{$cartItems->sum('quantity')}} items</span>
                                </div>
                                <div class="summary-row">
                                    <span>Total Amount:</span>
                                    <span>${{number_format($total, 2)}}</span>
                                </div>

                                <div class="mt-4">
                                    <a class="checkout-btn" href="{{route('checkout.show')}}">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                            <line x1="1" y1="10" x2="23" y2="10"></line>
                                        </svg>
                                        Proceed to Checkout
                                    </a>

                                    <form method="POST" action="{{route('cart.clear')}}">
                                        @csrf
                                        <button type="submit" class="clear-cart-btn"
                                                onclick="return confirm('Are you sure you want to clear your cart?')">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;">
                                                <polyline points="3,6 5,6 21,6"></polyline>
                                                <path d="m19,6v14a2,2 0 0,1 -2,2H7a2,2 0 0,1 -2,-2V6m3,0V4a2,2 0 0,1 2,-2h4a2,2 0 0,1 2,2v2"></path>
                                            </svg>
                                            Clear Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="empty-cart-card">
                            <div class="empty-cart-icon">
                                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color: #eb8abc;">
                                    <path d="M4 7h16l-1 10H5L4 7z"/>
                                    <path d="M4 7L2 3H1"/>
                                    <circle cx="9" cy="20" r="1" fill="currentColor"/>
                                    <circle cx="20" cy="20" r="1" fill="currentColor"/>
                                    <line x1="8" y1="11" x2="16" y2="11" stroke-dasharray="2,2" opacity="0.5"/>
                                </svg>
                            </div>
                            <h3 style="color: #eb8abc; margin-bottom: 15px;">Your cart is empty</h3>
                            <p class="text-muted mb-0">Looks like you haven't added anything to your cart yet.</p>
                            <p class="text-muted">Start shopping and discover amazing products!</p>
                            <a href="{{route('home')}}" class="continue-shopping-btn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9,22 9,12 15,12 15,22"></polyline>
                                </svg>
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </main>

@endsection
