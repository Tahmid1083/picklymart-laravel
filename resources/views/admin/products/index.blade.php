@extends('layouts.admin')

@section('title', 'Products')

@section('content')
<div class="admin-toolbar">
    <h2 style="font-size:17px;font-weight:800">Products ({{ $products->total() }})</h2>
    <a class="btn btn-green" href="{{ route('admin.products.create') }}">+ Add Product</a>
</div>

<table class="admin-table">
    <thead>
        <tr><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Flags</th><th>Status</th><th style="width:170px">Actions</th></tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <td><img class="mini" src="{{ $product->image_url }}" alt=""></td>
                <td><b>{{ \Illuminate\Support\Str::limit($product->name, 46) }}</b></td>
                <td>{{ $product->category?->name }}</td>
                <td>৳{{ number_format($product->display_price, 2) }}</td>
                <td>{{ $product->stock }}</td>
                <td style="font-size:11.5px">
                    @if ($product->is_featured) <span class="chip">Featured</span>@endif
                    @if ($product->is_best_selling) <span class="chip">Best</span>@endif
                    @if ($product->is_new) <span class="chip">New</span>@endif
                    @if ($product->is_todays_deal) <span class="chip">Deal</span>@endif
                </td>
                <td><span class="status {{ $product->status ? 'delivered' : 'cancelled' }}">{{ $product->status ? 'active' : 'disabled' }}</span></td>
                <td>
                    <a class="btn btn-outline btn-sm" href="{{ route('admin.products.edit', $product) }}">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this product?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="8" style="text-align:center;color:#6b7280;padding:30px">No products found.</td></tr>
        @endforelse
    </tbody>
</table>

<div class="pagination">{{ $products->links() }}</div>
@endsection
