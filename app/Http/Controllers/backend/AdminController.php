<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // $featured = Product::latest()->take(6)->get();
        return view('backend.admin.dashboard');
    }
}
