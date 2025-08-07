@extends("layouts.default")
@section("title","beloved-Home")
@section("content")
    <main class="container" style="max-width: 1200px;">
        <section>
            <style>
                .product-container {
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

                .product-image-container {
                    background: #f8f9fa;
                    border-radius: 12px;
                    overflow: hidden;
                    aspect-ratio: 1;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border: 1px solid #e9ecef;
                }

                .product-image {
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                }

                .product-category {
                    background: #f8f9fa;
                    color: #6c757d;
                    padding: 6px 12px;
                    border-radius: 16px;
                    font-size: 12px;
                    font-weight: 500;
                    display: inline-block;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                }

                .product-price {
                    font-size: 2.5rem;
                    font-weight: 700;
                    color: #333;
                }


                .delivery-badge {
                    background: #e8f5e8;
                    border: 1px solid #c8e6c9;
                    border-radius: 8px;
                    padding: 12px 16px;
                }

                .delivery-badge .delivery-title {
                    color: #2e7d32;
                    font-weight: 600;
                    display: flex;
                    align-items: center;
                    gap: 8px;
                }

                .delivery-badge .delivery-subtitle {
                    color: #4caf50;
                    font-size: 14px;
                    margin: 0;
                }

                .quantity-controls {
                    border: 1px solid #dee2e6;
                    border-radius: 8px;
                    overflow: hidden;
                    display: inline-flex;
                    align-items: center;
                }

                .quantity-btn {
                    width: 40px;
                    height: 40px;
                    border: none;
                    background: #f8f9fa;
                    color: #6c757d;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    transition: background-color 0.2s;
                }

                .quantity-btn:hover {
                    background: #e9ecef;
                }

                .quantity-input {
                    border: none;
                    width: 60px;
                    height: 40px;
                    text-align: center;
                    font-weight: 500;
                    background: white;
                }

                .quantity-input:focus {
                    outline: none;
                    box-shadow: none;
                }

                .btn-add-cart {
                    background: #ff90df;
                    color: white;
                    border: none;
                    border-radius: 8px;
                    padding: 12px 24px;
                    font-weight: 600;
                    font-size: 16px;
                    width: 100%;
                    transition: background-color 0.2s;
                }

                .btn-add-cart:hover {
                    background: #333;
                    color: white;
                }

                @media (max-width: 768px) {
                    .product-layout {
                        gap: 2rem;
                    }

                    .product-price {
                        font-size: 2rem;
                    }
                }
            </style>

            <div class="product-container">
                <!-- Breadcrumb -->
                <nav class="breadcrumb-custom">
                    <a href="#">Home</a> >
                    <a href="#">Products</a> >
                    <a href="#">Skincare</a> >
                    <span class="text-dark">{{$product->title}}</span>
                </nav>

                <!-- Alert Messages -->
                @if(session()->has("success"))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{session()->get("success")}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session("error"))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        {{session("error")}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Product Layout -->
                <div class="row product-layout">
                    <!-- Product Image -->
                    <div class="col-lg-6 col-md-6">
                        <div class="product-image-container">
                            @if($product->image)
                                <img src="{{$product->image}}" alt="{{$product->title}}" class="product-image">
                            @else
                                <div class="text-center text-muted">
                                    <i class="fas fa-image fa-4x mb-3"></i>
                                    <p class="mb-0">Product Image</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="col-lg-6 col-md-6">
                        <div class="product-info">
                            <!-- Category Badge -->
                            <span class="product-category">Skincare</span>

                            <!-- Product Title -->
                            <h1 class="product-title mb-4">{{$product->title}}</h1>

                            <!-- Price -->
                            <div class="product-price mb-3">${{number_format($product->price ?? 0, 2)}}</div>


                            <!-- Delivery Info -->
                            <div class="delivery-badge mb-4">
                                <div class="delivery-title">
                                    <i class="fas fa-shipping-fast"></i>
                                    Fast delivery
                                </div>
                                <p class="delivery-subtitle">Ready to ship immediately</p>
                            </div>

                            <!-- Product Description -->
                            @if($product->description)
                                <div class="mb-4">
                                    <p class="text-muted">{{$product->description}}</p>
                                </div>
                            @endif

                            <!-- Quantity Section -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold mb-3">Quantity:</label>
                                <div class="quantity-controls">
                                    <button type="button" class="quantity-btn" onclick="decreaseQuantity()">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" class="quantity-input" value="1" min="1" id="quantity">
                                    <button type="button" class="quantity-btn" onclick="increaseQuantity()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-3">
                                <form action="{{route('cart.add', $product->id)}}" method="GET">
                                    <input type="hidden" name="quantity" id="hiddenQuantity" value="1">
                                    <button type="submit" class="btn-add-cart">
                                        <i class="fas fa-shopping-cart me-2"></i>
                                        Add to Cart
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function increaseQuantity() {
                    const quantityInput = document.getElementById('quantity');
                    const hiddenQuantity = document.getElementById('hiddenQuantity');
                    let currentValue = parseInt(quantityInput.value);
                    quantityInput.value = currentValue + 1;
                    hiddenQuantity.value = currentValue + 1;
                }

                function decreaseQuantity() {
                    const quantityInput = document.getElementById('quantity');
                    const hiddenQuantity = document.getElementById('hiddenQuantity');
                    let currentValue = parseInt(quantityInput.value);
                    if (currentValue > 1) {
                        quantityInput.value = currentValue - 1;
                        hiddenQuantity.value = currentValue - 1;
                    }
                }

                // Update hidden quantity when input changes
                document.getElementById('quantity').addEventListener('change', function() {
                    document.getElementById('hiddenQuantity').value = this.value;
                });
            </script>
        </section>
    </main>
@endsection
