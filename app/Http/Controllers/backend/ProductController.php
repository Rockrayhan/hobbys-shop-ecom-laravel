<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('backend.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.products.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:products',
            'current_price' => 'required|numeric',
            'previous_price' => 'nullable|numeric',
            'image' => 'nullable|image'
        ]);

        $filename = null;
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $filename);
            $filename = 'uploads/products/' . $filename; 
        }


        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'current_price' => $request->current_price,
            'previous_price' => $request->previous_price,
            'isOnSale' => $request->isOnSale ? 1 : 0,
            'image' => $filename
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product added!');
    }
}
