@extends('layouts.app')

@section('title', 'Order Confirmed | Picklymart')

@section('content')
<div class="container order-success">
    <div class="tick">✓</div>
    <h1>Thank you! Your order has been placed.</h1>
    <p class="code">Your order code is <b>{{ $order->code }}</b> — we will contact you at {{ $order->phone }} to confirm delivery.</p>

    <div class="panel" style="text-align:left;max-width:640px;margin:0 auto 24px">
        <h3>Order Summary — {{ $order->code }}</h3>
        @foreach ($order->items as $item)
            <div class="row" style="display:flex;justify-content:space-between;font-size:14px;padding:6px 0;border-bottom:1px dashed #eef1ee">
                <span>{{ \Illuminate\Support\Str::limit($item->product_name, 40) }} × {{ $item->quantity }}</span>
                <span>৳{{ number_format($item->price * $item->quantity, 2) }}</span>
            </div>
        @endforeach
        <div class="row" style="display:flex;justify-content:space-between;font-weight:800;font-size:17px;padding-top:12px">
            <span>Total ({{ strtoupper(str_replace('_', ' ', $order->payment_method)) }})</span>
            <span>৳{{ number_format($order->total, 2) }}</span>
        </div>
    </div>

    <a class="btn btn-green" href="{{ route('home') }}">Back to Home</a>
    @auth
        <a class="btn btn-outline" href="{{ route('orders.index') }}" style="margin-left:10px">View My Orders</a>
    @endauth
</div>
@endsection
