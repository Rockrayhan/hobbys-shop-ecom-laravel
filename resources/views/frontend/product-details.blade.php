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
    <div class="container mt-5">

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
                {{-- title --}}
                <h2 class="fw-semibold mb-3">{{ $product->name }}</h2>

                {{-- category --}}
                <p class="text-muted mb-2">
                    Category:
                    <span class="fw-semibold text-dark">{{ $product->category->name ?? 'N/A' }}</span>
                </p>

                {{-- price --}}
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

                {{-- Sizes --}}
                @if ($product->variations->count())
                    <div class="mb-4">
                        <label class="fw-semibold d-block mb-2">Select Type:</label>

                        <div id="size-options" class="d-flex flex-wrap gap-2">
                            @foreach ($product->variations as $variation)
                                <button type="button" class="btn btn-outline-dark size-btn" data-id="{{ $variation->id }}"
                                    {{ $variation->stock == 0 ? 'disabled' : '' }}>
                                    {{ $variation->size }}
                                </button>
                            @endforeach
                        </div>

                        <small id="size-error" class="text-danger d-none">Please select a product-type</small>
                    </div>
                @endif

                {{-- prduct description --}}
                <p class="mb-4">
                    {!! $product->description ?? 'No description available.' !!}

                </p>


                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-sm add-to-cart btn-outline-primary px-4 py-2" data-id="{{ $product->id }}"
                        data-name="{{ $product->name }}" data-price="{{ $product->current_price }}"
                        data-image="{{ asset($product->image) }}">

                        <i class="bi bi-cart me-1"></i> Add to cart
                    </button>


                    <a href="#" class="btn btn-primary btn-sm px-4 py-2 buy-now-btn" data-slug="{{ $product->slug }}"
                        data-variation-id="">
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


    {{-- swiper script --}}
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


    {{-- select product variation script --}}
    <script>
        let selectedVariationId = null;

        // handle size click
        document.querySelectorAll('.size-btn').forEach(btn => {
            btn.addEventListener('click', function() {

                // remove active from all
                document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));

                // add active to clicked
                this.classList.add('active');

                // store variation id
                selectedVariationId = this.dataset.id;

                // hide error
                document.getElementById('size-error').classList.add('d-none');
            });
        });
    </script>


    {{-- product details view content --}}
    <script>
        fbq('track', 'ViewContent', {
            content_type: 'product',
            content_ids: ['{{ $product->id }}'],
            content_name: @json($product->name),
            value: {{ $product->current_price }},
            currency: 'BDT'
        });
    </script>


    {{-- add to cart event --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            var addToCartBtn = document.querySelector(".add-to-cart");

            if (addToCartBtn) {
                addToCartBtn.addEventListener("click", function(e) {

                    // ❌ if no size selected
                    if (!selectedVariationId) {
                        e.preventDefault();
                        document.getElementById('size-error').classList.remove('d-none');
                        return;
                    }

                    // ✅ attach variation id
                    this.setAttribute('data-variation-id', selectedVariationId);

                    // FB Pixel
                    fbq('track', 'AddToCart', {
                        content_ids: [this.dataset.id],
                        content_name: this.dataset.name,
                        content_type: 'product',
                        value: this.dataset.price,
                        currency: 'BDT'
                    });

                    console.log("Variation ID:", selectedVariationId);
                });
            }
        });
    </script>


    {{-- buy-now / checkout event --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buyNowBtn = document.querySelector('.buy-now-btn');

            if (buyNowBtn) {
                buyNowBtn.addEventListener('click', function(e) {

                    // ❌ prevent default link behavior
                    e.preventDefault();

                    // ❌ if no size selected
                    if (!selectedVariationId) {
                        document.getElementById('size-error').classList.remove('d-none');
                        return;
                    }

                    // ✅ FB Pixel
                    fbq('track', 'InitiateCheckout', {
                        content_type: 'product',
                        content_ids: ['{{ $product->id }}'],
                        content_name: '{{ $product->name }}',
                        value: {{ $product->current_price }},
                        currency: 'BDT'
                    });

                    // ✅ redirect WITH variation_id
                    const slug = "{{ $product->slug }}";
                    window.location.href = `/checkout?product=${slug}&variation_id=${selectedVariationId}`;
                });
            }
        });
    </script>



@endsection
