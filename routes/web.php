<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoryController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/dashboard/category/edit', [CategoryController::class, 'edit'])->name('dashboard.category.edit');
});

require __DIR__ . '/auth.php';
