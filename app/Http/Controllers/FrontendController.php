<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
     public function home()
    {        
        return view('frontend.home');
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
