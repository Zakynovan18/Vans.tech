<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = Auth::id();
        $productId = $request->product_id;
        $quantity = $request->quantity;

        // Check if the product is already in the cart
        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // If it exists, just update the quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // If it does not exist, create a new cart item
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        // Redirect back to the previous page with a success message
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function viewCart()
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang sedang login

        // Mengambil item di keranjang milik pengguna saat ini
        $cartItems = Cart::where('user_id', $userId)
            ->with('product') // Pastikan relasi ke model Product sudah didefinisikan
            ->get();

        // Menghitung total harga
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Biaya pengiriman tetap (misalnya Rp. 26.000)
        $shippingCost = 26000;

        // Jumlah total pembayaran
        $grandTotal = $totalPrice + $shippingCost;

        // Mengirim data ke view
        return view('cart.view', compact('cartItems', 'totalPrice', 'shippingCost', 'grandTotal'));
    }
}
