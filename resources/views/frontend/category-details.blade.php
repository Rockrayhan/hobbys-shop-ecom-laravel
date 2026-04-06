@extends('frontend.layouts.app')

@section('title', $category->name . ' Products')

@section('content')
    <div class="container">

        <!-- Category Title -->
        <div class="text-center mb-4">
            <h2 class="fw-bold">{{ $category->name }}</h2>
            <p class="text-muted">Explore our latest products in this category</p>
        </div>



        <!-- Products section -->
        @include('frontend.components.product_section', [
            'products' => $products,
            'categories' => $filterCategories,
            'title' => $category->name . ' Products',
        ])





        <!-- Related Categories -->
        @if ($relatedCategories->count())
            <div class="mt-5">
                <h5 class="fw-semibold mb-3">Other Categories</h5>
                <ul class="list-inline">
                    @foreach ($relatedCategories as $cat)
                        <li class="list-inline-item">
                            <a href="{{ route('category.details', $cat->slug) }}" class="btn btn-light border">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
