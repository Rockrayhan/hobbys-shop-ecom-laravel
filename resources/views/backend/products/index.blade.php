@extends('backend.layouts.app')

@section('title', 'All Products')

@section('content')
    <div class="container mt-4">



        <div class="d-flex justify-content-between align-items-center mb-3 sticky-top bg-light p-3"
            style="top: 6rem; z-index: 1000;">
            <h2>Products</h2>

            <form method="GET" action="{{ route('admin.products.index') }}" class="d-flex align-items-center gap-2 mb-0">
                <label for="category_id" class="mb-0 fw-semibold">Filter by Category:</label>
                <select name="category_id" id="category_id" class="form-select form-select-sm d-inline-block w-auto shadow"
                    onchange="this.form.submit()">
                    <option value="all">All</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>


            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
        </div>




        @php
            $highlightId = session('highlight_id');
        @endphp

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Current Price</th>
                    <th>On Sale</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $prod)
                    <tr @if ($highlightId == $prod->id) id="highlight-row" class="table-success" @endif>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $prod->name }}</td>
                        <td>{{ $prod->category->name }}</td>
                        <td>{{ number_format($prod->current_price, 2) }} bdt</td>
                        <td>
                            @if ($prod->isOnSale)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td>
                            @if ($prod->image)
                                <img src="{{ asset($prod->image) }}" alt="{{ $prod->name }}" width="70"
                                    class="img-thumbnail">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $prod->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.products.destroy', $prod->id) }}" method="POST"
                                class="delete-form d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>

    </div>
@endsection
