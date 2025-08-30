<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;      // <-- Import Order model
use App\Models\OrderItem;  // <-- Import OrderItem model
use Illuminate\Support\Facades\Auth; // <-- Import Auth facade
use Illuminate\Support\Facades\DB;   // <-- Import DB facade for transactions
use Illuminate\Support\Facades\Log; // Make sure Log is imported

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

    public function checkout(Request $request)
    {
        // 1. Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to checkout.');
        }

        $cart = session()->get('cart', []);

        // 2. Ensure the cart is not empty
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        // Use a database transaction to ensure all queries succeed or none do
        DB::beginTransaction();

        try {
            // 3. Check product stock before proceeding
            foreach ($cart as $productId => $item) {
                $product = Product::find($productId);
                if (!$product || $product->stock_quantity < $item['quantity']) {
                    // If stock is insufficient, cancel the transaction and redirect
                    DB::rollBack();
                    return redirect()->route('cart.view')->with('error', 'Sorry, the product "' . $item['name'] . '" is out of stock or does not have enough quantity.');
                }
            }

            // 4. Calculate the total amount
            $totalAmount = 0;
            foreach ($cart as $item) {
                $totalAmount += $item['price'] * $item['quantity'];
            }

            // 5. Create the Order (without providing 'order_id')
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'shipping_address' => 'N/A', // Providing a default value
                'payment_method' => 'N/A',   // Providing a default value
                'notes' => null,           // Providing a default value
            ]);

            // 6. Create the Order Items and Decrement Stock
            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Decrement the stock for the purchased product
                Product::where('id', $productId)->decrement('stock_quantity', $item['quantity']);
            }

            // If everything is successful, commit the transaction
            DB::commit();

            // 7. Clear the cart from the session
            session()->forget('cart');

            // 8. Redirect with a success message
            return redirect()->route('cart.view')->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            // If anything goes wrong, roll back the transaction
            DB::rollBack();

            // Log the entire exception, which includes the stack trace, file, and line number.
            Log::error($e);

            // Redirect back with a generic error message
            return redirect()->route('cart.view')->with('error', 'Something went wrong. Please try again.');
        }
    }
}
