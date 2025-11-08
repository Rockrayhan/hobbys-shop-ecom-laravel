@extends('backend.layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Customer Reviews</h3>
        <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary">+ Add Review</a>
    </div>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Image</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reviews as $review)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $review->customer_name }}</td>
                <td>
                    @if($review->image)
                        <img src="{{ asset($review->image) }}" width="60" height="60" class="rounded border">
                    @else
                        <span class="text-muted">No image</span>
                    @endif
                </td>
                <td class="d-flex gap-2">
                    <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No reviews found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
