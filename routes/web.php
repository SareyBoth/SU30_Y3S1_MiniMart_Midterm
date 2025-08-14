<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\SubCategoryController;
use App\Http\Controllers\Dashboard\ProductController;


Route::get('/', function () {
    return view('front-end.index');
});

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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
});

require __DIR__ . '/auth.php';
