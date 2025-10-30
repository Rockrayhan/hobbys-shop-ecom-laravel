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


    public function productDetails($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        // Optionally, fetch related products (same category)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('frontend.product-details', compact('product', 'relatedProducts'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        // Fetch products matching the search query
        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->paginate(10)
            ->withQueryString();

        return view('frontend.search-results', compact('products', 'query'));
    }






    public function liveSearch(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json([]);
        }

        // Fetch up to 5 matching products
        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->take(5)
            ->get(['id', 'name', 'price', 'image']);

        return response()->json($products);
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
