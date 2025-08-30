<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class FrontCategoryController extends Controller
{

    public function show(Category $category)
    {
        $otherCategories = Category::where('status', 1)
            ->where('id', '!=', $category->id)
            ->select('id', 'name', 'image')
            ->get();

        $categories = Category::where('status', 1)->where('id', '!=', $category->id)->select('id', 'name', 'image')->get();

        $page = Category::findOrFail($category->id);
        $products = Product::where('category_id', $category->id)
            ->with(['discountRelation' => function ($query) {
                $query->where('is_active', true);
            }])
            ->paginate(30);

        // Pass all the necessary data to the view with clear variable names.
        return view('front-end.category.index', [
            'category' => $category,          // The main category for the page title
            'products' => $products,          // The products for this category
            'otherCategories' => $otherCategories, // A list of other categories for navigation
            'categories' => $categories,      // All categories for the category carousel
            'page' => $page,                  // The current category for highlighting in the carousel
        ]);
    }

    public function product(Product $product)
    {
        // Eager load the relationships needed in the view to prevent extra database queries
        $product = Product::with(['categoryRelation', 'discountRelation' => function ($query) {
            $query->where('is_active', true);
        }])->findOrFail($product->id);

        // Get 4 related products from the same category, excluding the current one
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id) // Exclude the current product
            ->inRandomOrder() // Get random related products
            ->limit(4)
            ->get();

        // Return the view and pass the product and related products data to it
        return view('front-end.category.product-detail', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
