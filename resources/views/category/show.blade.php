@extends('layouts.app')

@section('title', $category->name . ' | Picklymart')

@section('content')
<div class="container">
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
        <a href="{{ route('categories.all') }}">All categories</a><span class="sep">/</span>
        "{{ $category->name }}"
    </nav>

    <div class="catalog-grid">
        <aside>
            <div class="filter-panel">
                <div class="f-title">Categories</div>
                <div class="f-body" style="padding:6px 0">
                    <a href="{{ route('categories.all') }}" style="display:flex;gap:8px;padding:10px 18px;font-size:14px">‹ All categories</a>
                    <a href="{{ route('category.show', $category->slug) }}" style="display:flex;gap:8px;padding:10px 18px;font-size:14px;font-weight:700;color:#1f4b3f">‹ {{ $category->name }}</a>
                    @foreach ($category->children as $child)
                        <a href="{{ route('category.show', $child->slug) }}" style="display:flex;gap:8px;padding:10px 18px 10px 34px;font-size:13.5px;color:#6b7280">{{ $child->name }}</a>
                    @endforeach
                </div>
            </div>

            <form method="GET" action="{{ route('category.show', $category->slug) }}">
                <div class="filter-panel">
                    <div class="f-title">Price range</div>
                    <div class="f-body">
                        <label for="min_price">Min price (৳)</label>
                        <input type="number" id="min_price" name="min_price" min="0" step="1" value="{{ request('min_price') }}" placeholder="0">
                        <label for="max_price">Max price (৳)</label>
                        <input type="number" id="max_price" name="max_price" min="0" step="1" value="{{ request('max_price') }}" placeholder="10000">
                        <button class="btn-apply" type="submit">Apply Filter</button>
                    </div>
                </div>
            </form>
        </aside>

        <div>
            <div class="catalog-toolbar">
                <h1 class="page-title" style="margin:0">{{ $category->name }}</h1>
                <form method="GET" action="{{ route('category.show', $category->slug) }}">
                    @foreach (['min_price' => request('min_price'), 'max_price' => request('max_price')] as $k => $v)
                        @if ($v !== null)<input type="hidden" name="{{ $k }}" value="{{ $v }}">@endif
                    @endforeach
                    <select name="sort" onchange="this.form.submit()" aria-label="Sort by">
                        <option value="" {{ request('sort') === '' || !request('sort') ? 'selected' : '' }}>Sort by</option>
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest first</option>
                        <option value="price_low_high" {{ request('sort') === 'price_low_high' ? 'selected' : '' }}>Price: low to high</option>
                        <option value="price_high_low" {{ request('sort') === 'price_high_low' ? 'selected' : '' }}>Price: high to low</option>
                        <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                        <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                    </select>
                </form>
            </div>

            <div class="catalog-products">
                @forelse ($products as $product)
                    @include('partials.product-card', ['product' => $product])
                @empty
                    <div class="empty-note">No products found in this category yet.</div>
                @endforelse
            </div>

            <div class="pagination">{{ $products->links() }}</div>
        </div>
    </div>
</div>
@endsection
