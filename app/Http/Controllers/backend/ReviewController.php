<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    // 📋 Show All Reviews
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('backend.reviews.index', compact('reviews'));
    }

    // ➕ Create Form
    public function create()
    {
        return view('backend.reviews.create');
    }

    // 💾 Store Review
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'image'         => 'nullable|image|max:2048',
        ]);

        $data = [
            'customer_name' => $request->customer_name,
        ];

        if ($request->hasFile('image')) {
            $slug = Str::slug($request->customer_name);
            $imageName = "{$slug}-" . uniqid() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/reviews'), $imageName);
            $data['image'] = "uploads/reviews/{$imageName}";
        }

        Review::create($data);

        return redirect()->route('admin.reviews.index')
            ->with('success', '✅ Review added successfully.');
    }

    // ✏️ Edit Form
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('backend.reviews.edit', compact('review'));
    }

    // 🔁 Update Review
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'image'         => 'nullable|image|max:2048',
        ]);

        $data = ['customer_name' => $request->customer_name];

        if ($request->hasFile('image')) {
            // delete old image
            if ($review->image && file_exists(public_path($review->image))) {
                unlink(public_path($review->image));
            }

            $slug = Str::slug($request->customer_name);
            $imageName = "{$slug}-" . uniqid() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/reviews'), $imageName);
            $data['image'] = "uploads/reviews/{$imageName}";
        }

        $review->update($data);

        return redirect()->route('admin.reviews.index')
            ->with('success', '✅ Review updated successfully.');
    }

    // ❌ Delete Review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if ($review->image && file_exists(public_path($review->image))) {
            unlink(public_path($review->image));
        }

        $review->delete();

        return redirect()->route('admin.reviews.index')
            ->with('success', '🗑️ Review deleted successfully.');
    }
}