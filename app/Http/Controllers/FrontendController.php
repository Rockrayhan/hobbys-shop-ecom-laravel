<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function home()
    {
        // $products = Product::with('category')->latest()->get();
        $products = Product::with('category')
            ->where('isOnSale', false)
            ->latest()
            ->get();

        $categories = Category::all();
        $banners = Banner::with('product')->where('is_active', true)->get();
        $reviews = Review::latest()->get();

        return view('frontend.home', compact('products', 'categories', 'banners', 'reviews'));
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


    public function categoryDetails($slug)
    {
        // Find category by slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Get products that belong to this category
        $products = $category->products()->latest()->paginate(9);

        // Optionally: get related categories (excluding current one)
        $relatedCategories = Category::where('id', '!=', $category->id)->take(5)->get();

        return view('frontend.category-details', compact('category', 'products', 'relatedCategories'));
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




    public function allProducts()
    {

        $products = Product::with('category')->latest()->get();
        $categories = Category::all();

        return view('frontend.all-products', compact('products', 'categories'));
    }



    public function customerDashboard()
    {
        return view('frontend.customerDashboard');
    }





    public function contact()
    {
        return view('frontend.contact');
    }
}
