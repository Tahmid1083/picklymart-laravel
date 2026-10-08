<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index', [
            'items' => Cart::detailed(),
            'total' => Cart::total(),
        ]);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity'   => ['nullable', 'integer', 'min:1', 'max:999'],
        ]);

        $product = Product::active()->findOrFail($validated['product_id']);
        Cart::add($product->id, (int) ($validated['quantity'] ?? 1));

        if ($request->boolean('buy_now')) {
            return redirect()->route('cart.index')->with('success', "“{$product->name}” added to your cart.");
        }

        return back()->with('success', "“{$product->name}” added to your cart.");
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'quantity'   => ['required', 'array'],
            'quantity.*' => ['required', 'integer', 'min:0', 'max:999'],
        ]);

        foreach ($validated['quantity'] as $productId => $qty) {
            Cart::update((int) $productId, (int) $qty);
        }

        return back()->with('success', 'Cart updated successfully.');
    }

    public function remove(Request $request)
    {
        Cart::remove((int) $request->integer('product_id'));

        return back()->with('success', 'Item removed from cart.');
    }
}
