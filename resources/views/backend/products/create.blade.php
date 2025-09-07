@extends('backend.layouts.app')

@section('title', 'Create Product')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Add Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Current Price</label>
                        <input type="number" step="0.01" name="current_price" class="form-control" placeholder="0.00" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Previous Price</label>
                        <input type="number" step="0.01" name="previous_price" class="form-control" placeholder="0.00">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="isOnSale" id="isOnSale" class="form-check-input">
                    <label for="isOnSale" class="form-check-label">On Sale</label>
                </div>

                <button type="submit" class="btn btn-success">Save Product</button>
            </form>
        </div>
    </div>
</div>
@endsection
