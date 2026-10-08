@extends('layouts.app')

@section('title', 'Picklymart | Ecommerce Website')

@section('content')
<div class="hero-area">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-banner">
                <a href="{{ route('wholesale') }}">
                    <img src="{{ asset('images/banners/hero-wholesale.svg') }}" alt="Wholesale Program — Bulk Pricing on Thermal & POS Paper Rolls">
                </a>
            </div>

            <aside class="deal-panel">
                <div class="deal-head">
                    <h3>Todays Deal</h3>
                    <span class="badge-hot">Hot</span>
                </div>
                @forelse ($todaysDeals as $deal)
                    <a class="deal-item" href="{{ route('product.show', $deal->slug) }}">
                        <img src="{{ $deal->image_url }}" alt="{{ $deal->name }}">
                        <span>
                            <span class="d-name">{{ \Illuminate\Support\Str::limit($deal->name, 42) }}</span><br>
                            <span class="d-price">৳{{ number_format($deal->display_price, 2) }}</span>
                        </span>
                    </a>
                @empty
                    <p class="muted" style="font-size:13px;color:#6b7280">No deals today. Check back soon!</p>
                @endforelse
            </aside>
        </div>
    </div>
</div>

{{-- Featured Products --}}
<section class="section" data-carousel>
    <div class="container">
        <div class="section-head">
            <h3>Featured Products</h3>
            <div class="carousel-arrows">
                <button type="button" data-dir="prev">‹</button>
                <button type="button" data-dir="next">›</button>
            </div>
        </div>
        <div class="carousel-track">
            @foreach ($featured as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>

{{-- Best Selling --}}
<section class="section" data-carousel>
    <div class="container">
        <div class="section-head">
            <h3>Best Selling</h3>
            <div class="carousel-arrows">
                <button type="button" data-dir="prev">‹</button>
                <button type="button" data-dir="next">›</button>
            </div>
        </div>
        <div class="carousel-track">
            @foreach ($bestSelling as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>

{{-- New Products --}}
<section class="section">
    <div class="container">
        <div class="section-head">
            <h3>New Products</h3>
            <a class="section-link" href="{{ route('search') }}">View All ›</a>
        </div>
        <div class="product-grid cols-5">
            @foreach ($newProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>

{{-- Category showcase rows --}}
<section class="section">
    <div class="container">
        @php
            $showcaseImages = [
                'robotics-kits-boards' => 'https://upload.wikimedia.org/wikipedia/commons/3/38/Arduino_Uno_-_R3.jpg',
                'robotics-accessories' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=720&q=85',
                'electronic-components-sensors' => 'https://upload.wikimedia.org/wikipedia/commons/b/b5/SparkFun_Weather_Shield_13956-01.jpg',
            ];
        @endphp
        <div class="showcase-row">
            @foreach ($showcaseCategories as $showCat)
                <div class="showcase-cat">
                    <div class="bubble">
                        <img src="{{ $showcaseImages[$showCat->slug] ?? $showCat->products->first()?->image_url ?? asset('images/products/placeholder.svg') }}" alt="{{ $showCat->name }}">
                    </div>
                    <h4>{{ $showCat->name }}</h4>
                    <a class="btn-view-all" href="{{ route('category.show', $showCat->slug) }}">View All Category</a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Promo banner --}}
<section class="promo-section">
    <div class="container">
        <div class="promo-box">
            <img src="{{ asset('images/banners/promo-pos-paper.svg') }}" alt="Premium Quality BPA Free POS Paper">
            <div class="product-grid" style="grid-template-columns:repeat(4,1fr)">
                @foreach ($promoProducts as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Top Sellers --}}
<section class="sellers-band">
    <div class="container">
        <div class="section-head">
            <h3>Top Sellers</h3>
            <a class="section-link" href="{{ route('categories.all') }}">View All Sellers ›</a>
        </div>
        <div class="sellers-grid">
            @foreach ($sellers as $seller)
                <div class="seller-card">
                    <img src="{{ asset('images/' . ($seller->logo ?: 'sellers/seller-1.svg')) }}" alt="{{ $seller->name }}">
                    <div>
                        <h4>{{ $seller->name }}</h4>
                        <p class="muted">{{ $seller->tagline }} · (0 reviews)</p>
                        <a class="btn-visit" href="{{ route('search') }}">Visit Store ›</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
