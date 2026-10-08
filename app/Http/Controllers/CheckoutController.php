<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Cart::count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout.index', [
            'items' => Cart::detailed(),
            'total' => Cart::total(),
        ]);
    }

    public function placeOrder(Request $request)
    {
        if (Cart::count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'email'         => ['required', 'email', 'max:150'],
            'phone'         => ['required', 'string', 'max:30'],
            'address'       => ['required', 'string', 'max:500'],
            'city'          => ['required', 'string', 'max:100'],
            'notes'         => ['nullable', 'string', 'max:1000'],
            'payment_method' => ['required', 'in:cash_on_delivery,bkash,nagad'],
        ]);

        $items = Cart::detailed();
        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $order = DB::transaction(function () use ($validated, $items, $request) {
            $order = Order::create([
                'code'           => Order::generateCode(),
                'user_id'        => $request->user()?->id,
                'customer_name'  => $validated['customer_name'],
                'email'          => $validated['email'],
                'phone'          => $validated['phone'],
                'address'        => $validated['address'],
                'city'           => $validated['city'],
                'notes'          => $validated['notes'] ?? null,
                'total'          => Cart::total(),
                'payment_method' => $validated['payment_method'],
                'status'         => 'pending',
            ]);

            foreach ($items as $row) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $row['product']->id,
                    'product_name' => $row['product']->name,
                    'price'        => $row['price'],
                    'quantity'     => $row['quantity'],
                ]);

                $row['product']->decrement('stock', $row['quantity']);
            }

            return $order;
        });

        Cart::clear();

        return redirect()->route('checkout.success', $order->code);
    }

    public function success(string $code)
    {
        $order = Order::where('code', $code)->with('items')->firstOrFail();

        return view('checkout.success', compact('order'));
    }
}
