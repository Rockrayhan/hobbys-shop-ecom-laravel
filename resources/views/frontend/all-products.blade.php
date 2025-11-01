@extends('frontend.layouts.app')

@section('title', 'All Products')

@section('content')
    <div class="container">

        <h3 class="text-center"> All products </h3>

        {{-- all products nav tab --}}
        <section class="product-grid clearfix">
            <div class="container">
                <div class="row">

                    <div id="filters" class="button-group d-flex gap-4 justify-content-center py-5">
                        <a href="#" class="btn-link text-uppercase is-checked" data-filter="*">All</a>
                        @foreach ($categories as $cat)
                            <a href="#" class="btn-link text-uppercase" data-filter=".{{ Str::slug($cat->name) }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>


                    <div class="grid p-0 clearfix">
                        @foreach ($products as $item)
                            <!-- Product Card -->
                            <div
                                class="col-12 col-sm-6 col-md-4 col-lg-3 p-2 product-item {{ Str::slug($item->category->name) }}">
                                <div
                                    class="product-card position-relative bg-white rounded-3 overflow-hidden shadow-sm h-100">

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
                        @endforeach


                    </div>

                </div>
            </div>
        </section>



    </div>

@endsection
