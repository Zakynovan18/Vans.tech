<!-- resources/views/products/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Tambah Produk</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Input untuk Nama Produk -->
        <div class="form-group">
            <label for="name">Nama Produk</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <!-- Input untuk Deskripsi -->
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <!-- Input untuk Harga -->
        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" name="price" id="price" class="form-control" required>
        </div>

        <!-- Input untuk Stok -->
        <div class="form-group">
            <label for="stock">Stok</label>
            <input type="number" name="stock" id="stock" class="form-control" required>
        </div>

        <!-- Input untuk Gambar Produk -->
        <div class="form-group">
            <label for="image">Gambar Produk</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Produk</button>
    </form>
@endsection
