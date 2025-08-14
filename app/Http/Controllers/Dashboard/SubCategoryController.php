<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 12;
        $sub_categories = SubCategory::with('statusRelation')->paginate($perPage);

        // Normal page load
        return view('dashboard.sub_category.index', compact('sub_categories'));
    }



    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('dashboard.sub_category.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category', 'public');
            $validated['image'] = $imagePath;
        }

        SubCategory::create([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'image' => $validated['image'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('dashboard.sub_category.index')->with('success', 'Sub Category created successfully.');
    }

    public function edit($id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        return view('dashboard.sub_category.edit', compact('sub_category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $category = SubCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
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

        return redirect()->route('dashboard.sub_category.index')
            ->with('success', 'Sub Category updated successfully.');
    }



    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->route('dashboard.sub_category.index')
            ->with('success', 'Subcategory deleted successfully.');
    }
}
