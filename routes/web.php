<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;


// frontend
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/all-products', [FrontendController::class, 'allProducts'])->name('all-products');



// backend

Route::get('/admin', [AdminController::class, 'dashboard'])->name('home');