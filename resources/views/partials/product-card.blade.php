<div class="p-card">
    <div class="p-badges">
        @if ($product->is_todays_deal)<span class="p-badge hot">Hot</span>@endif
        @if ($product->is_new)<span class="p-badge new">New</span>@endif
        @if ($product->special_price && $product->special_price < $product->price)
            @php $off = round((1 - $product->special_price / $product->price) * 100); @endphp
            @if ($off > 0)<span class="p-badge off">-{{ $off }}%</span>@endif
        @endif
    </div>
    <a class="p-thumb" href="{{ route('product.show', $product->slug) }}">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy">
    </a>
    <div class="p-body">
        <a class="p-name" href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
        <div class="p-price">
            @if ($product->special_price && $product->special_price < $product->price)
                <span class="old">৳{{ number_format($product->price, 2) }}</span>
            @endif
            ৳{{ number_format($product->display_price, 2) }}
        </div>
    </div>
    <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="quantity" value="1">
        <button type="submit" class="p-cart-btn">Add to cart</button>
    </form>
</div>
