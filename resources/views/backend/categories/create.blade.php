@extends('backend.layouts.app')

@section('title', 'Create Category')

@section('content')


    <div>
        <h2>Add Category</h2>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Category Name" required>
            <button type="submit">Save</button>
        </form>

    </div>

@endsection
