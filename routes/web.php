<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\OrderController as BackendOrderController;
use App\Http\Controllers\frontend\OrderController as FrontendOrderController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\backend\ReviewController;
use Illuminate\Support\Facades\Route;


// =========== frontend =============
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/all-products', [FrontendController::class, 'allProducts'])->name('all-products');
Route::get('/product/{slug}', [FrontendController::class, 'productDetails'])->name('product.details');
Route::get('/category/{slug}', [FrontendController::class, 'categoryDetails'])->name('category.details');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');

Route::get('/search', [FrontendController::class, 'search'])->name('product.search');


// Live search AJAX route
Route::get('/search-suggestions', [FrontendController::class, 'liveSearch'])
    ->name('product.live.search');




// orders
Route::get('/checkout', [FrontendOrderController::class, 'showCheckoutPage'])->name('checkout.form');
Route::post('/checkout', [FrontendOrderController::class, 'placeOrder'])->name('checkout.place');
Route::get('/order/success/{order}', [FrontendOrderController::class, 'success'])->name('order.success');




// Route::post('/checkout/buy-now/{id}', [FrontendOrderController::class, 'buyNow'])->name('checkout.buyNow');

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


    Route::get('/products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');
    Route::post('/products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/force-delete/{id}', [ProductController::class, 'forceDelete'])->name('products.forceDelete');


    // banner
    Route::resource('banners', BannerController::class);

    // review
    Route::resource('reviews', ReviewController::class);


    // orders
    Route::get('/orders', [BackendOrderController::class, 'index'])->name('orders');
    Route::delete('/orders/delete/{id}', [BackendOrderController::class, 'destroy'])->name('orders.destroy');
    Route::patch('/orders/{id}/status', [BackendOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});



// Dashboard routes with role middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/my-dashboard', [FrontendController::class, 'customerDashboard'])->name('customer.dashboard');
});
