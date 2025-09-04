@extends('backend.layouts.app')

@section('title', 'Create Product')

@section('content')

    <h2>Add Product</h2>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <select name="category_id" required>
            <option value="">Select Category</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>

        <input type="text" name="name" placeholder="Product Name" required>
        <textarea name="description" placeholder="Description"></textarea>
        <input type="number" step="0.01" name="current_price" placeholder="Current Price" required>
        <input type="number" step="0.01" name="previous_price" placeholder="Previous Price">
        <input type="file" name="image">
        <label><input type="checkbox" name="isOnSale"> On Sale</label>
        <button type="submit">Save</button>
    </form>

@endsection
