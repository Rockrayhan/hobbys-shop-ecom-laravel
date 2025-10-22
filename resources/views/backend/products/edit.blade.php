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
                {{-- Category --}}
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" 
                                {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Product Name --}}
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" 
                        value="{{ old('name', $product->name) }}" 
                        class="form-control" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control getTinyMce" rows="3">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Prices --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Current Price</label>
                        <input type="number" step="0.01" name="current_price" 
                            value="{{ old('current_price', $product->current_price) }}" 
                            class="form-control" required>
                        @error('current_price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Previous Price</label>
                        <input type="number" step="0.01" name="previous_price" 
                            value="{{ old('previous_price', $product->previous_price) }}" 
                            class="form-control">
                        @error('previous_price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Current Image --}}
                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" width="100" class="img-thumbnail mb-2">
                    @else
                        <span class="text-muted">No image uploaded</span>
                    @endif
                </div>

                {{-- New Image Upload --}}
                <div class="mb-3">
                    <label class="form-label">Upload New Image</label>
                    <input type="file" name="image" class="form-control">
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- On Sale --}}
                <div class="form-check mb-3">
                    <input type="checkbox" name="isOnSale" id="isOnSale" 
                        class="form-check-input" 
                        {{ old('isOnSale', $product->isOnSale) ? 'checked' : '' }}>
                    <label for="isOnSale" class="form-check-label">On Sale</label>
                </div>

                {{-- Buttons --}}
                <button type="submit" class="btn btn-success">Update Product</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
