@extends("layouts.default")
@section("title","beloved-Home")
@section("content")
    <main class="container">

        <section>
            <div class="row">
                @if(session()->has("success"))
                    <div class="alert alert-success">
                        {{session()->get("success")}}
                    </div>
                @endif
                @if(session("error"))
                    <div class="alert alert-danger">
                        {{session("error")}}
                    </div>
                @endif
                @foreach($cartItems as $cart)
                    <div class="col-12">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{$cart->image}}" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="{{route('products.details', $cart->slug)}}" class="card-title text-decoration-none">
                                                {{$cart->title}}
                                            </a></h5>
                                        <p class="card-text">Price: ${{$cart->price}} | Quantity: {{$cart->quantity}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div>
                {{$cartItems->links()}}
            </div>
            <div>
                <a class="btn btn-success" href="{{route('checkout.show')}}">Checkout</a>
            </div>
        </section>
    </main>
@endsection
