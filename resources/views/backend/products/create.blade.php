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

                    {{-- Category --}}
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
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
                        <input type="text" name="name" class="form-control" placeholder="Enter product name"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control getTinyMce" rows="3" placeholder="Enter description">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Prices --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Current Price</label>
                            <input type="number" step="0.01" name="current_price" class="form-control"
                                placeholder="0.00" value="{{ old('current_price') }}" required>
                            @error('current_price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Previous Price</label>
                            <input type="number" step="0.01" name="previous_price" class="form-control"
                                placeholder="0.00" value="{{ old('previous_price') }}">
                            @error('previous_price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Images --}}
                    <div class="row">
                        @for ($i = 1; $i <= 5; $i++)
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Image {{ $i }}</label>
                                <input type="file" name="{{ $i == 1 ? 'image' : 'image_' . $i }}" class="form-control">
                                @error($i == 1 ? 'image' : 'image_' . $i)
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @endfor
                    </div>


                    {{-- On Sale --}}
                    <div class="form-check mb-3">
                        <input type="checkbox" name="isOnSale" id="isOnSale" class="form-check-input"
                            {{ old('isOnSale') ? 'checked' : '' }}>
                        <label for="isOnSale" class="form-check-label">On Sale</label>
                    </div>

                    <button type="submit" class="btn btn-success">Save Product</button>
                </form>
            </div>
        </div>
    </div>
@endsection
