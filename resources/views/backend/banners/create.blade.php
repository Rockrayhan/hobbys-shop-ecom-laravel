@extends('backend.layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold">Add New Banner</h3>

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data"
        class="border rounded p-4 bg-light shadow-sm">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Subtitle</label>
                <input type="text" name="subtitle" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Banner Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Link to Product (Optional)</label>
            <select name="product_id" class="form-select">
                <option value="">-- None --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-check form-switch mb-4">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
            <label class="form-check-label fw-semibold">Active</label>
        </div>

        <button type="submit" class="btn btn-primary px-4">Save Banner</button>
    </form>
</div>
@endsection
