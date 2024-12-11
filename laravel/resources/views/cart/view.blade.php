@extends('layouts.app') <!-- Adjust this based on your layout -->

@section('content')
<div class="container">
    <h1>Your Cart</h1>

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
                        <td>Rp{{ number_format($item->product->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        <td>
                            <!-- Add buttons for updating and removing items -->
                            
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                            <button type="" class="btn btn-success" href="">Buy</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Total: Rp.{{ number_format($cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        }), 2) }}</h3>

        
    @endif
</div>
@endsection