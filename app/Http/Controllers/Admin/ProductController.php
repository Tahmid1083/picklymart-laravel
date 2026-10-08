<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form', [
            'product'    => new Product(),
            'categories' => Category::orderBy('name')->get(),
            'sellers'    => Seller::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($request->name);

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', [
            'product'    => $product,
            'categories' => Category::orderBy('name')->get(),
            'sellers'    => Seller::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validated($request);
        $data['slug'] = $product->name === $request->name
            ? $product->slug
            : $this->uniqueSlug($request->name, $product->id);

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Product deleted.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'category_id'       => ['required', 'integer', 'exists:categories,id'],
            'seller_id'         => ['nullable', 'integer', 'exists:sellers,id'],
            'brand'             => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description'       => ['nullable', 'string'],
            'price'             => ['required', 'numeric', 'min:0'],
            'special_price'     => ['nullable', 'numeric', 'min:0'],
            'stock'             => ['required', 'integer', 'min:0'],
            'unit'              => ['required', 'string', 'max:30'],
            'thumbnail'         => ['nullable', 'string', 'max:255'],
            'is_featured'       => ['nullable', 'boolean'],
            'is_best_selling'   => ['nullable', 'boolean'],
            'is_new'            => ['nullable', 'boolean'],
            'is_todays_deal'    => ['nullable', 'boolean'],
            'is_inhouse'        => ['nullable', 'boolean'],
            'status'            => ['nullable', 'boolean'],
        ]);
    }

    protected function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'product';
        $slug = $base;
        $i = 1;

        while (Product::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
