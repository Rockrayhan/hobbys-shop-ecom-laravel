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
    <section id="billboard" class="bg-secondary-subtle two-column-swiper slide-clip slide-in pt-4 banner">
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
                            {{-- if no banner found --}}
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
    </section>


    {{-- categoires --}}
    <section class="categories full-width-container overflow-hidden pb-5 slide-clip-animation" data-aos="fade-in">
        <div class="row d-flex flex-wrap g-0">
            <div class="col-md-4 col-sm-6">
                <div class="cat-item image-zoom-effect position-relative">
                    <div class="image-holder">
                        <a href="shop-four-column-wide.html"><img src="{{ asset('images/category-banner-3.jpg') }}"
                                alt="categories" class="product-image img-fluid"></a>
                        <div class="category-content position-absolute bottom-0 p-5 text-uppercase">
                            <h4 class="section-title text-white">For Men</h4>
                            <a href="shop-four-column-wide.html" class="text-white btn-link">Shop it Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="cat-item image-zoom-effect position-relative">
                    <div class="image-holder">
                        <a href="shop-four-column-wide.html"><img src="{{ asset('images/category-banner-1.jpg') }}"
                                alt="categories" class="product-image img-fluid"></a>
                        <div class="category-content position-absolute bottom-0 p-5 text-uppercase">
                            <h4 class="section-title text-white">For Women</h4>
                            <a href="shop-four-column-wide.html" class="text-white btn-link">Shop it Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="cat-item image-zoom-effect position-relative">
                    <div class="image-holder">
                        <a href="shop-four-column-wide.html"><img src="{{ asset('images/category-banner-2.jpg') }}"
                                alt="categories" class="product-image img-fluid"></a>
                        <div class="category-content position-absolute bottom-0 p-5 text-uppercase bg-dark bg-gradient">
                            <h4 class="section-title text-white">For Accessories</h4>
                            <a href="shop-four-column-wide.html" class="text-white btn-link">Shop it Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    {{-- all products nav tab --}}
    <section class="product-grid py-5 clearfix">
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
                    @endforeach


                </div>

            </div>
        </div>
    </section>





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







    {{-- blogs --}}
    <section class="blog py-5">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
                <h4 class="text-uppercase">Read Blog Posts</h4>
                <a href="blog-classic.html" class="btn-link">View All</a>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <article class="post-item">
                        <div class="post-image">
                            <a href="single-post.html">
                                <img src="images/post-image1.jpg" alt="image" class="post-grid-image img-fluid">
                            </a>
                        </div>
                        <div class="post-content d-flex flex-wrap gap-2 my-3">
                            <div class="post-meta text-uppercase fs-6 text-secondary">
                                <span class="post-category">Fashion /</span>
                                <span class="meta-day"> jul 11, 2022</span>
                            </div>
                            <h5 class="post-title text-uppercase">
                                <a href="single-post.html">How to look outstanding in pastel</a>
                            </h5>
                            <p>Dignissim lacus,turpis ut suspendisse vel tellus.Turpis purus,gravida orci,fringilla...
                            </p>
                        </div>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="post-item">
                        <div class="post-image">
                            <a href="single-post.html">
                                <img src="images/post-image2.jpg" alt="image" class="post-grid-image img-fluid">
                            </a>
                        </div>
                        <div class="post-content d-flex flex-wrap gap-2 my-3">
                            <div class="post-meta text-uppercase fs-6 text-secondary">
                                <span class="post-category">Fashion /</span>
                                <span class="meta-day"> jul 11, 2022</span>
                            </div>
                            <h5 class="post-title text-uppercase">
                                <a href="single-post.html">Top 10 fashion trend for summer</a>
                            </h5>
                            <p>Turpis purus, gravida orci, fringilla dignissim lacus, turpis ut suspendisse vel
                                tellus...</p>
                        </div>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="post-item">
                        <div class="post-image">
                            <a href="single-post.html">
                                <img src="images/post-image3.jpg" alt="image" class="post-grid-image img-fluid">
                            </a>
                        </div>
                        <div class="post-content d-flex flex-wrap gap-2 my-3">
                            <div class="post-meta text-uppercase fs-6 text-secondary">
                                <span class="post-category">Fashion /</span>
                                <span class="meta-day"> jul 11, 2022</span>
                            </div>
                            <h5 class="post-title text-uppercase">
                                <a href="single-post.html">Crazy fashion with unique moment</a>
                            </h5>
                            <p>Turpis purus, gravida orci, fringilla dignissim lacus, turpis ut suspendisse vel
                                tellus...</p>
                        </div>
                    </article>
                </div>
            </div>
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




    {{-- instagrtam / social media --}}
    <section class="instagram py-5">
        <div class="container">
            <div class="row g-3">
                <h6 class="element-title text-center">Follow us on Instagram</h6>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="insta-item">
                        <a href="https://www.instagram.com/templatesjungle/" target="_blank">
                            <img src="images/insta-item1.jpg" alt="instagram" class="insta-image img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="insta-item">
                        <a href="https://www.instagram.com/templatesjungle/" target="_blank">
                            <img src="images/insta-item2.jpg" alt="instagram" class="insta-image img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="insta-item">
                        <a href="https://www.instagram.com/templatesjungle/" target="_blank">
                            <img src="images/insta-item3.jpg" alt="instagram" class="insta-image img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="insta-item">
                        <a href="https://www.instagram.com/templatesjungle/" target="_blank">
                            <img src="images/insta-item4.jpg" alt="instagram" class="insta-image img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="insta-item">
                        <a href="https://www.instagram.com/templatesjungle/" target="_blank">
                            <img src="images/insta-item5.jpg" alt="instagram" class="insta-image img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="insta-item">
                        <a href="https://www.instagram.com/templatesjungle/" target="_blank">
                            <img src="images/insta-item6.jpg" alt="instagram" class="insta-image img-fluid">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
