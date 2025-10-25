@extends('frontend.layouts.app')


@section('content')

    <style>
        .mySwiper2 {
            width: 100%;
            height: 400px;
        }

        .mySwiper2 img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .mySwiper {
            height: 100px;
            box-sizing: border-box;
        }

        .mySwiper .swiper-slide {
            width: 25%;
            opacity: 0.5;
            cursor: pointer;
        }

        .mySwiper .swiper-slide-thumb-active {
            opacity: 1;
        }

        .mySwiper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
    <div class="container py-5 mt-5">

        <!-- Product Details -->
        <div class="row g-4 align-items-start">
            <!-- Left: Image -->
            <div class="col-md-5">


                <div class="bg-white p-3 rounded-3 shadow-sm">
                    @php
                        $images = collect([
                            $product->image,
                            $product->image_2,
                            $product->image_3,
                            $product->image_4,
                            $product->image_5,
                        ])->filter();
                    @endphp

                    @if ($images->isNotEmpty())
                        <!-- Main Swiper -->
                        <div class="swiper mySwiper2 mb-3">
                            <div class="swiper-wrapper">
                                @foreach ($images as $img)
                                    <div class="swiper-slide">
                                        <img src="{{ asset($img) }}" alt="{{ $product->name }}"
                                            class="img-fluid w-100 rounded">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Thumbs Swiper -->
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach ($images as $img)
                                    <div class="swiper-slide">
                                        <img src="{{ asset($img) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <span class="text-muted d-block text-center py-5">No Image</span>
                    @endif
                </div>



            </div>

            <!-- Right: Details -->
            <div class="col-md-7">
                <h2 class="fw-semibold mb-3">{{ $product->name }}</h2>

                <p class="text-muted mb-2">
                    Category:
                    <span class="fw-semibold text-dark">{{ $product->category->name ?? 'N/A' }}</span>
                </p>

                <div class="mb-3">
                    @if ($product->previous_price > 0 && $product->previous_price > $product->current_price)
                        <span class="text-decoration-line-through text-muted me-2">
                            {{ number_format($product->previous_price, 0) }}৳
                        </span>
                    @endif

                    <span class="fw-bold text-primary fs-4">
                        {{ fmod($product->current_price, 1) == 0
                            ? number_format($product->current_price, 0)
                            : number_format($product->current_price, 2) }}৳
                    </span>
                </div>

                <p class="mb-4">
                    {!! $product->description ?? 'No description available.' !!}

                </p>

                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-sm add-to-cart btn-outline-primary px-4 py-2" data-id="{{ $product->id }}"
                        data-name="{{ $product->name }}" data-price="{{ $product->current_price }}"
                        data-image="{{ asset($product->image) }}">
                        <i class="bi bi-cart me-1"></i> Add to cart
                    </button>


                    <a href="{{ route('checkout.form', ['product' => $product->slug]) }}"
                        class="btn btn-primary btn-sm px-4 py-2">
                        Buy Now
                    </a>

                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if ($relatedProducts->count() > 0)
            <div class="mt-5">
                <h4 class="fw-semibold mb-4">Related Products</h4>
                <div class="row">
                    @foreach ($relatedProducts as $item)
                        <div class="col-6 col-md-3 mb-4">
                            <div class="product-card bg-white rounded-3 shadow-sm h-100">
                                <div class="image-holder">
                                    <a href="{{ route('product.details', $item->slug) }}">
                                        <img src="{{ asset($item->image) }}" class="w-100 object-fit-cover rounded-top">
                                    </a>
                                </div>
                                <div class="p-3">
                                    <h6 class="fw-semibold mb-2">
                                        <a href="{{ route('product.details', $item->slug) }}"
                                            class="text-dark text-decoration-none">
                                            {{ Str::limit($item->name, 25) }}
                                        </a>
                                    </h6>
                                    <span class="fw-bold text-primary">
                                        {{ number_format($item->current_price, 0) }}৳
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var swiperThumbs = new Swiper(".mySwiper", {
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesProgress: true,
            });
            var swiperMain = new Swiper(".mySwiper2", {
                spaceBetween: 10,
                thumbs: {
                    swiper: swiperThumbs,
                },
            });
        });
    </script>

@endsection
