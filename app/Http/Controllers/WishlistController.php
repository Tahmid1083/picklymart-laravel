<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $products = $request->user()->wishlistProducts()->with('category')->latest()->get();

        return view('users.wishlist', compact('products'));
    }

    public function toggle(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        $user = $request->user();
        $productId = (int) $validated['product_id'];

        if ($user->wishlistProducts()->where('product_id', $productId)->exists()) {
            $user->wishlistProducts()->detach($productId);
            $message = 'Removed from your wishlist.';
        } else {
            $user->wishlistProducts()->attach($productId);
            $message = 'Added to your wishlist.';
        }

        return back()->with('success', $message);
    }
}
