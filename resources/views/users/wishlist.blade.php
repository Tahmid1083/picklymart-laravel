@extends('layouts.app')

@section('title', 'My Wishlist | Picklymart')

@section('content')
<div class="container">
    <nav class="breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span> My Wishlist</nav>
    <h1 class="page-title">My Wishlist</h1>

    <div class="product-grid cols-5" style="padding-bottom:40px">
        @forelse ($products as $product)
            @include('partials.product-card', ['product' => $product])
        @empty
            <div class="empty-note" style="grid-column:1/-1">Your wishlist is empty. Browse the <a href="{{ route('home') }}" style="color:#1f7a4d;font-weight:600">latest products</a>.</div>
        @endforelse
    </div>
</div>
@endsection
