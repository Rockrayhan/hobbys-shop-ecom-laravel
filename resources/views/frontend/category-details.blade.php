@extends('frontend.layouts.app')

@section('title', $category->name . ' Products')

@section('content')
    <div class="container">

        <!-- Category Title -->
        <div class="text-center mb-4">
            <h2 class="fw-bold">{{ $category->name }}</h2>
            <p class="text-muted">Explore our latest products in this category</p>
        </div>

        <!-- Products Grid -->
        <div class="row g-4">
            @forelse ($products as $item)
                <!-- Product Card -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-2 product-item {{ Str::slug($item->category->name) }}">
                    <div class="product-card position-relative bg-white rounded-3 overflow-hidden shadow-sm h-100">

                        <!-- Product Image -->
                        <div class="image-holder position-relative overflow-hidden">
                            <a href="{{ route('product.details', $item->slug) }}" class="d-block">
                                @if ($item->image)
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->name }}"
                                        class="product-img w-100 object-fit-cover">
                                @else
                                    <span class="text-muted d-block text-center py-5">No Image</span>
                                @endif
                            </a>

                            <!-- Discount Price -->
                            @if ($item->previous_price > 0 && $item->previous_price > $item->current_price)
                                <span class="discount-price">
                                    {{ number_format($item->previous_price - $item->current_price, 0) }}৳ OFF
                                </span>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="product-content p-3">
                            <h5 class="element-title text-uppercase fw-semibold fs-6 mb-3 ">
                                <a href="{{ route('product.details', $item->slug) }}"
                                    class="text-dark text-decoration-none">
                                    {{ $item->name }}
                                </a>
                            </h5>

                            <div class="mb-3">
                                <span class="fw-bold text-primary fs-5">
                                    {{ fmod($item['current_price'], 1) == 0
                                        ? number_format($item['current_price'], 0)
                                        : number_format($item['current_price'], 2) }}
                                    ৳
                                </span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between">
                                <button class="btn btn-sm add-to-cart px-3 py-2" data-id="{{ $item->id }}"
                                    data-name="{{ $item->name }}" data-price="{{ $item->current_price }}"
                                    data-image="{{ asset($item->image) }}">
                                    <i class="bi bi-cart me-1"></i> Add to cart
                                </button>

                                <a href="{{ route('checkout.form', ['product' => $item->slug]) }}"
                                    class="btn btn-primary btn-sm px-4 py-2">
                                    Buy Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No products found in this category.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>

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
