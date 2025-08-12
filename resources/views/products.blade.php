@extends("layouts.default")
@section("title","beloved-Home")
@section("content")

    <style>
        /* Custom styles using your color palette */
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

        .product-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(235, 138, 188, 0.15);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(235, 138, 188, 0.25);
        }

        .product-img {
            height: 220px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-img {
            transform: scale(1.05);
        }

        .product-title {
            color: #333;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .btn-primary{
            background: linear-gradient(135deg, #eb8abc, #d67aa8);
            border: none;
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #d67aa8, #eb8abc);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(235, 138, 188, 0.4);
        }

        .btn-cart {
            background: linear-gradient(135deg, #eb8abc, #d67aa8);
            border: none;
            border-radius: 20px;
            color: white;
            padding: 8px 16px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            text-align: center;
        }

        .btn-cart:hover {
            background: linear-gradient(135deg, #d67aa8, #eb8abc);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(235, 138, 188, 0.4);
            text-decoration: none;
        }

        .product-title:hover {
            color: #eb8abc;
            text-decoration: none;
        }

        .product-price {
            color: #eb8abc;
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 12px;
        }

        .card-body {
            padding: 1rem;
            display: flex;
            flex-direction: column;
        }

        .product-info {
            flex-grow: 1;
        }

        /* Search and Filter Section */
        .search-filter-section {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            backdrop-filter: blur(10px);
        }

        .form-control, .form-select {
            border-radius: 25px;
            border: 2px solid #f0f0f0;
            padding: 10px 15px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #eb8abc;
            box-shadow: 0 0 0 0.2rem rgba(235, 138, 188, 0.25);
        }

        /* Enhanced Pagination Styles */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin: 2rem 0;
        }

        .pagination .page-item {
            margin: 0;
        }

        .pagination .page-link {
            color: #eb8abc;
            background-color: white;
            border: 2px solid #eb8abc;
            margin: 0;
            border-radius: 50px;
            padding: 12px 18px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            min-width: 50px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(235, 138, 188, 0.1);
        }

        .pagination .page-link:hover {
            color: white;
            background-color: #eb8abc;
            border-color: #eb8abc;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(235, 138, 188, 0.3);
        }

        .pagination .page-link:focus {
            box-shadow: 0 0 0 3px rgba(235, 138, 188, 0.2);
            outline: none;
        }

        .pagination .page-item.active .page-link {
            background-color: #eb8abc;
            border-color: #eb8abc;
            color: white;
            box-shadow: 0 4px 15px rgba(235, 138, 188, 0.4);
            transform: scale(1.1);
        }

        .pagination .page-item.disabled .page-link {
            color: #ccc;
            border-color: #e9ecef;
            background-color: #f8f9fa;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .pagination .page-item.disabled .page-link:hover {
            transform: none;
            box-shadow: 0 2px 8px rgba(235, 138, 188, 0.1);
        }

        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            background: linear-gradient(135deg, #eb8abc 0%, #d67aa8 100%);
            color: white;
            border-color: transparent;
            font-weight: 600;
        }

        .pagination .page-item:first-child .page-link:hover,
        .pagination .page-item:last-child .page-link:hover {
            background: linear-gradient(135deg, #d67aa8 0%, #eb8abc 100%);
            transform: translateY(-2px) scale(1.05);
        }

        .pagination .page-item:first-child .page-link::before {
            content: "‹";
            font-size: 1.2em;
            margin-right: 4px;
        }

        .pagination .page-item:last-child .page-link::after {
            content: "›";
            font-size: 1.2em;
            margin-left: 4px;
        }

        /* ========== MOBILE RESPONSIVE STYLES ========== */

        /* Large tablets and small desktops */
        @media (max-width: 991px) {
            .product-img {
                height: 200px;
            }

            .hero-title {
                font-size: 2.2rem;
            }
        }

        /* Tablets */
        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 0;
                margin-bottom: 30px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .product-img {
                height: 180px;
            }

            .search-filter-section {
                padding: 15px;
                margin-bottom: 15px;
            }

            .form-control, .form-select {
                margin-bottom: 10px;
            }

            /* Stack search form elements on tablets */
            .search-form {
                flex-direction: column;
                gap: 15px !important;
            }

            .search-form .flex-grow-1,
            .search-form .form-select {
                width: 100% !important;
            }

            .btn-primary,
            .btn-outline-secondary {
                width: 100%;
                justify-content: center;
            }
        }

        /* Mobile phones */
        @media (max-width: 576px) {
            /* Hero section adjustments */
            .hero-section {
                padding: 30px 0;
                margin-bottom: 20px;
            }

            .hero-title {
                font-size: 1.8rem;
                margin-bottom: 10px;
            }

            .hero-subtitle {
                font-size: 0.95rem;
            }

            /* Product grid - 2 columns on mobile */
            .product-col-mobile {
                width: 50%;
                padding: 8px;
            }

            /* Product card adjustments */
            .product-card {
                border-radius: 12px;
                margin-bottom: 0;
            }

            .product-img {
                height: 140px;
                border-radius: 12px 12px 0 0;
            }

            .card-body {
                padding: 12px;
            }

            .product-title {
                font-size: 0.9rem;
                margin-bottom: 8px;
                line-height: 1.2;
                /* Limit to 2 lines */
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .product-price {
                font-size: 1rem;
                margin-bottom: 10px;
            }

            .btn-cart {
                padding: 8px 12px;
                font-size: 0.8rem;
                border-radius: 15px;
                gap: 4px;
            }

            .btn-cart svg {
                width: 16px;
                height: 16px;
            }

            /* Search section */
            .search-filter-section {
                padding: 12px;
                border-radius: 12px;
            }

            .form-control, .form-select {
                padding: 8px 12px;
                font-size: 0.9rem;
                border-radius: 20px;
            }

            /* Pagination mobile styles */
            .pagination {
                gap: 4px;
                margin: 1.5rem 0;
            }

            .pagination .page-link {
                padding: 8px 12px;
                font-size: 0.85rem;
                min-width: 40px;
            }

            .pagination .page-item:first-child .page-link::before,
            .pagination .page-item:last-child .page-link::after {
                font-size: 1em;
                margin: 0;
            }

            /* Container padding adjustments */
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }

            /* Results text */
            .results-text {
                font-size: 0.9rem;
                margin-bottom: 15px;
            }

            /* Alert messages */
            .alert {
                font-size: 0.9rem;
                padding: 10px 15px;
                border-radius: 10px;
            }
        }

        /* Extra small phones */
        @media (max-width: 375px) {
            .product-img {
                height: 120px;
            }

            .hero-title {
                font-size: 1.6rem;
            }

            .card-body {
                padding: 10px;
            }

            .btn-cart {
                font-size: 0.75rem;
                padding: 6px 10px;
            }
        }

        /* Loading animation for page changes */
        .pagination .page-link.loading {
            position: relative;
            color: transparent;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom mobile grid */
        @media (max-width: 576px) {
            .mobile-grid {
                display: flex;
                flex-wrap: wrap;
                margin: 0 -8px;
            }
        }
    </style>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="hero-title">Our Products</h1>
                    <p class="hero-subtitle">Discover our carefully curated collection</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Message display -->
    @if(session('success'))
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Search and Filter Section -->
    <div class="container mb-4">
        <div class="search-filter-section">
            <form method="GET" action="{{ route('home') }}" class="d-flex flex-wrap gap-3 align-items-center search-form">
                <!-- Search Input -->
                <div class="flex-grow-1">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="🔍 Search products..."
                           value="{{ request('search') }}">
                </div>

                <!-- Sort Dropdown -->
                <select name="sort" class="form-select" style="width: auto;">
                    <option value="">Sort by</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                </select>

                <!-- Search Button -->
                <button type="submit" class="btn btn-primary">Filter</button>

                <!-- Clear Button -->
                @if(request('search') || request('sort'))
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">Clear</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Search result -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="text-muted results-text">
                    Showing {{ $products->count() }} of {{ $products->total() }} products
                    @if(request('search'))
                        for "{{ request('search') }}"
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <main class="container">
        <section>
            <!-- Desktop/Tablet Grid (Bootstrap) -->
            <div class="row d-none d-sm-flex">
                @foreach($products as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card product-card">
                            <a href="{{route('products.details', $product->slug)}}">
                                <img src="{{$product->image}}"
                                     class="product-img"
                                     alt="{{$product->title}}">
                            </a>
                            <div class="card-body">
                                <div class="product-info">
                                    <a href="{{route('products.details', $product->slug)}}"
                                       class="product-title">
                                        {{$product->title}}
                                    </a>
                                    <div class="product-price">${{$product->price}}</div>
                                </div>

                                <!-- Add to Cart Button -->
                                <div class="mt-auto">
                                    @auth
                                        <a href="{{ route('cart.add', $product->id) }}"
                                           class="btn-cart">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 7h16l-1 10H5L4 7z"/>
                                                <path d="M4 7L2 3H1"/>
                                                <circle cx="9" cy="20" r="1" fill="currentColor"/>
                                                <circle cx="20" cy="20" r="1" fill="currentColor"/>
                                            </svg>
                                            Add to Cart
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}"
                                           class="btn-cart">
                                            🛒 Login to Add
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Mobile Grid (Custom) -->
            <div class="mobile-grid d-sm-none">
                @foreach($products as $product)
                    <div class="product-col-mobile">
                        <div class="card product-card">
                            <a href="{{route('products.details', $product->slug)}}">
                                <img src="{{$product->image}}"
                                     class="product-img"
                                     alt="{{$product->title}}">
                            </a>
                            <div class="card-body">
                                <div class="product-info">
                                    <a href="{{route('products.details', $product->slug)}}"
                                       class="product-title">
                                        {{$product->title}}
                                    </a>
                                    <div class="product-price">${{$product->price}}</div>
                                </div>

                                <!-- Add to Cart Button -->
                                <div class="mt-auto">
                                    @auth
                                        <a href="{{ route('cart.add', $product->id) }}"
                                           class="btn-cart">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 7h16l-1 10H5L4 7z"/>
                                                <path d="M4 7L2 3H1"/>
                                                <circle cx="9" cy="20" r="1" fill="currentColor"/>
                                                <circle cx="20" cy="20" r="1" fill="currentColor"/>
                                            </svg>
                                            Add to Cart
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}"
                                           class="btn-cart">
                                            🛒 Login
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{$products->links()}}
            </div>

        </section>
    </main>

@endsection
