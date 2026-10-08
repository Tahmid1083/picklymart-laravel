@extends('layouts.admin')

@section('title', $product->exists ? 'Edit Product' : 'Add Product')

@section('content')
<div class="admin-toolbar">
    <h2 style="font-size:17px;font-weight:800">{{ $product->exists ? 'Edit Product' : 'Add Product' }}</h2>
    <a class="btn btn-outline" href="{{ route('admin.products.index') }}">← Back to list</a>
</div>

<form class="form-card" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST">
    @csrf
    @if ($product->exists) @method('PATCH') @endif

    <div class="form-grid">
        <div class="field full">
            <label>Product Name <span>*</span></label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
        </div>
        <div class="field">
            <label>Category <span>*</span></label>
            <select name="category_id" required>
                <option value="">— Select —</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label>Seller</label>
            <select name="seller_id">
                <option value="">— None (Inhouse) —</option>
                @foreach ($sellers as $seller)
                    <option value="{{ $seller->id }}" {{ old('seller_id', $product->seller_id) == $seller->id ? 'selected' : '' }}>{{ $seller->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label>Brand</label>
            <input type="text" name="brand" value="{{ old('brand', $product->brand) }}">
        </div>
        <div class="field">
            <label>Unit</label>
            <input type="text" name="unit" value="{{ old('unit', $product->unit ?: 'Piece') }}">
        </div>
        <div class="field">
            <label>Price (৳) <span>*</span></label>
            <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $product->price) }}" required>
        </div>
        <div class="field">
            <label>Special Price (৳)</label>
            <input type="number" step="0.01" min="0" name="special_price" value="{{ old('special_price', $product->special_price) }}">
        </div>
        <div class="field">
            <label>Stock <span>*</span></label>
            <input type="number" min="0" name="stock" value="{{ old('stock', $product->stock ?? 100) }}" required>
        </div>
        <div class="field">
            <label>Thumbnail path <small>(e.g. products/arduino-uno.svg)</small></label>
            <input type="text" name="thumbnail" value="{{ old('thumbnail', $product->thumbnail ?: 'products/placeholder.svg') }}">
        </div>
        <div class="field full">
            <label>Short Description</label>
            <input type="text" name="short_description" value="{{ old('short_description', $product->short_description) }}">
        </div>
        <div class="field full">
            <label>Description (HTML allowed)</label>
            <textarea name="description" rows="7">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="field full">
            <label>Flags</label>
            <div class="checkbox-row">
                <label><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}> Featured</label>
                <label><input type="checkbox" name="is_best_selling" value="1" {{ old('is_best_selling', $product->is_best_selling) ? 'checked' : '' }}> Best Selling</label>
                <label><input type="checkbox" name="is_new" value="1" {{ old('is_new', $product->is_new) ? 'checked' : '' }}> New</label>
                <label><input type="checkbox" name="is_todays_deal" value="1" {{ old('is_todays_deal', $product->is_todays_deal) ? 'checked' : '' }}> Today's Deal</label>
                <label><input type="checkbox" name="is_inhouse" value="1" {{ old('is_inhouse', $product->exists ? $product->is_inhouse : true) ? 'checked' : '' }}> Inhouse</label>
                <label><input type="checkbox" name="status" value="1" {{ old('status', $product->exists ? $product->status : true) ? 'checked' : '' }}> Active</label>
            </div>
        </div>
    </div>

    <button class="btn btn-green" type="submit" style="margin-top:16px;padding:12px 26px">{{ $product->exists ? 'Update Product' : 'Create Product' }}</button>
</form>
@endsection
