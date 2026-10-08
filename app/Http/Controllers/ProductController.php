<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::active()
            ->with(['category', 'seller', 'images', 'reviews.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        $product->increment('views');

        $related = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)->get();

        $topSelling = Product::active()->where('is_best_selling', true)->where('id', '!=', $product->id)->take(5)->get();

        $frequentlyBought = Product::active()
            ->where('id', '!=', $product->id)
            ->where('is_featured', true)
            ->inRandomOrder()->take(4)->get();

        return view('products.show', compact('product', 'related', 'topSelling', 'frequentlyBought'));
    }

    public function storeReview(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating'  => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'min:5', 'max:2000'],
        ]);

        Review::updateOrCreate(
            ['product_id' => $product->id, 'user_id' => $request->user()->id],
            ['rating' => $validated['rating'], 'comment' => $validated['comment']]
        );

        return back()->with('success', 'Thank you! Your review has been submitted.');
    }
}
