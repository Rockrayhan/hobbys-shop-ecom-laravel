@extends('backend.layouts.app')

@section('title', 'All Products')

@section('content')


    <h2>Products</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
    <table>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Sale</th>
            <th>image</th>
        </tr>
        @foreach ($products as $prod)
            <tr>
                <td>{{ $prod->name }}</td>
                <td>{{ $prod->category->name }}</td>
                <td>${{ $prod->current_price }}</td>
                <td>{{ $prod->isOnSale ? 'Yes' : 'No' }}</td>
                <td>
                    @if ($prod->image)
                        <img src="{{ asset($prod->image) }}" width="150">
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

@endsection
