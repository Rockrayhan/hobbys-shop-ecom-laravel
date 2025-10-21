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
            'name' => 'required|unique:products|min:3',
            'current_price' => 'required|numeric',
            'previous_price' => 'nullable|numeric',
            'image' => 'nullable|image'
        ]);

        $filename = null;
        if ($request->hasFile('image')) {
            $slug = Str::slug($request->name);
            $filename = $slug . '-' . uniqid() . '.' . $request->image->extension();
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

        return redirect()->route('admin.products.index')
        ->with('success', '✅ Product added successfully!');
        // ->with('highlight_id', $product->id);
    }



    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('backend.products.edit', compact('product', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|min:3|unique:products,name,' . $id,
            'current_price' => 'required|numeric',
            'previous_price' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $filename = $product->image; // keep old image by default

        if ($request->hasFile('image')) {
            // ✅ delete old image if it exists
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            // ✅ upload new image
            $slug = Str::slug($request->name);
            $newFilename = $slug . '-' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $newFilename);
            $filename = 'uploads/products/' . $newFilename;
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'current_price' => $request->current_price,
            'previous_price' => $request->previous_price,
            'isOnSale' => $request->has('isOnSale') ? 1 : 0,
            'image' => $filename,
        ]);

        return redirect()->route('admin.products.index')
        ->with('success', '✅ Product updated successfully!')
        ->with('highlight_id', $product->id);
    }



    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete product image if exists
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted!');
    }
}
