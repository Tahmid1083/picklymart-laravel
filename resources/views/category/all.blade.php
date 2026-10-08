@extends('layouts.app')

@section('title', 'All Categories | Picklymart')

@section('content')
<div class="container">
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a><span class="sep">/</span> All categories
    </nav>
    <h1 class="page-title">All Categories</h1>

    <div class="catalog-products" style="margin-bottom:40px">
        @forelse ($categories as $cat)
            <div class="p-card">
                <a class="p-thumb" href="{{ route('category.show', $cat->slug) }}">
                    <img src="{{ asset('images/icons/' . ($cat->icon ?: 'placeholder.svg')) }}" alt="{{ $cat->name }}" style="width:80px;margin:20px auto;display:block">
                </a>
                <div class="p-body">
                    <a class="p-name" href="{{ route('category.show', $cat->slug) }}">{{ $cat->name }}</a>
                    <div class="p-price" style="font-size:13px;color:#6b7280">{{ $cat->products()->count() }} products</div>
                </div>
            </div>
        @empty
            <div class="empty-note">No categories found.</div>
        @endforelse
    </div>
</div>
@endsection
