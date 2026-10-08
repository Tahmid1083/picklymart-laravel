@extends('layouts.app')

@section('title', $product->name . ' | Picklymart')
@section('meta_description', $product->short_description)

@php $avg = $product->averageRating(); @endphp

@section('content')
<div class="container">
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
        <a href="{{ route('category.show', $product->category->slug) }}">{{ $product->category->name }}</a><span class="sep">/</span>
        {{ \Illuminate\Support\Str::limit($product->name, 40) }}
    </nav>

    <div class="pdp">
        <div class="pdp-gallery">
            <div class="main-img">
                <img id="pdpMainImg" src="{{ $product->image_url }}" alt="{{ $product->name }}">
            </div>
            <div class="pdp-thumbs">
                <img src="{{ $product->image_url }}" data-full="{{ $product->image_url }}" class="active" alt="{{ $product->name }}">
            </div>
        </div>

        <div>
            <h1>{{ $product->name }}</h1>

            <div class="pdp-meta">
                <span class="stars">{{ str_repeat('★', (int) round($avg)) }}<span class="off">{{ str_repeat('★', 5 - (int) round($avg)) }}</span></span>
                <span>({{ $product->reviews->count() }} reviews)</span>
            </div>

            <div class="pdp-links">
                <span>❓ Product Inquiry</span>
                @auth
                    <form action="{{ route('wishlist.toggle') }}" method="POST">@csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit">♡ Add to wishlist</button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login') }}">♡ Add to wishlist</a>
                @endguest
            </div>

            <table class="meta">
                <tr><td>Brand</td><td>{{ $product->brand ?: 'Generic' }}</td></tr>
                <tr>
                    <td>{{ $product->is_inhouse ? 'Inhouse product' : 'Marketplace' }}</td>
                    <td><span class="chip">✉ Message Seller</span></td>
                </tr>
            </table>

            <div class="pdp-price-row">
                <span class="big">৳{{ number_format($product->display_price, 2) }}</span>
                <span class="per">/{{ $product->unit }}</span>
                @if ($product->special_price && $product->special_price < $product->price)
                    <span class="old">৳{{ number_format($product->price, 2) }}</span>
                @endif
            </div>

            <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="qty-row">
                    <span class="lbl">Quantity</span>
                    <span class="qty-stepper">
                        <button type="button" data-step="minus">−</button>
                        <input type="number" id="qtyInput" name="quantity" value="1" min="1" max="{{ max($product->stock, 1) }}" data-price="{{ $product->display_price }}">
                        <button type="button" data-step="plus">+</button>
                    </span>
                    <span class="stock">({{ max($product->stock, 0) }} available)</span>
                </div>
                <div class="total-row">
                    <span class="lbl">Total Price</span>
                    <span class="val" id="totalPrice">৳{{ number_format($product->display_price, 2) }}</span>
                </div>
                <div class="pdp-actions">
                    <button type="submit" class="btn-cart">🛒 Add to cart</button>
                    <button type="submit" class="btn-buy" name="buy_now" value="1">🏷 Buy Now</button>
                </div>
            </form>

            <div class="refund-row">
                <span>↩ Refund</span>
                <span class="chip">🛡 30 Days Cash Back Guarantee</span>
                <a href="{{ route('policy.return') }}" style="color:#1f7a4d">View Policy</a>
            </div>

            <div class="share-row">
                <span style="color:#6b7280;font-size:13.5px">Share</span>
                <a class="s1" href="#" onclick="return false">f</a>
                <a class="s2" href="#" onclick="return false">t</a>
                <a class="s3" href="#" onclick="return false">in</a>
                <a class="s5" href="#" onclick="return false">w</a>
            </div>
        </div>
    </div>

    <div class="pdp-below">
        <aside class="side-products">
            <h4>Top Selling Products</h4>
            @forelse ($topSelling as $sp)
                <a class="side-p" href="{{ route('product.show', $sp->slug) }}">
                    <img src="{{ $sp->image_url }}" alt="">
                    <span>
                        <span class="n">{{ \Illuminate\Support\Str::limit($sp->name, 34) }}</span><br>
                        <span class="pr">৳{{ number_format($sp->display_price, 2) }}</span>
                    </span>
                </a>
            @empty
                <p style="color:#6b7280;font-size:13px">Nothing here yet.</p>
            @endforelse
        </aside>

        <div>
            <div class="panel" id="reviews">
                <h3>Reviews &amp; Ratings</h3>
                <div class="rating-box">
                    <span class="score">{{ number_format($avg, 1) }}</span>
                    <span>out of 5.0 <span class="stars">{{ str_repeat('★', (int) round($avg)) }}<span class="off">{{ str_repeat('★', 5 - (int) round($avg)) }}</span></span> ({{ $product->reviews->count() }} reviews)</span>
                    @auth
                        <button type="button" class="btn-rate" onclick="document.getElementById('reviewForm').style.display='block'">Rate this Product!</button>
                    @endauth
                    @guest
                        <a class="btn-rate" href="{{ route('login') }}">Rate this Product!</a>
                    @endguest
                </div>

                @auth
                    <form id="reviewForm" action="{{ route('product.review', $product) }}" method="POST" style="display:none;margin-top:18px">
                        @csrf
                        <div class="form-grid">
                            <div class="field">
                                <label for="rateSelect">Your rating <span>*</span></label>
                                <select id="rateSelect" name="rating" required>
                                    @for ($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}">{{ $i }} star{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="field">
                                <label for="comment">Your review <span>*</span></label>
                                <input id="comment" name="comment" type="text" placeholder="Share your experience..." required>
                            </div>
                        </div>
                        <button class="btn btn-green" style="margin-top:10px" type="submit">Submit Review</button>
                    </form>
                @endauth

                @forelse ($product->reviews as $review)
                    <div class="review-item">
                        <span class="who">{{ $review->user->name }}</span>
                        <span class="stars">{{ str_repeat('★', $review->rating) }}<span class="off">{{ str_repeat('★', 5 - $review->rating) }}</span></span>
                        <span class="when">{{ $review->created_at->format('d M, Y') }}</span>
                        <p>{{ $review->comment }}</p>
                    </div>
                @empty
                    <p class="no-reviews">There have been no reviews for this product yet.</p>
                @endforelse
            </div>

            <div class="panel">
                <h3>Description</h3>
                <div class="desc-content">
                    <h4>About this product</h4>
                    <p>{{ $product->short_description }}</p>
                    {!! $product->description !!}
                </div>
            </div>

            <div class="panel">
                <h3>Frequently Bought Products</h3>
                <div class="product-grid" style="grid-template-columns:repeat(4,1fr)">
                    @foreach ($frequentlyBought as $fb)
                        @include('partials.product-card', ['product' => $fb])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
