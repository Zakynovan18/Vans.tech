<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    // Menampilkan form untuk menambahkan item ke order
    public function create($orderId, $productId)
    {
        $order = Order::findOrFail($orderId);
        $product = Product::findOrFail($productId);
        
        return view('order_items.create', compact('order', 'product'));
    }

    // Menyimpan item ke order
    public function store(Request $request, $orderId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'product_id' => 'required|exists:products,id',
        ]);

        $order = Order::findOrFail($orderId);
        $productId = $request->input('product_id');

        // Cek apakah order sudah dalam status yang benar
        if ($order->order_status !== 'cart') {
            return redirect()->back()->with('error', 'Order is not in cart status.');
        }

        // Cek apakah item sudah ada di order
        $orderItem = OrderItem::where('order_id', $order->id)
            ->where('product_id', $productId)
            ->first();

        if ($orderItem) {
            // Jika item sudah ada, tambahkan kuantitas
            $orderItem->quantity += $request->quantity;
            $orderItem->save();
        } else {
            // Jika item belum ada, buat item baru
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $request->quantity,
                'price' => Product::findOrFail($productId)->price,
            ]);
        }

        // Update total_amount di order
        $this->updateOrderTotal($order);

        return redirect()->route('order.items.index', $order->id)->with('success', 'Item added to order successfully!');
    }

    protected function updateOrderTotal(Order $order)
    {
        $total = $order->items()->sum(DB::raw('price * quantity'));
        $order->total_amount = $total;
        $order->save();
    }

    public function index($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);
        return view('order_items.index', compact('order'));
    }
}