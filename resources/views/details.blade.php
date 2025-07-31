@extends("layouts.default")
@section("title","beloved-Home")
@section("content")
    <main class="container" style="max-width: 900px">
        <section>

            <style>
                .product-container {

                    background: #f8f9fa;
                    min-height: 100vh;
                    padding-top: 20px ;
                }

                .product-image {
                    height: 400px;
                    object-fit: cover;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                }

                .price-display {
                    font-size: 2rem;
                    font-weight: 700;
                }

                .quantity-controls {
                    border-radius: 25px;
                    overflow: hidden;
                    border: 1px solid #dee2e6;
                }

                .quantity-btn {
                    width: 40px;
                    height: 40px;
                    border: none;
                    background: white;
                    color: #6c757d;
                }

                .quantity-btn:hover {
                    background: #f8f9fa;
                }

                .quantity-input {
                    border: none;
                    width: 50px;
                    text-align: center;
                    font-weight: 500;
                }

                .rewards-bg {
                    background-color: #fce4ec !important;
                }

                .bottom-nav {
                    position: fixed;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    background: white;
                    border-top: 1px solid #dee2e6;
                    z-index: 1000;
                }

                .nav-item {
                    flex: 1;
                    text-align: center;
                    padding: 12px 8px;
                    text-decoration: none;
                    color: #6c757d;
                    font-size: 12px;
                }

                .nav-item.active {
                    color: #007bff;
                }

                .nav-item i {
                    font-size: 20px;
                    margin-bottom: 4px;
                }

                body {
                    padding-bottom: 80px;
                }
            </style>

            <div class="product-container">
                <div class="container" style="max-width: 500px;">

                    <!-- Alert Messages -->
                    @if(session()->has("success"))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            {{session()->get("success")}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if(session("error"))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            {{session("error")}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Product Card -->
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <!-- Product Image -->
                        <div class="product-image d-flex align-items-center justify-content-center">
                            @if($product->image)
                                <img src="{{$product->image}}" alt="{{$product->title}}" class="w-100 h-100" style="object-fit: cover;">
                            @else
                                <div class="text-white text-center">
                                    <i class="fas fa-image fa-3x mb-2"></i>
                                    <p>Product Image</p>
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="card-body p-4">
                            <!-- Product Title -->
                            <h1 class="h4 fw-semibold text-dark mb-4 lh-sm">{{$product->title}}</h1>

                            <!-- Price and Quantity Section -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="price-display text-dark">${{number_format($product->price ?? 0, 2)}}</div>

                                <!-- Quantity Controls -->
                                <div class="quantity-controls d-flex align-items-center">
                                    <button type="button" class="quantity-btn d-flex align-items-center justify-content-center" onclick="decreaseQuantity()">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" class="quantity-input form-control border-0 text-center" value="1" min="1" id="quantity">
                                    <button type="button" class="quantity-btn d-flex align-items-center justify-content-center" onclick="increaseQuantity()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- Product Description -->
                            @if($product->description)
                                <div class="mb-4">
                                    <p class="text-muted mb-0">{{$product->description}}</p>
                                </div>
                            @endif
                            <!-- Add to Cart Button -->
                            <form action="{{route('cart.add', $product->id)}}" method="GET" class="flex-grow-1">
                                <input type="hidden" name="quantity" id="hiddenQuantity" value="1">
                                <button type="submit" class="btn btn-danger w-100 rounded-3 fw-semibold py-3" style="font-size: 1.1rem;">
                                    Add to cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

