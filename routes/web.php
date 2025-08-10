<?php

use Illuminate\Support\Facades\Route;

// ================= ADMIN Controllers =================
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

// ================= CLIENT Controllers =================
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Client\CategoryController as ClientCategoryController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
use App\Http\Controllers\Client\PostController as ClientPostController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\CartController as ClientCartController;
use App\Http\Controllers\Client\CheckoutController as ClientCheckoutController;

// ================= AUTH Controllers =================
use App\Http\Controllers\AuthController;

// ================= AUTH ROUTES =================
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// ================= TRANG MẶC ĐỊNH =================
Route::get('/', function () {
    return redirect()->route('client.dashboard');
});

// ================= ADMIN ROUTES =================
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CATEGORY
    Route::get('category', [AdminCategoryController::class, 'index'])->name('category');
    Route::get('category/create', [AdminCategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [AdminCategoryController::class, 'store'])->name('category.store');
    Route::get('category/{id}/edit', [AdminCategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/{id}/update', [AdminCategoryController::class, 'update'])->name('category.update');
    Route::get('category/{id}/delete', [AdminCategoryController::class, 'destroy'])->name('category.delete');

    // ORDER
    Route::get('order', [AdminOrderController::class, 'index'])->name('order.index');
    Route::get('order/{id}', [AdminOrderController::class, 'show'])->name('order.show');
    Route::post('order/{id}/update-status', [AdminOrderController::class, 'updateStatus'])->name('order.update-status');

    // POST
    Route::get('post', [AdminPostController::class, 'index'])->name('post');

    // PRODUCT
    Route::get('product', [AdminProductController::class, 'index'])->name('product');
    Route::get('product/create', [AdminProductController::class, 'create'])->name('product.create');
    Route::post('product/store', [AdminProductController::class, 'store'])->name('product.store');
    Route::get('product/{id}/edit', [AdminProductController::class, 'edit'])->name('product.edit');
    Route::post('product/{id}/update', [AdminProductController::class, 'update'])->name('product.update');
    Route::get('product/{id}/delete', [AdminProductController::class, 'destroy'])->name('product.delete');
});

// Trang mặc định client
Route::get('/', [ClientDashboardController::class, 'index'])->name('client.home');

// ROUTES CHO CLIENT
Route::prefix('/')->name('client.')->group(function () {
    Route::get('dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
    Route::get('product', [App\Http\Controllers\Client\ProductController::class, 'index'])->name('product');
    Route::get('product/{id}', [App\Http\Controllers\Client\ProductController::class, 'show'])->name('product.show');
    Route::get('category', [App\Http\Controllers\Client\CategoryController::class, 'index'])->name('category');
    Route::get('post', [App\Http\Controllers\Client\PostController::class, 'index'])->name('post');
    
    // Routes requiring authentication
    Route::middleware(['auth'])->group(function () {
        // Cart routes
        Route::get('cart', [App\Http\Controllers\Client\CartController::class, 'index'])->name('cart.index');
        Route::post('cart/add', [App\Http\Controllers\Client\CartController::class, 'add'])->name('cart.add');
        Route::post('cart/{id}/update', [App\Http\Controllers\Client\CartController::class, 'update'])->name('cart.update');
        Route::get('cart/{id}/remove', [App\Http\Controllers\Client\CartController::class, 'remove'])->name('cart.remove');
        Route::get('cart/clear', [App\Http\Controllers\Client\CartController::class, 'clear'])->name('cart.clear');
        
        // Checkout routes
        Route::get('checkout', [App\Http\Controllers\Client\CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('checkout', [App\Http\Controllers\Client\CheckoutController::class, 'store'])->name('checkout.store');
        
        // Order routes
        Route::get('order', [App\Http\Controllers\Client\OrderController::class, 'index'])->name('order.index');
        Route::get('order/{id}', [App\Http\Controllers\Client\OrderController::class, 'show'])->name('order.show');
        Route::get('order/{id}/cancel', [App\Http\Controllers\Client\OrderController::class, 'cancel'])->name('order.cancel');
        
        // Profile routes
        Route::get('profile', [App\Http\Controllers\Client\ProfileController::class, 'index'])->name('profile');
        Route::post('profile/update', [App\Http\Controllers\Client\ProfileController::class, 'update'])->name('profile.update');
        Route::post('profile/change-password', [App\Http\Controllers\Client\ProfileController::class, 'changePassword'])->name('profile.change-password');
    });
});
