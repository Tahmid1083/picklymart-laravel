@extends('layouts.app')

@section('title', 'Order History | Picklymart')

@section('content')
<div class="container">
    <nav class="breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span> Order History</nav>
    <h1 class="page-title">Order History</h1>

    <div class="account-grid">
        <aside class="account-menu">
            <a class="active" href="{{ route('orders.index') }}">📦 Order History</a>
            <a href="{{ route('wishlist.index') }}">♡ My Wishlist</a>
            <a href="{{ route('cart.index') }}">🛒 My Cart</a>
            <a href="{{ route('contact') }}">✉ Contact Support</a>
        </aside>

        <div style="padding-bottom:40px">
            @forelse ($orders as $order)
                <div class="order-row">
                    <div>
                        <div class="code">{{ $order->code }}</div>
                        <div class="muted">Placed {{ $order->created_at->format('d M, Y') }} · {{ $order->items->count() }} item(s)</div>
                    </div>
                    <span class="status {{ $order->status }}">{{ $order->status }}</span>
                    <div style="font-weight:800">৳{{ number_format($order->total, 2) }}</div>
                </div>
                @foreach ($order->items as $item)
                    <div style="display:flex;justify-content:space-between;font-size:13.5px;color:#6b7280;padding:4px 18px 10px;border-bottom:1px dashed #eef1ee">
                        <span>{{ \Illuminate\Support\Str::limit($item->product_name, 46) }} × {{ $item->quantity }}</span>
                        <span>৳{{ number_format($item->price * $item->quantity, 2) }}</span>
                    </div>
                @endforeach
            @empty
                <div class="panel" style="text-align:center;padding:50px">
                    <p style="color:#6b7280;margin-bottom:16px">You haven't placed any orders yet.</p>
                    <a class="btn btn-green" href="{{ route('home') }}">Start Shopping</a>
                </div>
            @endforelse

            <div class="pagination">{{ $orders->links() }}</div>
        </div>
    </div>
</div>
@endsection
