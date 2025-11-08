@extends('backend.layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">Edit Review</h3>

    <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" 
                   value="{{ old('customer_name', $review->customer_name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Customer Image</label>
            <input type="file" name="image" class="form-control">

            @if($review->image)
                <div class="mt-3">
                    <p class="fw-semibold">Current Image:</p>
                    <img src="{{ asset($review->image) }}" alt="Customer" width="120" height="120" class="rounded shadow-sm border">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-success px-4">Update Review</button>
        <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
@endsection
