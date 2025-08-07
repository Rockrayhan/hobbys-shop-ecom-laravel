<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;


// frontend
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/all-products', [FrontendController::class, 'allProducts'])->name('all-products');



// backend

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('customer.register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');



// Dashboard routes with role middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

});

Route::middleware(['auth', 'role:customer'])->group(function () {
Route::get('/my-dashboard', [FrontendController::class, 'customerDashboard'])->name('customer.dashboard');
});