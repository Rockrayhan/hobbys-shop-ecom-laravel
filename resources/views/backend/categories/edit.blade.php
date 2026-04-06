@extends('backend.layouts.app')

@section('title', 'Edit Category')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Edit Category</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                    </div>

                    <!-- Parent -->
                    <div class="mb-3">
                        <label class="form-label">Parent Category</label>
                        <select name="parent_id" class="form-control">
                            <option value="">-- Main Category --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label class="form-label">Category Image</label>
                        <input type="file" name="image" class="form-control">
                        @if ($category->image)
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="img-fluid mt-2" style="max-height: 150px;">
                        @endif
                    </div>

                    <!-- Featured -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="featured_on_home" value="1" class="form-check-input" 
                               {{ $category->featured_on_home ? 'checked' : '' }}>
                        <label class="form-check-label">Show on Home</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Category</button>
                </form>
            </div>
        </div>
    </div>
@endsection