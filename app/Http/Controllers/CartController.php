<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $product = Product::with('discountRelation')->findOrFail($productId);

        $cart = session()->get('cart', []);

        // Determine original price
        $originalPrice = $product->original_price ?? $product->price;

        // Apply discount if available
        $discount = $product->discountRelation?->discount_value ?? 0;
        $finalPrice = $originalPrice * (1 - ($discount / 100));

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => round($finalPrice, 2),
                'image' => $product->image,
                'quantity' => $quantity,
                'discount' => $discount,
                'original_price' => round($originalPrice, 2)
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }


    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('front-end.cart.index', compact('cart'));
    }

    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product removed from cart.');
    }
}
