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
            padding: 6px 16px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
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
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .card-body {
            padding: 1rem;
        }

        .product-info {
            flex-grow: 1;
        }

        /* Pagination custom styles */
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

        /* Active page styling */
        .pagination .page-item.active .page-link {
            background-color: #eb8abc;
            border-color: #eb8abc;
            color: white;
            box-shadow: 0 4px 15px rgba(235, 138, 188, 0.4);
            transform: scale(1.1);
        }

        /* Disabled state */
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

        /* First/Last page special styling */
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

        /* Add icons for prev/next */
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

        /* Responsive design */
        @media (max-width: 576px) {
            .pagination .page-link {
                padding: 10px 14px;
                font-size: 0.9rem;
                min-width: 44px;
            }

            .pagination {
                gap: 4px;
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

        /* Mobile responsive */
        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 0;
            }
            .hero-title {
                font-size: 2rem;
            }
            .product-img {
                height: 180px;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.8rem;
            }
            .hero-subtitle {
                font-size: 1rem;
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
        <div class="row">
            <div class="col-12">
                <form method="GET" action="{{ route('home') }}" class="d-flex flex-wrap gap-3 align-items-center">
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
    </div>

    <!-- Search result -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="text-muted">
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
            <div class="row">
                @foreach($products as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card product-card h-100">
                            <a href="{{route('products.details', $product->slug)}}">
                                <img src="{{$product->image}}"
                                     class="product-img"
                                     alt="{{$product->title}}">
                            </a>
                            <div class="card-body d-flex flex-column">
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
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{$products->links()}}
            </div>

        </section>
    </main>

@endsection
