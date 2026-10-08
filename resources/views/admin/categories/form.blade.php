@extends('layouts.admin')

@section('title', $category->exists ? 'Edit Category' : 'Add Category')

@section('content')
<div class="admin-toolbar">
    <h2 style="font-size:17px;font-weight:800">{{ $category->exists ? 'Edit Category' : 'Add Category' }}</h2>
    <a class="btn btn-outline" href="{{ route('admin.categories.index') }}">← Back to list</a>
</div>

<form class="form-card" action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST">
    @csrf
    @if ($category->exists) @method('PATCH') @endif

    <div class="form-grid">
        <div class="field">
            <label>Name <span>*</span></label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" required>
        </div>
        <div class="field">
            <label>Parent Category</label>
            <select name="parent_id">
                <option value="">— None (top level) —</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label>Icon path <small>(e.g. icons/robotics.svg)</small></label>
            <input type="text" name="icon" value="{{ old('icon', $category->icon) }}">
        </div>
        <div class="field">
            <label>Sort Order</label>
            <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}">
        </div>
        <div class="field full">
            <label>Flags</label>
            <div class="checkbox-row">
                <label><input type="checkbox" name="show_in_sidebar" value="1" {{ old('show_in_sidebar', $category->exists ? $category->show_in_sidebar : true) ? 'checked' : '' }}> Show in sidebar</label>
                <label><input type="checkbox" name="is_showcase" value="1" {{ old('is_showcase', $category->is_showcase) ? 'checked' : '' }}> Homepage showcase</label>
            </div>
        </div>
    </div>

    <button class="btn btn-green" type="submit" style="margin-top:16px;padding:12px 26px">{{ $category->exists ? 'Update Category' : 'Create Category' }}</button>
</form>
@endsection
