@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">{{ $product->name }}</h1>

        <div class="row">
            <div class="col-md-6">
                @if ($product->image_url)
                    <img src="{{ $product->image_url }}" alt="Product Image" class="img-fluid rounded shadow">
                @else
                    <img src="https://via.placeholder.com/400" alt="Placeholder Image" class="img-fluid rounded shadow">
                @endif
            </div>
            <div class="col-md-6">
                <p class="lead"><strong>Description:</strong> {{ $product->description }}</p>
                <p><strong>Price:</strong> <span class="text-success">Rp.{{ number_format($product->price, 2) }}</span></p>
                <p><strong>Stock:</strong> {{ $product->stock }} available</p>
                <div class="mt-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
