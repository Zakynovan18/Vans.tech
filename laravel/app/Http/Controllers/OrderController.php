<?php

// app/Http/Controllers/OrderController.php
// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index() {

        $orders = Order::all();
        
        return view('orders.index', compact('orders'));
    }

    public function createOrder(Request $request)
    {
        $order = Order::create([
            'user_id' => $request->user()->id,
            'total_amount' => $request->total_amount,
            'order_status' => 'pending',
        ]);

        foreach ($request->items as $item) {
            $product = Product::findOrFail($item['product_id']);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);

            // Update stok produk
            $product->decrement('stock', $item['quantity']);
        }

        return response()->json(['message' => 'Order created successfully', 'order' => $order]);
    }

    public function uploadPaymentProof(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['payment_proof' => $request->payment_proof, 'order_status' => 'paid']);

        return response()->json(['message' => 'Payment proof uploaded', 'order' => $order]);
    }
}
