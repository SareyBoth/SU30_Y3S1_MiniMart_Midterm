<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Discount;
use App\Models\DiscountCategory;

class DiscountController extends Controller
{
    public function indexCoupon()
    {
        // Add this method to show all coupons (you can build this view later)
        $discounts = Discount::latest()->paginate(10);
        return view('dashboard.coupon.index', compact('discounts'));
    }

    public function createCoupon()
    {
        return view('dashboard.coupon.create');
    }

    public function storeCoupon(Request $request)
    {
        // 1. Validate the incoming data
        $validatedData = $request->validate([
            'code' => 'required|string|unique:discounts,code|max:255',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:fixed,percent',
            'discount_value' => 'required|numeric|min:0',
            'minimum_purchase' => 'nullable|numeric|min:0',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
            'is_active' => 'required|boolean',
        ]);

        // 2. Convert the is_active radio button value ('1' or '0') to a boolean
        $validatedData['is_active'] = (bool)$validatedData['is_active'];

        // 3. Create the new discount in the database
        Discount::create($validatedData);

        // 4. Redirect back with a success message
        return redirect()->route('dashboard.coupon.index')->with('success', 'Coupon created successfully!');
    }

    public function destroyCoupon($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();

        return redirect()->route('dashboard.coupon.index')
            ->with('success', 'Coupon deleted successfully.');
    }

    public function indexCategory()
    {
        // This method can be used to show discounts related to categories
        // You can implement the logic as needed
        $categories = DiscountCategory::latest()->paginate(20);
        return view('dashboard.discount.category.index', compact('categories'));
    }
};
