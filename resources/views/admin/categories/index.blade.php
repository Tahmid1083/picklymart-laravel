@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="admin-toolbar">
    <h2 style="font-size:17px;font-weight:800">Categories ({{ $categories->total() }})</h2>
    <a class="btn btn-green" href="{{ route('admin.categories.create') }}">+ Add Category</a>
</div>

<table class="admin-table">
    <thead><tr><th>Name</th><th>Slug</th><th>Parent</th><th>Showcase</th><th>Sort</th><th style="width:170px">Actions</th></tr></thead>
    <tbody>
        @forelse ($categories as $category)
            <tr>
                <td><b>{{ $category->name }}</b></td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->parent?->name ?? '—' }}</td>
                <td>{{ $category->is_showcase ? 'Yes' : 'No' }}</td>
                <td>{{ $category->sort_order }}</td>
                <td>
                    <a class="btn btn-outline btn-sm" href="{{ route('admin.categories.edit', $category) }}">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this category and its products?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" style="text-align:center;color:#6b7280;padding:30px">No categories found.</td></tr>
        @endforelse
    </tbody>
</table>

<div class="pagination">{{ $categories->links() }}</div>
@endsection
