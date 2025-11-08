@extends('backend.layouts.app')

@section('content')
    <div class="container py-4">
        <h3 class="mb-4 fw-bold">Edit Banner</h3>

        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data"
            class="border rounded p-4 bg-light shadow-sm">
            @csrf
            @method('PUT')

            {{-- Title & Subtitle --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title) }}"
                        required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control"
                        value="{{ old('subtitle', $banner->subtitle) }}">
                </div>
            </div>

            {{-- Image Upload --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Banner Image</label>
                <input type="file" name="image" class="form-control">

                @if ($banner->image)
                    <div class="mt-3">
                        <p class="fw-semibold mb-1">Current Image:</p>
                        <img src="{{ asset($banner->image) }}" alt="Banner Image" class="img-thumbnail rounded shadow-sm"
                            style="height: 120px; width: auto;">
                    </div>
                @endif
            </div>

            {{-- Product Link --}}
            <div class="mb-3 w-50">
                <label class="form-label fw-semibold"> Link to Product </label>
                <select name="product_id" class="form-select">
                    <option value="">-- None --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ $banner->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Active Toggle --}}
            <div class="form-check form-switch mb-4">
                <input class="form-check-input" type="checkbox" name="is_active" value="1"
                    {{ $banner->is_active ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold">Active</label>
            </div>

            {{-- Buttons --}}
            <button type="submit" class="btn btn-success px-4">Update Banner</button>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>
@endsection
