<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DiscountProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = DiscountProduct::with('product')->latest()->get();
        return view('dashboard.discount-product.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('dashboard.discount-product.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id|unique:discount_products,product_id',
            // Change 'percentage' to 'percent' here
            'discount_type' => 'required|string|in:percent,fixed',
            'discount_value' => 'required|numeric|min:0',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
            'is_active' => 'sometimes|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        DiscountProduct::create($validated);

        return redirect()->route('dashboard.discount-product.index')
            ->with('success', 'Product discount created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiscountProduct $discountProduct)
    {
        $products = Product::orderBy('name')->get();
        return view('dashboard.discount-product.edit', [
            'discount' => $discountProduct,
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DiscountProduct $discountProduct)
    {
        $validated = $request->validate([
            // The product_id cannot be changed, so it's not validated here.
            'discount_type' => 'required|string|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
            'is_active' => 'sometimes|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $discountProduct->update($validated);

        return redirect()->route('dashboard.discount-product.index')
            ->with('success', 'Product discount updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiscountProduct $discountProduct)
    {
        $discountProduct->delete();
        return redirect()->route('dashboard.discount-product.index')
            ->with('success', 'Product discount deleted successfully.');
    }
}
