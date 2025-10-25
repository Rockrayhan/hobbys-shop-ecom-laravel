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
            'category_id'     => 'required|exists:categories,id',
            'name'            => 'required|unique:products|min:3',
            'current_price'   => 'required|numeric',
            'previous_price'  => 'nullable|numeric',
            'image'           => 'nullable|image|max:2048',
            'image_2'         => 'nullable|image|max:2048',
            'image_3'         => 'nullable|image|max:2048',
            'image_4'         => 'nullable|image|max:2048',
            'image_5'         => 'nullable|image|max:2048',
        ]);

        $slug = Str::slug($request->name);

        // 🔹 Helper to save images dynamically
        $saveImage = function ($file, $index) use ($slug) {
            if (!$file) return null;
            $filename = "{$slug}-{$index}-" . uniqid() . '.' . $file->extension();
            $file->move(public_path('uploads/products'), $filename);
            return 'uploads/products/' . $filename;
        };

        $product = Product::create([
            'category_id'    => $request->category_id,
            'name'           => $request->name,
            'slug'           => $slug,
            'description'    => $request->description,
            'current_price'  => $request->current_price,
            'previous_price' => $request->previous_price,
            'isOnSale'       => $request->has('isOnSale') ? 1 : 0,
            'image'          => $saveImage($request->file('image'), 'main'),
            'image_2'        => $saveImage($request->file('image_2'), 2),
            'image_3'        => $saveImage($request->file('image_3'), 3),
            'image_4'        => $saveImage($request->file('image_4'), 4),
            'image_5'        => $saveImage($request->file('image_5'), 5),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', '✅ Product added successfully!')
            ->with('highlight_id', $product->id);
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
            'category_id'     => 'required|exists:categories,id',
            'name'            => 'required|min:3|unique:products,name,' . $id,
            'current_price'   => 'required|numeric',
            'previous_price'  => 'nullable|numeric',
            'image'           => 'nullable|image|max:2048',
            'image_2'         => 'nullable|image|max:2048',
            'image_3'         => 'nullable|image|max:2048',
            'image_4'         => 'nullable|image|max:2048',
            'image_5'         => 'nullable|image|max:2048',
        ]);

        $slug = Str::slug($request->name);

        // 🔹 Reusable helper to replace image if new file uploaded
        $replaceImage = function ($file, $oldPath, $index) use ($slug) {
            if (!$file) return $oldPath;
            if ($oldPath && file_exists(public_path($oldPath))) {
                unlink(public_path($oldPath));
            }
            $filename = "{$slug}-{$index}-" . uniqid() . '.' . $file->extension();
            $file->move(public_path('uploads/products'), $filename);
            return 'uploads/products/' . $filename;
        };

        $product->update([
            'category_id'    => $request->category_id,
            'name'           => $request->name,
            'slug'           => $slug,
            'description'    => $request->description,
            'current_price'  => $request->current_price,
            'previous_price' => $request->previous_price,
            'isOnSale'       => $request->has('isOnSale') ? 1 : 0,
            'image'          => $replaceImage($request->file('image'), $product->image, 'main'),
            'image_2'        => $replaceImage($request->file('image_2'), $product->image_2, 2),
            'image_3'        => $replaceImage($request->file('image_3'), $product->image_3, 3),
            'image_4'        => $replaceImage($request->file('image_4'), $product->image_4, 4),
            'image_5'        => $replaceImage($request->file('image_5'), $product->image_5, 5),
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
