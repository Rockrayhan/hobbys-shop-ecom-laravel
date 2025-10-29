@extends('backend.layouts.app')

@section('title', 'Trashed Products')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>🗑️ Trashed Products</h2>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">← Back to All Products</a>
        </div>

        @if ($products->isEmpty())
            <div class="alert alert-info">No trashed products found.</div>
        @else
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Deleted At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $prod)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($prod->image)
                                    <img src="{{ asset($prod->image) }}" alt="{{ $prod->name }}" width="70"
                                        class="img-thumbnail">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $prod->name }}</td>
                            <td>{{ $prod->category->name ?? 'N/A' }}</td>
                            <td>{{ $prod->deleted_at->format('d M, Y h:i A') }}</td>
                            <td>
                                <form action="{{ route('admin.products.restore', $prod->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        Restore
                                    </button>
                                </form>

                                <form action="{{ route('admin.products.forceDelete', $prod->id) }}" method="POST"
                                    class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                        Permanently Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
