<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 20;

        if ($request->ajax()) {
            $products = Product::with('statusRelation')
                ->paginate($perPage);
            return view('dashboard.category.partials.products', compact('products'))->render();
        }

        $products = Product::with('statusRelation')
            ->paginate($perPage);

        return view('dashboard.product.index', compact('products'));
    }


    public function create()
    {
        $sub_categories = SubCategory::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        return view('dashboard.product.create', compact('sub_categories', 'categories'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'sub_category_id' => 'required|integer',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product', 'public');
            $validated['image'] = $imagePath;
        }

        Product::create([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'sub_category_id' => $validated['sub_category_id'],
            'price' => $validated['price'],
            'stock_quantity' => $validated['stock_quantity'],
            'image' => $validated['image'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('dashboard.product.index')->with('success', 'product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        $sub_categories = SubCategory::where('status', 1)->get();
        return view('dashboard.product.edit', compact('product', 'categories', 'sub_categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'sub_category_id' => 'required|integer',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|integer',
        ]);

        // If a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && \Storage::disk('public')->exists($product->image)) {
                \Storage::disk('public')->delete($product->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('product', 'public');
            $validated['image'] = $imagePath;
        } else {
            // Keep old image if no new upload
            $validated['image'] = $product->image;
        }

        // Update product
        $product->update($validated);

        return redirect()->route('dashboard.product.index')
            ->with('success', 'product updated successfully.');
    }



    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('dashboard.product.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function getSubCategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->get();

        return response()->json($subcategories);
    }
}
