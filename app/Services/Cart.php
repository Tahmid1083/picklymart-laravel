<?php

namespace App\Services;

use App\Models\Product;

/**
 * Session based shopping cart.
 * Structure stored in session: [ product_id => quantity ]
 */
class Cart
{
    protected static function key(): string
    {
        return 'picklymart_cart';
    }

    public static function raw(): array
    {
        return session(self::key(), []);
    }

    public static function add(int $productId, int $quantity = 1): void
    {
        $cart = self::raw();
        $cart[$productId] = ($cart[$productId] ?? 0) + max(1, $quantity);
        session([self::key() => $cart]);
    }

    public static function update(int $productId, int $quantity): void
    {
        $cart = self::raw();
        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $quantity;
        }
        session([self::key() => $cart]);
    }

    public static function remove(int $productId): void
    {
        $cart = self::raw();
        unset($cart[$productId]);
        session([self::key() => $cart]);
    }

    public static function clear(): void
    {
        session([self::key() => []]);
    }

    public static function count(): int
    {
        return array_sum(self::raw());
    }

    public static function total(): float
    {
        return round(self::detailed()->sum(function ($row) {
            return $row['price'] * $row['quantity'];
        }), 2);
    }

    /**
     * Cart rows with product models attached.
     */
    public static function detailed()
    {
        $cart = self::raw();
        if (empty($cart)) {
            return collect();
        }

        $products = Product::active()->whereIn('id', array_keys($cart))->get();

        return collect($cart)->map(function ($quantity, $productId) use ($products) {
            $product = $products->firstWhere('id', (int) $productId);
            if (! $product) {
                return null;
            }

            return [
                'product'  => $product,
                'quantity' => $quantity,
                'price'    => $product->display_price,
                'line'     => round($product->display_price * $quantity, 2),
            ];
        })->filter()->values();
    }
}
