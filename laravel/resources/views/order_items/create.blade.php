<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item to Order</title>
</head>
<body>
    <h1>Add Item to Order: {{ $order->id }}</h1>
    <h2>Product: {{ $product->name }}</h2>

    @if (session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('order.items.store', $order->id) }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" min="1" required>
        <button type="submit">Add Item</ button>
    </form>
</body>
</html>