<?php

// app/Http/Controllers/ProductController.php
// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function landing()
    {
        $products = Product::all();
        return view('landing', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    
    public function store(Request $request)
    {
    // Validasi data
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048' // Validasi gambar
    ]);

    // Simpan file gambar jika ada
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
    }

    // Simpan data produk
    $product = Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'image_url' => $imagePath ? Storage::url($imagePath) : null, // Simpan URL gambar
    ]);

    return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        // Validate data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048' // Image validation
        ]);
    
        // Find the product
        $product = Product::findOrFail($id);
    
        // If there's a new image, delete the old one and save the new one
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image_url) {
                // Remove the old image file from storage
                Storage::disk('public')->delete(str_replace('/storage/', '', $product->image_url));
            }
    
            // Save the new image
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image_url = Storage::url($imagePath);
        }
    
        // Update the other product data
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            // Don't need to set image_url here because it's already set above
        ]);
    
        // Redirect with success message
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }
    

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
