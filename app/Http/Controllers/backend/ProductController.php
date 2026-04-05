<?php

namespace App\Http\Controllers\backend;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'variations'])->latest();

        // Filter by category if provided
        if ($request->filled('category_id') && $request->category_id !== 'all') {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(10)->withQueryString(); 

        $categories = Category::orderBy('name')->get();

        return view('backend.products.index', compact('products', 'categories'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
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

            'image'           => 'nullable|image|max:4096',
            'image_2'         => 'nullable|image|max:3072',
            'image_3'         => 'nullable|image|max:3072',
            'image_4'         => 'nullable|image|max:3072',
            'image_5'         => 'nullable|image|max:3072',

            // variations
            'sizes'           => 'nullable|array',
            'sizes.*.name'    => 'nullable|string|max:20',
            'sizes.*.stock'   => 'nullable|integer|min:0',
        ]);

        $slug = Str::slug($request->name);

        // ✅ Create Product
        $product = Product::create([
            'category_id'    => $request->category_id,
            'name'           => $request->name,
            'slug'           => $slug,
            'description'    => $request->description,
            'current_price'  => $request->current_price,
            'previous_price' => $request->previous_price,
            'isOnSale'       => $request->has('isOnSale') ? 1 : 0,

            // images
            'image' => ImageUploadHelper::uploadWebp(
                $request->file('image'),
                'uploads/products',
                "{$slug}-main"
            ),
            'image_2' => ImageUploadHelper::uploadWebp(
                $request->file('image_2'),
                'uploads/products',
                "{$slug}-2"
            ),
            'image_3' => ImageUploadHelper::uploadWebp(
                $request->file('image_3'),
                'uploads/products',
                "{$slug}-3"
            ),
            'image_4' => ImageUploadHelper::uploadWebp(
                $request->file('image_4'),
                'uploads/products',
                "{$slug}-4"
            ),
            'image_5' => ImageUploadHelper::uploadWebp(
                $request->file('image_5'),
                'uploads/products',
                "{$slug}-5"
            ),
        ]);

        // ✅ Save Variations
        if ($request->sizes) {
            foreach ($request->sizes as $size) {

                if (!empty($size['name'])) {
                    ProductVariation::create([
                        'product_id' => $product->id,
                        'size'       => $size['name'],
                        'stock'      => $size['stock'] ?? 0,
                        'is_active'  => ($size['stock'] ?? 0) > 0,
                    ]);
                }
            }
        }

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

            'image'           => 'nullable|image|max:4096',
            'image_2'         => 'nullable|image|max:3072',
            'image_3'         => 'nullable|image|max:3072',
            'image_4'         => 'nullable|image|max:3072',
            'image_5'         => 'nullable|image|max:3072',

            // variations
            'sizes'           => 'nullable|array',
            'sizes.*.name'    => 'nullable|string|max:20',
            'sizes.*.stock'   => 'nullable|integer|min:0',
        ]);

        $slug = Str::slug($request->name);

        // helper for replacing image
        $replaceImage = function ($file, $oldPath, $suffix) use ($slug) {
            if (!$file) {
                return $oldPath;
            }

            ImageUploadHelper::delete($oldPath);

            return ImageUploadHelper::uploadWebp(
                $file,
                'uploads/products',
                "{$slug}-{$suffix}"
            );
        };

        // ✅ Update Product
        $product->update([
            'category_id'    => $request->category_id,
            'name'           => $request->name,
            'slug'           => $slug,
            'description'    => $request->description,
            'current_price'  => $request->current_price,
            'previous_price' => $request->previous_price,
            'isOnSale'       => $request->has('isOnSale') ? 1 : 0,

            'image'   => $replaceImage($request->file('image'),   $product->image,   'main'),
            'image_2' => $replaceImage($request->file('image_2'), $product->image_2, '2'),
            'image_3' => $replaceImage($request->file('image_3'), $product->image_3, '3'),
            'image_4' => $replaceImage($request->file('image_4'), $product->image_4, '4'),
            'image_5' => $replaceImage($request->file('image_5'), $product->image_5, '5'),
        ]);

        // ❌ Delete old variations
        $product->variations()->delete();

        // ✅ Insert new variations
        if ($request->sizes) {
            foreach ($request->sizes as $size) {

                if (!empty($size['name'])) {
                    ProductVariation::create([
                        'product_id' => $product->id,
                        'size'       => $size['name'],
                        'stock'      => $size['stock'] ?? 0,
                        'is_active'  => ($size['stock'] ?? 0) > 0,
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', '✅ Product updated successfully!')
            ->with('highlight_id', $product->id);
    }




    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete(); // 👈 Soft delete
        return redirect()->route('admin.products.index')
            ->with('success', '🕓 Product moved to trash!');
    }





    // 🧹 Trashed Products
    public function trashed()
    {
        $products = Product::onlyTrashed()->with('category')->get();
        return view('backend.products.trashed', compact('products'));
    }




    // ♻️ Restore Product
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('admin.products.trashed')
            ->with('success', '✅ Product restored successfully!');
    }



    // ❌ Permanently Delete Product
    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        // delete all images
        ImageUploadHelper::delete($product->image);
        ImageUploadHelper::delete($product->image_2);
        ImageUploadHelper::delete($product->image_3);
        ImageUploadHelper::delete($product->image_4);
        ImageUploadHelper::delete($product->image_5);

        $product->forceDelete();

        return redirect()->route('admin.products.trashed')
            ->with('success', '🗑️ Product permanently deleted!');
    }
}
