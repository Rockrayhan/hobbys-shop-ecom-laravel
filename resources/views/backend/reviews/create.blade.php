@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h3 class="fw-bold mb-4">Add New Review</h3>

    <form action="{{ route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Customer Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Add Review</button>
    </form>
</div>
@endsection
