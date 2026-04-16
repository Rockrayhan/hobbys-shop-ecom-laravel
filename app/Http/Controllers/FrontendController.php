<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function home()
    {
        // All products
        $products = Product::with('category')->where('isOnSale', false)->latest()->get();

        // Only parent categories for filter buttons
        $categories = Category::whereNull('parent_id')->with('children')->get();

        // Only featured categories for home page display
        $featuredCategories = Category::where('featured_on_home', true)->get();

        $banners = Banner::with('product')->where('is_active', true)->get();
        $reviews = Review::latest()->get();

        return view('frontend.home', compact(
            'products',
            'categories',
            'featuredCategories',
            'banners',
            'reviews'
        ));
    }



    public function categoryDetails($slug)
    {
        $category = Category::with('children')->where('slug', $slug)->firstOrFail();

        // Collect category IDs
        $categoryIds = [$category->id];

        if ($category->children->count()) {
            $childIds = $category->children->pluck('id')->toArray();
            $categoryIds = array_merge($categoryIds, $childIds);
        }

        // Products
        $products = \App\Models\Product::whereIn('category_id', $categoryIds)
            ->latest()
            ->paginate(9);

        // 👉 Filter categories (IMPORTANT)
        $filterCategories = collect([$category])->merge($category->children);

        // Related categories
        $relatedCategories = Category::where('id', '!=', $category->id)
            ->take(5)
            ->get();

        return view('frontend.category-details', compact(
            'category',
            'products',
            'relatedCategories',
            'filterCategories'
        ));
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




    public function allProducts()
    {

        $products = Product::with('category')->latest()->get();
                // Only parent categories for filter buttons
        $categories = Category::whereNull('parent_id')->with('children')->get();

        return view('frontend.all-products', compact('products', 'categories'));
    }




    // show order success page
    public function OrderSuccess(Order $order)
    {
        $order->load('items.product', 'items.variation'); 
        return view('frontend.order_success', compact('order'));
    }





    public function customerDashboard()
    {
        return view('frontend.customerDashboard');
    }





    public function contact()
    {
        return view('frontend.contact');
    }



    public function privacyPolicy()
    {
        return view('frontend.privacy-policy');
    }

    public function returnRefundPolicy()
    {
        return view('frontend.return-refund-policy');
    }
}
