<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->paginate(10);
        return view('backend.banners.index', compact('banners'));
    }

    public function create()
    {
        $products = Product::select('id', 'name')->get();
        return view('backend.banners.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'subtitle'   => 'nullable|string',
            'image'      => 'required|image|max:2048',
            'is_active'  => 'boolean',
            'product_id' => 'nullable|exists:products,id',
        ]);

        $slug = Str::slug($request->title);
        $imageName = "{$slug}-" . uniqid() . '.' . $request->file('image')->extension();
        $request->file('image')->move(public_path('uploads/banners'), $imageName);

        Banner::create([
            'title'      => $request->title,
            'subtitle'   => $request->subtitle,
            'image'      => "uploads/banners/{$imageName}",
            'is_active'  => $request->has('is_active') ? 1 : 0,
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('admin.banners.index')
            ->with('success', '✅ Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        $products = Product::select('id', 'name')->get();
        return view('backend.banners.edit', compact('banner', 'products'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'subtitle'   => 'nullable|string',
            'image'      => 'nullable|image|max:2048',
            'is_active'  => 'boolean',
            'product_id' => 'nullable|exists:products,id',
        ]);

        $slug = Str::slug($request->title);

        if ($request->hasFile('image')) {
            if ($banner->image && File::exists(public_path($banner->image))) {
                File::delete(public_path($banner->image));
            }
            $imageName = "{$slug}-" . uniqid() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/banners'), $imageName);
            $banner->image = "uploads/banners/{$imageName}";
        }

        $banner->update([
            'title'      => $request->title,
            'subtitle'   => $request->subtitle,
            'is_active'  => $request->has('is_active') ? 1 : 0,
            'product_id' => $request->product_id,
            'image'      => $banner->image,
        ]);

        return redirect()->route('admin.banners.index')
            ->with('success', '✅ Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image && File::exists(public_path($banner->image))) {
            File::delete(public_path($banner->image));
        }

        $banner->delete();
        return redirect()->route('admin.banners.index')
            ->with('success', '🗑️ Banner deleted successfully.');
    }
}