@extends('layouts.app')

@section('title', $q ? "Search: {$q} | Picklymart" : 'Search | Picklymart')

@section('content')
<div class="container">
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a><span class="sep">/</span> Search
    </nav>

    <div class="catalog-grid">
        @include('partials.category-sidebar')

        <div>
            <div class="catalog-toolbar">
                <h1 class="page-title" style="margin:0">Search Results {{ $q ? 'for "' . e($q) . '"' : '' }}</h1>
                <form method="GET" action="{{ route('search') }}">
                    <input class="input" type="text" name="q" value="{{ $q }}" placeholder="Search products..." style="width:280px">
                </form>
            </div>

            <div class="catalog-products">
                @forelse ($products as $product)
                    @include('partials.product-card', ['product' => $product])
                @empty
                    <div class="empty-note">No products matched your search. Try a different keyword.</div>
                @endforelse
            </div>

            <div class="pagination">{{ $products->links() }}</div>
        </div>
    </div>
</div>
@endsection
