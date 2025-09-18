@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')


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
                                    <h2 class="display-2 fw-bold text-uppercase txt-fx slide-up">Timeless Elegance,
                                        Crafted for Perfection</h2>
                                    <p>Discover the world's finest luxury timepieces, where precision meets artistry.
                                    </p>
                                    <a href="#" class="btn btn-outline-dark text-uppercase mt-3">Explore the
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
                                    <a href="#" class="btn btn-outline-dark text-uppercase mt-3">Explore the
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
                                    <a href="#" class="btn btn-outline-dark text-uppercase mt-3">Explore the
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



    {{-- categoires --}}
    <section class="categories full-width-container overflow-hidden py-5 slide-clip-animation" data-aos="fade-in">
        <div class="row d-flex flex-wrap">
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

                {{-- <div id="filters" class="button-group d-flex gap-4 justify-content-center py-5">
                    <a href="#" class="btn-link text-uppercase is-checked" data-filter=".bestsellers">Best
                        Sellers</a>
                    <a href="#" class="btn-link text-uppercase" data-filter=".newarrivals">New Arrivals</a>
                    <a href="#" class="btn-link text-uppercase" data-filter=".bestreviewed">Best Reviewed</a>
                </div> --}}

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
                        <div class="col-md-3 p-2 product-item {{ Str::slug($item->category->name) }}">
                            <div class="image-zoom-effect link-effect mb-5">
                                <div class="image-holder">
                                    <a href="single-product.html">
                                        @if ($item->image)
                                            <img src="{{ asset($item->image) }}" alt="{{ $item->category->name }}"
                                                class="product-img img-fluid" width="300">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif

                                    </a>
                                    <a href="wishlist.html" class="btn-icon btn-wishlist">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#heart"></use>
                                        </svg>
                                    </a>
                                    <div class="product-content">
                                        <h5 class="element-title text-uppercase fs-5 mt-3">
                                            <a href="single-product.html"> {{ $item->name }} </a>
                                        </h5>

                                        <a href="#" class="text-decoration-none add-to-cart"
                                            data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                            data-after="Add to cart" data-price="{{ $item->current_price }}"
                                            data-image="{{ asset($item->image) }}"
                                            >
                                            {{-- <span>{{ number_format($item->current_price, 2) }} bdt</span> --}}
                                            <span>{{ fmod($item['current_price'], 1) == 0 ? number_format($item['current_price'], 0) : number_format($item['current_price'], 2) }} bdt</span>
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

    {{-- testimonial --}}
    {{-- <section class="testimonials py-5">
        <div class="section-header text-center">
            <h3 class="section-title text-uppercase"> Our Reviews </h3>
        </div>
        <div class="swiper testimonial-swiper overflow-hidden">
            <div class="swiper-wrapper d-flex">
                <div class="swiper-slide">
                    <div class="testimonial-item text-center">
                        <blockquote>
                            <p>“More than expected crazy soft, flexible and best fitted white simple denim shirt.”</p>
                            <div class="review-title text-uppercase">casual way</div>
                        </blockquote>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-item text-center">
                        <blockquote>
                            <p>“Best fitted white denim shirt more than expected crazy soft, flexible</p>
                            <div class="review-title text-uppercase">uptop</div>
                        </blockquote>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-item text-center">
                        <blockquote>
                            <p>“Best fitted white denim shirt more white denim than expected flexible crazy soft.”</p>
                            <div class="review-title text-uppercase">Denim craze</div>
                        </blockquote>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-item text-center">
                        <blockquote>
                            <p>“Best fitted white denim shirt more than expected crazy soft, flexible</p>
                            <div class="review-title text-uppercase">uptop</div>
                        </blockquote>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section> --}}







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


    {{-- news letter / contact --}}
    <section class="newsletter jarallax">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 py-5 my-5">
                    <div class="subscribe-header text-center pb-3">
                        <h3 class="section-title text-uppercase text-white">Sign Up for Our Newsletter</h3>
                    </div>
                    <form id="form" class="d-flex flex-wrap gap-2">
                        <input type="text" name="email" placeholder="Your Email Addresss"
                            class="form-control form-control-lg bg-white rounded-0">
                        <button class="btn btn-primary btn-lg text-uppercase w-100">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
        <img src="images/bg-newsletter.jpg" alt="newsletter" class="jarallax-img img-fluid" />
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
