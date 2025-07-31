@extends("layouts.default")
@section("title","beloved-Home")
@section("content")
    <main class="container">
        <section>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                        <div class="card p-2 shadow-sm">
                            <a href="{{route('products.details', $product->slug)}}">
                                <img src="{{$product->image}}" class="card-img-top" alt="{{$product->title}}">
                            </a>
                            <div class="card-body">
                                <a href="{{route('products.details', $product->slug)}}" class="card-title text-decoration-none">
                                    {{$product->title}}
                                </a>
                                <span class="text-success fw-bold">$ {{$product->price}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{$products->links()}}
            </div>
        </section>
    </main>
@endsection
