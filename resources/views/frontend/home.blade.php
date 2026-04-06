@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')


    <style>
        .testimonial-item {
            transition: all 0.3s ease-in-out;
        }

        .testimonial-item:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .review-img img {
            transition: transform 0.4s ease;
        }

        .review-img img:hover {
            transform: scale(1.03);
        }
    </style>


    {{-- banner --}}
    {{-- <section id="billboard" class="bg-secondary-subtle two-column-swiper slide-clip slide-in pt-4 banner">
        <div class="container">
            <div class="row">
                <div class="swiper overflow-hidden">
                    <div class="swiper-wrapper">
                        @forelse ($banners as $banner)
                            <div class="swiper-slide center">
                                <div class="row banner-item text-center align-items-center">
                                    <div class="col-lg-6">
                                        <div class="image-holder">
                                            <img src="{{ asset($banner->image) }}" alt="product"
                                                class="banner-img img-fluid">
                                        </div>
                                    </div>
                                    <div class="banner-content col-lg-6 p-5">
                                        <h2 class="fw-bold text-uppercase txt-fx slide-up">{{ $banner->title }}
                                        </h2>

                                        @if ($banner->subtitle)
                                            <p class=" text-secondary">{{ $banner->subtitle }}</p>
                                        @endif

                                        @if ($banner->product)
                                            <div>
                                                <a href="{{ route('product.details', $banner->product->slug) }}"
                                                    class="btn btn-outline-dark text-uppercase mt-3 px-5">
                                                    Explore Now
                                                </a>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @empty
                            
                            <div class="swiper-slide">
                                <div class="row banner-item text-center align-items-center">
                                    <div class="col-lg-6">
                                        <div class="image-holder">
                                            <img src="{{ asset('images/two-col-banner-2.png') }}" alt="product"
                                                class="banner-img img-fluid">
                                        </div>
                                    </div>
                                    <div class="banner-content col-lg-6 p-5">
                                        <h2 class="display-2 fw-bold text-uppercase txt-fx slide-up"> Crafted for Perfection
                                        </h2>
                                        <p>Discover the world's finest luxury timepieces, where precision meets artistry.
                                        </p>
                                        <a href="#" class="btn btn-outline-dark text-uppercase mt-3">Explore the
                                            Collections</a>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="icon-arrow icon-arrow-left"><svg width="50" height="50" viewBox="0 0 24 24">
                        <use xlink:href="#angle-left"></use>
                    </svg></div>
                <div class="icon-arrow icon-arrow-right"><svg width="50" height="50" viewBox="0 0 24 24">
                        <use xlink:href="#angle-right"></use>
                    </svg></div>
            </div>
        </div>
    </section> --}}


    {{-- banner --}}
    <section id="billboard" class="bg-secondary-subtle two-column-swiper slide-clip slide-in pt-4 banner">
        <div class="container">
            <div class="row">
                <div class="swiper overflow-hidden">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="row banner-item text-center align-items-center">
                                <div class="col-lg-6">
                                    <div class="image-holder">
                                        <img src="{{ asset('images/two-col-banner-2.png') }}" alt="product"
                                            class="banner-img img-fluid">
                                    </div>
                                </div>


                                <div class="banner-content col-lg-6 p-5">
                                    <h2 class="display-2 fw-bold text-uppercase txt-fx slide-up">Crafted for Perfection</h2>
                                    <p>For those who appreciate timeless sophistication—sleek designs with refined
                                        details, powered by mechanical mastery.</p>
                                    <a href="{{route('all-products')}}" class="btn btn-outline-dark text-uppercase mt-3">Explore the
                                        Collections</a>
                                </div>


                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="row banner-item text-center align-items-center">
                                <div class="col-lg-6">
                                    <div class="image-holder">
                                        <img src="images/two-col-banner-3.png" alt="product" class=" banner-img img-fluid">
                                    </div>
                                </div>
                                <div class="banner-content col-lg-6 p-5">
                                    <h2 class="display-2 fw-bold text-uppercase txt-fx slide-up">Classic Elegance</h2>
                                    <p>For those who appreciate timeless sophistication—sleek designs with refined
                                        details, powered by mechanical mastery.</p>
                                    <a href="{{route('all-products')}}" class="btn btn-outline-dark text-uppercase mt-3">Explore the
                                        Collections</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="row banner-item text-center align-items-center">
                                <div class="col-lg-6">
                                    <div class="image-holder">
                                        <img src="images/two-col-banner-1.png" alt="product" class=" banner-img img-fluid">
                                    </div>
                                </div>
                                <div class="banner-content col-lg-6 p-5">
                                    <h2 class="display-2 fw-bold text-uppercase txt-fx slide-up">Sport & Adventure</h2>
                                    <p>Engineered for precision under pressure—robust, high-performance watches for the
                                        modern explorer.</p>
                                    <a href="{{route('all-products')}}" class="btn btn-outline-dark text-uppercase mt-3">Explore the
                                        Collections</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="icon-arrow icon-arrow-left"><svg width="50" height="50" viewBox="0 0 24 24">
                        <use xlink:href="#angle-left"></use>
                    </svg></div>
                <div class="icon-arrow icon-arrow-right"><svg width="50" height="50" viewBox="0 0 24 24">
                        <use xlink:href="#angle-right"></use>
                    </svg></div>
            </div>
        </div>
    </section>




    {{-- categories --}}
    <section class="categories full-width-container overflow-hidden pb-5 slide-clip-animation" data-aos="fade-in">
        <div class="row d-flex flex-wrap g-0">
            @forelse ($featuredCategories as $cat)
                <div class="col-md-4 col-sm-6">
                    <div class="cat-item image-zoom-effect position-relative">
                        <div class="image-holder">
                            <a href="{{ route('category.details', $cat->slug) }}">
                                <img src="{{ $cat->image ? asset($cat->image) : asset('images/default-category.jpg') }}"
                                    alt="{{ $cat->name }}" class="category-image img-fluid w-100">
                                    <div class="category-content position-absolute bottom-0 p-5 text-uppercase bg-gradient">
                                        <h4 class="section-title text-white">{{ $cat->name }}</h4>
                                    </div>
                                </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No featured categories to display.</p>
                </div>
            @endforelse
        </div>
    </section>



    {{-- products section --}}

    @include('frontend.components.product_section', [
        'products' => $products,
        'categories' => $categories, // only top-level categories
        'title' => 'Our Products',
    ])



    {{-- testimonials --}}
    <section class="testimonials py-5">
        <div class="section-header text-center mb-4">
            <h3 class="section-title text-uppercase fs-2">Our Reviews</h3>
        </div>

        <div class="swiper testimonial-swiper overflow-hidden px-5 py-4">
            <div class="swiper-wrapper d-flex">
                @forelse ($reviews as $review)
                    <div class="swiper-slide">
                        <div
                            class="testimonial-item text-center p-4 bg-white shadow-sm rounded-4 border border-light-subtle">
                            <div class="review-img mb-3">
                                <img src="{{ asset($review->image ?? 'images/default-user.png') }}"
                                    alt="{{ $review->customer_name }}" class="img-fluid rounded-3 shadow-sm border"
                                    style="object-fit: cover; width: 320px; height: 220px;">
                            </div>

                            <blockquote class="mt-3">
                                <h5 class="fw-bold text-uppercase text-dark mb-1">
                                    {{ $review->customer_name }}
                                </h5>
                            </blockquote>

                            {{-- ⭐ Rating display --}}
                            <div class="text-warning mt-2">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="bi bi-star-fill fs-5"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- 🔹 Static demo reviews (show when DB has none) --}}
                    @foreach ([['img' => 'images/demo-review-1.jpg', 'name' => 'John Doe', 'text' => 'Superb quality! The detail and comfort exceeded my expectations.'], ['img' => 'images/demo-review-2.jpg', 'name' => 'Sarah Williams', 'text' => 'Stylish and elegant. Perfect fit and finish!'], ['img' => 'images/demo-review-3.jpg', 'name' => 'David Kim', 'text' => 'Fast shipping and great experience overall.']] as $demo)
                        <div class="swiper-slide">
                            <div
                                class="testimonial-item text-center p-4 bg-white shadow-sm rounded-4 border border-light-subtle">
                                <div class="review-img mb-3">
                                    <img src="{{ asset($demo['img']) }}" alt="{{ $demo['name'] }}"
                                        class="img-fluid rounded-3 shadow-sm border"
                                        style="object-fit: cover; width: 320px; height: 220px;">
                                </div>

                                <blockquote class="mt-3">
                                    <h5 class="fw-bold text-uppercase text-dark mb-1">{{ $demo['name'] }}</h5>
                                    <p class="text-muted fst-italic small">“{{ $demo['text'] }}”</p>
                                </blockquote>

                                <div class="text-warning mt-2">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="bi bi-star-fill fs-5"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>

            {{-- Swiper Pagination --}}
            <div class="swiper-pagination mt-3"></div>
        </div>


    </section>







    {{-- brand logo --}}
    <section class="logo-bar py-5 my-5">
        <div class="container">
            <div class="row">
                <div class="logo-content d-flex flex-wrap justify-content-between">
                    <img src="images/logo1.png" alt="logo" class="logo-image img-fluid">
                    <img src="images/logo2.png" alt="logo" class="logo-image img-fluid">
                    <img src="images/logo3.png" alt="logo" class="logo-image img-fluid">
                    <img src="images/logo4.png" alt="logo" class="logo-image img-fluid">
                    <img src="images/logo5.png" alt="logo" class="logo-image img-fluid">
                </div>
            </div>
        </div>
    </section>






@endsection
