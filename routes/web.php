<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\OrderController as BackendOrderController;
use App\Http\Controllers\frontend\OrderController as FrontendOrderController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;


// =========== frontend =============
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/all-products', [FrontendController::class, 'allProducts'])->name('all-products');



// orders
Route::get('/checkout', [FrontendOrderController::class, 'showCheckoutForm'])->name('checkout.form');
Route::post('/checkout', [FrontendOrderController::class, 'placeOrder'])->name('checkout.place');
Route::get('/order/success/{order}', [FrontendOrderController::class, 'success'])->name('order.success');


// cart
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');


// ============= backend ==========

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('customer.register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');





Route::prefix('admin')->name('admin.')->group(function () {

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');



    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{id}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');



    // orders
    Route::get('/orders', [BackendOrderController::class, 'index'])->name('orders');
    Route::delete('/orders/delete/{id}', [BackendOrderController::class, 'destroy'])->name('orders.destroy');
});



// Dashboard routes with role middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/my-dashboard', [FrontendController::class, 'customerDashboard'])->name('customer.dashboard');
});
