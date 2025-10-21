@extends('backend.layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Edit Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control getTinyMce" rows="3">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Current Price</label>
                        <input type="number" step="0.01" name="current_price" value="{{ old('current_price', $product->current_price) }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Previous Price</label>
                        <input type="number" step="0.01" name="previous_price" value="{{ old('previous_price', $product->previous_price) }}" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" width="100" class="img-thumbnail mb-2">
                    @else
                        <span class="text-muted">No image uploaded</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload New Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="isOnSale" id="isOnSale" class="form-check-input" {{ $product->isOnSale ? 'checked' : '' }}>
                    <label for="isOnSale" class="form-check-label">On Sale</label>
                </div>

                <button type="submit" class="btn btn-success">Update Product</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
