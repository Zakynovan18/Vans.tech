@extends('layouts.guest')

@section('isi')
<link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    <section class="py-5" style="background-color: #ffffff; color: rgb(0, 0, 0);">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <img class="card-img-top"
                                src="{{ $product->image_url ? asset($product->image_url) : 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg' }}"
                                alt="{{ $product->name }}" />
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">{{ $product->name }}</h5>
                                    <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                                    <p class="fw-bold">Rp{{ number_format($product->price, 0) }}</p>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a href="{{ route('products.show', $product->id) }}"
                                        class="btn btn-success mt-auto">View</a>
                                    <a href="https://wa.me/qr/EGGKTXTWHMYCP1" class="btn btn-danger mt-auto">Buy</a>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="number" name="quantity" value="1" min="1" required>
                                        <button type="submit" class="btn btn-warning mt-auto">Add to Cart</button>
                                    </form>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        
    </section>
@endsection
