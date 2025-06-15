<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
     public function home()
    {
        // $featured = Product::latest()->take(6)->get();
        return view('frontend.home');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function allProducts()
    {
        // $products = Product::paginate(12);
        return view('frontend.all-products');
    }
}
