<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // // $butchery_product = Product::orderBy('id', 'asc')->select('name', 'image', 'stock_quantity', 'price')->limit(10)->get();
        // $butchery_product = Product::with(['discountRelation' => function ($query) {
        //     $query->where('is_active', true);
        // }])
        //     ->orderBy('id', 'asc')
        //     ->select('id', 'name', 'image', 'stock_quantity', 'price', 'original_price', 'product_id')
        //     ->limit(10)
        //     ->get();

        $categories = Category::where('status', 1)->select('name', 'image')->get();
        $activeDiscount = ['discountRelation' => function ($query) {
            $query->where('is_active', true);
        }];

        $selectFields = ['id', 'name', 'image', 'stock_quantity', 'original_price', 'price'];

        $best_sell_product = Product::with($activeDiscount)
            ->where('status', 1)
            ->orderBy('stock_quantity', 'asc')
            ->select($selectFields)
            ->limit(10)
            ->get();

        $butchery_product = Product::with($activeDiscount)
            ->where('category_id', 33)
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->select($selectFields)
            ->limit(10)
            ->get();

        $bakery_product = Product::with($activeDiscount)
            ->where('category_id', 32)
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->select($selectFields)
            ->limit(10)
            ->get();

        $snack_product = Product::with($activeDiscount)
            ->where('category_id', 42)
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->select($selectFields)
            ->limit(10)
            ->get();

        return view('front-end.index', compact('categories', 'best_sell_product', 'butchery_product', 'bakery_product', 'snack_product'));
    }
}
