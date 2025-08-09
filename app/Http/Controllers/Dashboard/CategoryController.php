<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.category.index', compact('categories'));
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
            'status' => 'required|boolean',
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

    public function edit()
    {
        return view('dashboard.category.edit');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('dashboard.category.index')
            ->with('success', 'Category deleted successfully.');
    }
}
