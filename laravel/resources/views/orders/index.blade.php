{{-- resources/views/orders/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Pesanan</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($order->order_status) }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">Lihat Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
