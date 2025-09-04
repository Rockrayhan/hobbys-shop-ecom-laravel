@extends('backend.layouts.app')

@section('title', 'All Categories')

@section('content')

    <h2>Categories</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add Category</a>
    <ul>
        @foreach ($categories as $cat)
            <li>{{ $cat->name }} ({{ $cat->slug }})</li>
        @endforeach
    </ul>

    
@endsection
