@extends('layouts.app')

@section('title', 'Checkout | Picklymart')

@section('content')
<div class="container">
    <nav class="breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span> Checkout</nav>
    <h1 class="page-title">Checkout</h1>

    <div class="checkout-grid">
        <form class="form-panel panel" action="{{ route('checkout.place') }}" method="POST">
            @csrf
            <h3>Billing &amp; Shipping Details</h3>
            <div class="form-grid">
                <div class="field">
                    <label>Full Name <span>*</span></label>
                    <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" required>
                    @error('customer_name')<div class="err">{{ $message }}</div>@enderror
                </div>
                <div class="field">
                    <label>Email <span>*</span></label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                    @error('email')<div class="err">{{ $message }}</div>@enderror
                </div>
                <div class="field">
                    <label>Phone <span>*</span></label>
                    <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" required>
                    @error('phone')<div class="err">{{ $message }}</div>@enderror
                </div>
                <div class="field">
                    <label>City <span>*</span></label>
                    <input type="text" name="city" value="{{ old('city', auth()->user()->city ?? '') }}" required>
                    @error('city')<div class="err">{{ $message }}</div>@enderror
                </div>
                <div class="field full">
                    <label>Full Address <span>*</span></label>
                    <textarea name="address" rows="2" required>{{ old('address', auth()->user()->address ?? '') }}</textarea>
                    @error('address')<div class="err">{{ $message }}</div>@enderror
                </div>
                <div class="field full">
                    <label>Order Notes</label>
                    <textarea name="notes" rows="2" placeholder="Any special instructions...">{{ old('notes') }}</textarea>
                </div>
                <div class="field full">
                    <label>Payment Method <span>*</span></label>
                    <div class="pay-options">
                        <label><input type="radio" name="payment_method" value="cash_on_delivery" checked> Cash on Delivery</label>
                        <label><input type="radio" name="payment_method" value="bkash"> bKash</label>
                        <label><input type="radio" name="payment_method" value="nagad"> Nagad</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-green" type="submit" style="margin-top:18px;padding:13px 30px">Place Order</button>
        </form>

        <div class="mini-cart">
            <h3>Order Summary</h3>
            @foreach ($items as $row)
                <div class="row">
                    <span>{{ \Illuminate\Support\Str::limit($row['product']->name, 30) }} × {{ $row['quantity'] }}</span>
                    <span>৳{{ number_format($row['line'], 2) }}</span>
                </div>
            @endforeach
            <div class="row total"><span>Total</span><span>৳{{ number_format($total, 2) }}</span></div>
        </div>
    </div>
</div>
@endsection
