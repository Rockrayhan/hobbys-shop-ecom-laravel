@extends('backend.layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">All Banners</h3>
            <a href="{{ route('admin.banners.create') }}" class="btn btn-success">+ Add New</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive shadow-sm bg-light rounded">
            <table class="table align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Linked Product</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($banners as $banner)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($banner->image) }}" width="80" class="rounded"></td>

                            <td>{{ $banner->title }}</td>
                            <td>
                                <span class="badge {{ $banner->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $banner->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $banner->product?->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.banners.edit', $banner->id) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this banner?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">No banners found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $banners->links() }}
        </div>
    </div>
@endsection
