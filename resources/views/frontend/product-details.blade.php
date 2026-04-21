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





        /* related products */
        .product-card {
            transition: all 0.25s ease;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .product-img {
            height: 180px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-img {
            transform: scale(1.05);
        }


        @media (max-width: 576px) {
            .product-img {
                height: 140px;
            }

            .product-card h6 {
                font-size: 13px;
            }
        }


    </style>
    <div class="container pt-3 mt-5">

        <!-- Product showcase -->
        <div class="row g-4 align-items-start">
            <!-- Left: Image -->
            <div class="col-md-6">

                {{-- bradcrump --}}
                    @php
                        function getCategoryPath($category)
                        {
                            $path = [];
                            while ($category) {
                                array_unshift($path, $category);
                                $category = $category->parent;
                            }
                            return $path;
                        }

                        $categoryPath = $product->category ? getCategoryPath($product->category) : [];
                    @endphp

                    @if (count($categoryPath))
                        <div class="small px-2 py-1">

                            @foreach ($categoryPath as $index => $cat)
                                <a href="{{ route('category.details', $cat->slug) }}"
                                    class="text-decoration-none text-muted fw-medium">
                                    {{ $cat->name }}
                                </a>

                                @if (!$loop->last)
                                    <span class="mx-1">›</span>
                                @endif
                            @endforeach

                        </div>
                    @endif
              

                <div class="p-2 rounded-3 shadow-sm">
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
            <div class="col-md-6">
                {{-- title --}}
                <h2 class="fw-semibold mb-3 display-5">{{ $product->name }}</h2>

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

        <!-- Product Details -->
        <div class="card p-3 shadow mt-5">
            {{-- prduct description --}}
            <h4 class="font-semibold font-underline border-bottom border-2 pb-2"> Description </h4>
            {{-- <hr> --}}
            <p>
                {!! $product->description ?? 'No description available.' !!}
            </p>
        </div>

        <!-- Related Products -->
        @if ($relatedProducts->count() > 0)
            <div class="mt-5 pt-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0">Related Products</h4>
                    <a href="{{ route('all-products') }}" class="small text-decoration-none text-primary">
                        View All →
                    </a>
                </div>

                <div class="row g-3">
                    @foreach ($relatedProducts as $item)
                        <div class="col-6 col-md-3 h-75">
                            <div class="product-card bg-white rounded-4 shadow-sm  border-0">

                                <!-- Image -->
                                <div class="position-relative overflow-hidden rounded-top">
                                    <a href="{{ route('product.details', $item->slug) }}">
                                        <img src="{{ asset($item->image) }}" class="w-100 product-img"
                                            alt="{{ $item->name }}">
                                    </a>

                                    {{-- Discount badge --}}
                                    @if ($item->previous_price > $item->current_price)
                                        <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                            {{ round((($item->previous_price - $item->current_price) / $item->previous_price) * 100) }}%
                                            OFF
                                        </span>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="p-3 d-flex flex-column">

                                    <h6 class="fw-semibold mb-2 flex-grow-1">
                                        <a href="{{ route('product.details', $item->slug) }}"
                                            class="text-dark text-decoration-none">
                                            {{ Str::limit($item->name, 40) }}
                                        </a>
                                    </h6>

                                    <!-- Price -->
                                    <div class="mb-2">
                                        @if ($item->previous_price > $item->current_price)
                                            <small class="text-muted text-decoration-line-through me-1">
                                                {{ number_format($item->previous_price, 0) }}৳
                                            </small>
                                        @endif

                                        <span class="fw-bold text-danger">
                                            {{ number_format($item->current_price, 0) }}৳
                                        </span>
                                    </div>

                                    <!-- CTA -->
                                    <a href="{{ route('product.details', $item->slug) }}"
                                        class="btn btn-sm btn-outline-primary w-100">
                                        View Details
                                    </a>

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

            let selectedVariationId = null;

            // Handle size/variation selection
            document.querySelectorAll('.size-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active from all
                    document.querySelectorAll('.size-btn').forEach(b => b.classList.remove(
                        'active'));

                    // Add active to clicked
                    this.classList.add('active');

                    // Store selected variation ID
                    selectedVariationId = this.dataset.id;

                    // Hide error
                    document.getElementById('size-error').classList.add('d-none');

                    // Mark Add to Cart button as valid
                    const addBtn = document.querySelector('.add-to-cart');
                    if (addBtn) addBtn.dataset.valid = "true";
                });
            });

            // Add to Cart button click (validation only)
            const addToCartBtn = document.querySelector(".add-to-cart");
            if (addToCartBtn) {
                addToCartBtn.addEventListener("click", function(e) {

                    // If product has variations but none selected
                    if (document.querySelectorAll('.size-btn').length && !selectedVariationId) {
                        e.preventDefault();
                        document.getElementById('size-error').classList.remove('d-none');

                        // Mark invalid to prevent global handler
                        this.dataset.valid = "false";
                        return;
                    }

                    // Attach variation ID for global handler
                    this.dataset.variationId = selectedVariationId;
                    this.dataset.valid = "true";

                    // FB Pixel
                    fbq('track', 'AddToCart', {
                        content_ids: [this.dataset.id],
                        content_name: this.dataset.name,
                        content_type: 'product',
                        value: this.dataset.price,
                        currency: 'BDT'
                    });
                });
            }
        });
    </script>




    {{-- buy-now / checkout event new --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buyNowBtn = document.querySelector('.buy-now-btn');

            if (buyNowBtn) {
                buyNowBtn.addEventListener('click', function(e) {

                    e.preventDefault();

                    const hasVariations = document.querySelectorAll('.size-btn').length > 0;

                    // ❌ Only block if variations exist AND none selected
                    if (hasVariations && !selectedVariationId) {
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

                    const slug = "{{ $product->slug }}";

                    // ✅ Build URL properly
                    let url = `/checkout?product=${slug}`;

                    // only add variation if exists
                    if (selectedVariationId) {
                        url += `&variation_id=${selectedVariationId}`;
                    }

                    window.location.href = url;
                });
            }
        });
    </script>


@endsection
