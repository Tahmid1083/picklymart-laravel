@extends('layouts.app')

@section('title', 'Shopping Cart | Picklymart')

@section('content')
<div class="container">
    <nav class="breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span> Shopping Cart</nav>
    <h1 class="page-title">Shopping Cart</h1>

    @if ($items->isEmpty())
        <div class="panel" style="text-align:center;padding:60px 20px">
            <p style="font-size:40px;margin-bottom:12px">🛒</p>
            <p style="color:#6b7280;margin-bottom:20px">Your cart is currently empty.</p>
            <a class="btn btn-green" href="{{ route('home') }}">Continue Shopping</a>
        </div>
    @else
        <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th><th>Price</th><th>Quantity</th><th>Total</th><th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $row)
                        <tr>
                            <td>
                                <a class="p" href="{{ route('product.show', $row['product']->slug) }}">
                                    <img src="{{ $row['product']->image_url }}" alt="">
                                    <span>{{ $row['product']->name }}</span>
                                </a>
                            </td>
                            <td>৳{{ number_format($row['price'], 2) }}</td>
                            <td>
                                <span class="qty-stepper">
                                    <input type="number" name="quantity[{{ $row['product']->id }}]" value="{{ $row['quantity'] }}" min="0" max="999" style="width:64px">
                                </span>
                            </td>
                            <td><b>৳{{ number_format($row['line'], 2) }}</b></td>
                            <td>
                                <a class="btn-remove" href="#" onclick="event.preventDefault();document.getElementById('rm-{{ $row['product']->id }}').submit();">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-outline" style="margin-top:14px">Update Cart</button>
        </form>

        @foreach ($items as $row)
            <form id="rm-{{ $row['product']->id }}" action="{{ route('cart.remove') }}" method="POST" style="display:none">@csrf
                <input type="hidden" name="product_id" value="{{ $row['product']->id }}">
            </form>
        @endforeach

        <div class="cart-summary">
            <div class="row"><span>Items</span><span>{{ \App\Services\Cart::count() }}</span></div>
            <div class="row"><span>Shipping</span><span>Calculated at delivery</span></div>
            <div class="row total"><span>Total</span><span>৳{{ number_format($total, 2) }}</span></div>
            <a class="btn-checkout" href="{{ route('checkout.index') }}">Proceed to Checkout →</a>
            <a href="{{ route('home') }}" style="display:block;text-align:center;margin-top:12px;font-size:13.5px;color:#6b7280">Continue shopping</a>
        </div>
        <div style="clear:both"></div>
    @endif
</div>
@endsection
