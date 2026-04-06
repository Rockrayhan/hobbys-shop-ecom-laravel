@extends('backend.layouts.app')

@section('title', 'Create Category')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Add Category</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <!-- Parent -->
                    <div class="mb-3">
                        <label class="form-label">Parent Category</label>
                        <select name="parent_id" class="form-control">
                            <option value="">-- Main Category --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label class="form-label">Category Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <!-- Featured -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="featured_on_home" value="1" class="form-check-input">
                        <label class="form-check-label">Show on Home</label>
                    </div>

                    <button type="submit" class="btn btn-success">Save Category</button>
                </form>
            </div>
        </div>
    </div>
@endsection
