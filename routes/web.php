<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\SubCategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\DiscountController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\LocationController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Front\FrontBlogController;
use App\Http\Controllers\Front\FrontLocationController;
use App\Http\Controllers\Front\FrontCategoryController;
use App\Http\Controllers\Dashboard\DiscountProductController;

Route::get('/', [HomeController::class, 'index'])->name('front.index');
Route::get('/blog', [FrontBlogController::class, 'index'])->name('blog.index');
Route::get('/blog/detail/{id}', [FrontBlogController::class, 'detail'])->name('blog.detail');
Route::get('/location', [FrontLocationController::class, 'index'])->name('location.index');
Route::get('/category/{category}', [FrontCategoryController::class, 'show'])->name('category.show');
Route::get('/product/{product}', [FrontCategoryController::class, 'product'])->name('product.show');

Route::get('/get-subcategories/{category_id}', [ProductController::class, 'getSubCategories']);
//Dashboard

Route::middleware(['auth', 'is.admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    //Category
    Route::get('/dashboard/category', [CategoryController::class, 'index'])->name('dashboard.category.index');
    Route::get('/dashboard/category/create', [CategoryController::class, 'create'])->name('dashboard.category.create');
    Route::post('/dashboard/category', [CategoryController::class, 'store'])->name('dashboard.category.store');
    Route::get('/dashboard/category/edit/{id}', [CategoryController::class, 'edit'])->name('dashboard.category.edit');
    Route::put('/dashboard/category/update/{id}', [CategoryController::class, 'update'])->name('dashboard.category.update');
    Route::delete('/dashboard/category/{id}', [CategoryController::class, 'destroy'])->name('dashboard.category.destroy');

    //Sub Category
    Route::get('/dashboard/sub-category', [SubCategoryController::class, 'index'])->name('dashboard.sub_category.index');
    Route::get('/dashboard/sub-category/create', [SubCategoryController::class, 'create'])->name('dashboard.sub_category.create');
    Route::post('/dashboard/sub-category', [SubCategoryController::class, 'store'])->name('dashboard.sub_category.store');
    Route::get('/dashboard/sub-category/edit/{id}', [SubCategoryController::class, 'edit'])->name('dashboard.sub_category.edit');
    Route::put('/dashboard/sub-category/update/{id}', [SubCategoryController::class, 'update'])->name('dashboard.sub_category.update');
    Route::delete('/dashboard/sub-category/{id}', [SubCategoryController::class, 'destroy'])->name('dashboard.sub_category.destroy');

    //Products
    Route::get('/dashboard/product', [ProductController::class, 'index'])->name('dashboard.product.index');
    Route::get('/dashboard/product/create', [ProductController::class, 'create'])->name('dashboard.product.create');
    Route::post('/dashboard/product', [ProductController::class, 'store'])->name('dashboard.product.store');
    Route::get('/dashboard/product/edit/{id}', [ProductController::class, 'edit'])->name('dashboard.product.edit');
    Route::put('/dashboard/product/update/{id}', [ProductController::class, 'update'])->name('dashboard.product.update');
    Route::delete('/dashboard/product/{id}', [ProductController::class, 'destroy'])->name('dashboard.product.destroy');

    //Order
    Route::get('/dashboard/order', [OrderController::class, 'index'])->name('dashboard.order.index');
    Route::get('/dashboard/order/detail/{id}', [OrderController::class, 'detail'])->name('dashboard.order.detail');

    //Discount
    Route::get('/dashboard/coupon', [DiscountController::class, 'indexCoupon'])->name('dashboard.coupon.index');
    Route::get('/dashboard/coupon/create', [DiscountController::class, 'createCoupon'])->name('dashboard.coupon.create');
    Route::post('/dashboard/coupon', [DiscountController::class, 'storeCoupon'])->name('dashboard.coupon.store');
    Route::delete('/dashboard/coupon/{id}', [DiscountController::class, 'destroyCoupon'])->name('dashboard.coupon.destory');

    Route::get('/dashboard/discount/category', [DiscountController::class, 'indexCategory'])->name('dashboard.discount.category.index');

    //Blog
    Route::get('/dashboard/blog', [BlogController::class, 'index'])->name('dashboard.blog.index');
    Route::get('/dashboard/blog/create', [BlogController::class, 'create'])->name('dashboard.blog.create');
    Route::post('/dashboard/blog', [BlogController::class, 'store'])->name('dashboard.blog.store');
    Route::get('/dashboard/blog/edit/{id}', [BlogController::class, 'edit'])->name('dashboard.blog.edit');
    Route::put('/dashboard/blog/update/{id}', [BlogController::class, 'update'])->name('dashboard.blog.update');
    Route::delete('/dashboard/blog/{id}', [BlogController::class, 'destroy'])->name('dashboard.blog.destroy');

    //Location
    Route::get('/dashboard/location', [LocationController::class, 'index'])->name('dashboard.location.index');
    Route::get('/dashboard/location/create', [LocationController::class, 'create'])->name('dashboard.location.create');
    Route::post('/dashboard/location', [LocationController::class, 'store'])->name('dashboard.location.store');
    Route::get('/dashboard/location/edit/{id}', [LocationController::class, 'edit'])->name('dashboard.location.edit');
    Route::put('/dashboard/location/update/{id}', [LocationController::class, 'update'])->name('dashboard.location.update');
    Route::delete('/dashboard/location/{id}', [LocationController::class, 'destroy'])->name('dashboard.location.destroy');

    Route::get('/dashboard/discount-product', [DiscountProductController::class, 'index'])->name('dashboard.discount-product.index');
    Route::get('/dashboard/discount-product/create', [DiscountProductController::class, 'create'])->name('dashboard.discount-product.create');
    Route::post('/dashboard/discount-product', [DiscountProductController::class, 'store'])->name('dashboard.discount-product.store');
    Route::get('/dashboard/discount-product/edit/{discount_product}', [DiscountProductController::class, 'edit'])->name('dashboard.discount-product.edit');
    Route::put('/dashboard/discount-product/{discount_product}', [DiscountProductController::class, 'update'])->name('dashboard.discount-product.update');
    Route::delete('/dashboard/discount-product/{discount_product}', [DiscountProductController::class, 'destroy'])->name('dashboard.discount-product.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::delete('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

require __DIR__ . '/auth.php';
