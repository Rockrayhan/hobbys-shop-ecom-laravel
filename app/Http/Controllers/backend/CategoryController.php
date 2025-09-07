<?php

namespace App\Http\Controllers\backend;

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
        return view('backend.categories.create');
    }




    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories']);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category added!');
    }



    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.categories.edit', compact('category'));
    }



    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }



    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Optional: also delete related products if you want
        // $category->products()->delete();

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted!');
    }

    
}
