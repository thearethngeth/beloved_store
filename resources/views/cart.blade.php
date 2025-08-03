@extends("layouts.default")
@section("title","beloved-Cart")
@section("content")
    <main class="container mt-4">
        <section>
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <h2>🛒 Your Shopping Cart</h2>
                </div>
            </div>

            <!-- Success/Error Messages -->
            <div class="row">
                @if(session()->has("success"))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{session()->get("success")}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session("error"))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{session("error")}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
            </div>

            @if($cartItems->count() > 0)
                <!-- Cart Items -->
                <div class="row">
                    @foreach($cartItems as $cart)
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <img src="{{$cart->image}}" class="img-fluid rounded-start h-100" style="object-fit: cover;" alt="{{$cart->title}}">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body d-flex flex-column h-100">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h5 class="card-title">
                                                    <a href="{{route('products.details', $cart->slug)}}" class="text-decoration-none">
                                                        {{$cart->title}}
                                                    </a>
                                                </h5>
                                                <!-- Remove Single Item -->
                                                <form method="POST" action="{{route('cart.remove', $cart->product_id)}}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Remove one item">
                                                        ❌
                                                    </button>
                                                </form>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <p class="card-text mb-1">
                                                        <strong>Price:</strong> ${{number_format($cart->price, 2)}}
                                                    </p>
                                                    <p class="card-text mb-1">
                                                        <strong>Quantity:</strong> {{$cart->quantity}}
                                                    </p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="card-text mb-1">
                                                        <strong>Subtotal:</strong> ${{number_format($cart->subtotal, 2)}}
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Quantity Controls -->
                                            <div class="mt-auto pt-2">
                                                <div class="d-flex align-items-center gap-2">
                                                    <!-- Remove One -->
                                                    @if($cart->quantity > 1)
                                                        <form method="POST" action="{{route('cart.remove', $cart->product_id)}}" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="quantity" value="1">
                                                            <button type="submit" class="btn btn-sm btn-outline-secondary">-</button>
                                                        </form>
                                                    @endif

                                                    <span class="mx-2">{{$cart->quantity}}</span>

                                                    <!-- Add One -->
                                                    <a href="{{route('cart.add', $cart->product_id)}}" class="btn btn-sm btn-outline-secondary">+</a>

                                                    <!-- Remove All of This Item -->
                                                    <form method="POST" action="{{route('cart.remove', $cart->product_id)}}" class="d-inline ms-3">
                                                        @csrf
                                                        <input type="hidden" name="quantity" value="{{$cart->quantity}}">
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">Remove All</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Cart Summary -->
                <div class="row mt-4">
                    <div class="col-md-8">
                        <!-- Pagination -->
                        {{$cartItems->links()}}
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Cart Summary</h5>
                                <div class="d-flex justify-content-between">
                                    <span>Total Items:</span>
                                    <span>{{$cartItems->sum('quantity')}}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <strong>Total Amount:</strong>
                                    <strong>${{number_format($total, 2)}}</strong>
                                </div>
                                <hr>
                                <div class="d-grid gap-2">
                                    <a class="btn btn-success" href="{{route('checkout.show')}}">
                                        💳 Proceed to Checkout
                                    </a>
                                    <form method="POST" action="{{route('cart.clear')}}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger w-100"
                                                onclick="return confirm('Are you sure you want to clear your cart?')">
                                            🗑️ Clear Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="card">
                            <div class="card-body py-5">
                                <h3>🛒 Your cart is empty</h3>
                                <p class="text-muted">Looks like you haven't added anything to your cart yet.</p>
                                <a href="{{route('home')}}" class="btn btn-primary">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </main>
@endsection
