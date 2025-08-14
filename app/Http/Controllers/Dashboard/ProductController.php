<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

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
        return view('dashboard.category.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category', 'public');
            $validated['image'] = $imagePath;
        }

        Category::create([
            'name' => $validated['name'],
            'image' => $validated['image'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('dashboard.category.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|integer',
        ]);

        // If a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image && \Storage::disk('public')->exists($category->image)) {
                \Storage::disk('public')->delete($category->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('category', 'public');
            $validated['image'] = $imagePath;
        } else {
            // Keep old image if no new upload
            $validated['image'] = $category->image;
        }

        // Update category
        $category->update($validated);

        return redirect()->route('dashboard.category.index')
            ->with('success', 'Category updated successfully.');
    }



    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('dashboard.product.index')
            ->with('success', 'Product deleted successfully.');
    }
}
