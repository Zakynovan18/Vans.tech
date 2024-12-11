@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Cart</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cartItems->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->product->description }}</td>
                        <td>${{ number_format($item->product->price, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" required>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </td>
                        <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                                
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Total: ${{ number_format($cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        }), 2) }}</h3>

        
    @endif
</div>
@endsection