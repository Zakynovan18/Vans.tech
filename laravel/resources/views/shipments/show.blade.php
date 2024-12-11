{{-- resources/views/shipments/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Pengiriman Pesanan #{{ $shipment->order->id }}</h2>
        <p>Status Pengiriman: {{ ucfirst($shipment->status) }}</p>
        <p>Alamat Pengiriman: {{ $shipment->shipping_address }}</p>
        <p>Nomor Pelacakan: {{ $shipment->tracking_number ?? 'Belum tersedia' }}</p>

        @if($shipment->status == 'processing')
            <form action="{{ route('shipments.update-status', $shipment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="status">Pilih Status:</label>
                    <select id="status" name="status" class="form-control">
                        <option value="shipped">Dikirim</option>
                        <option value="delivered">Terkirim</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tracking_number">Nomor Pelacakan:</label>
                    <input type="text" id="tracking_number" name="tracking_number" class="form-control">
                </div>
                <button type="submit" class="btn btn-success mt-3">Perbarui Status Pengiriman</button>
            </form>
        @endif
    </div>
@endsection
