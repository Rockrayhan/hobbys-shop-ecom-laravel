<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function home()
    {
        $products = Product::with('category')->latest()->get();
        $categories = Category::all();

        return view('frontend.home', compact('products', 'categories'));
    }


    public function customerDashboard()
    {
        return view('frontend.customerDashboard');
    }


    public function about()
    {
        return view('frontend.about');
    }


    public function allProducts()
    {
        return view('frontend.all-products');
    }
}
