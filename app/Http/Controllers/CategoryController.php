<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $category = Category::where('slug', $slug)->with('children')->firstOrFail();

        $categoryIds = $category->children->pluck('id')->push($category->id);

        $query = Product::active()->with('category')->whereIn('category_id', $categoryIds);

        // Price range filter
        if ($request->filled('min_price')) {
            $query->where(function ($q) use ($request) {
                $q->whereRaw('COALESCE(NULLIF(special_price, 0), price) >= ?', [(float) $request->min_price]);
            });
        }
        if ($request->filled('max_price')) {
            $query->where(function ($q) use ($request) {
                $q->whereRaw('COALESCE(NULLIF(special_price, 0), price) <= ?', [(float) $request->max_price]);
            });
        }

        // Sorting
        match ($request->get('sort')) {
            'price_low_high'   => $query->orderByRaw('COALESCE(NULLIF(special_price, 0), price) ASC'),
            'price_high_low'   => $query->orderByRaw('COALESCE(NULLIF(special_price, 0), price) DESC'),
            'name_asc'         => $query->orderBy('name'),
            'name_desc'        => $query->orderByDesc('name'),
            'newest'           => $query->latest(),
            default            => $query->latest(),
        };

        $products = $query->paginate(12)->withQueryString();

        return view('category.show', [
            'category' => $category,
            'products' => $products,
        ]);
    }

    public function allCategories()
    {
        $categories = Category::sidebar()->with('children')->get();

        return view('category.all', compact('categories'));
    }
}
