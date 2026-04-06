<?php

namespace App\Http\Controllers\backend;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.categories.index', compact('categories'));
    }




    public function create()
    {
        $categories = Category::whereNull('parent_id')->get(); // get parent categories
        return view('backend.categories.create', compact('categories'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:categories',
            'image' => 'nullable|image|max:4096',
        ]);

        $slug = Str::slug($request->name);

        $category = Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'image' => $request->hasFile('image')
                ? ImageUploadHelper::uploadWebp(
                    $request->file('image'),
                    'uploads/categories',
                    $slug
                )
                : null,
            'featured_on_home' => $request->featured_on_home ? true : false,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', '✅ Category added!')
            ->with('highlight_id', $category->id);
    }



    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::whereNull('parent_id')
            ->where('id', '!=', $id)
            ->get();

        return view('backend.categories.edit', compact('category', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|min:3|unique:categories,name,' . $id,
            'image' => 'nullable|image|max:4096',
        ]);

        $slug = Str::slug($request->name);

        // Replace image if new uploaded
        if ($request->hasFile('image')) {

            // delete old image
            ImageUploadHelper::delete($category->image);

            // upload new image
            $category->image = ImageUploadHelper::uploadWebp(
                $request->file('image'),
                'uploads/categories',
                $slug
            );
        }

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'image' => $category->image,
            'featured_on_home' => $request->featured_on_home ? true : false,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', '✅ Category updated!')
            ->with('highlight_id', $category->id);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);



        // Prevent delete if has products
        if ($category->products()->count() > 0) {
            return back()->with('error', 'This category has products.');
        }

        // Prevent delete if has subcategory
        if ($category->children()->count() > 0) {
            return back()->with('error', 'This category has subcategories.');
        }


        // Delete image
        if ($category->image) {
            ImageUploadHelper::delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', '🗑️ Category deleted!');
    }
}
