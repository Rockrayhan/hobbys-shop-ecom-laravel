@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')





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
                                <div class="col-lg-12">
                                    <div class="image-holder">
                                        <img src="{{ asset('images/banner1.webp') }}" alt="product"
                                            class="banner-img img-fluid">
                                    </div>
                                </div>


                                <div class="banner-content col-lg-6 p-5">
                                    <h2 class="display-2 fw-bold text-uppercase txt-fx slide-up">Crafted for Perfection</h2>
                                    <p>1 For those who appreciate timeless sophistication—sleek designs with refined
                                        details, powered by mechanical mastery.</p>

                                    <a href="{{ route('all-products') }}"
                                        class="btn btn-outline-dark text-uppercase mt-3 py-3">Explore the
                                        Collections</a>

                                </div>


                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="row banner-item align-items-center">
                                <div class="col-lg-6">
                                    <div class="image-holder">
                                        <img src="{{asset('images/banner2.webp')}}" alt="product" class=" banner-img img-fluid">
                                    </div>
                                </div>
                                <div class="banner-content col-lg-6 p-5">
                                    <h2 class="display-2 fw-bold text-uppercase txt-fx slide-up">Classic Elegance</h2>
                                    <p>For those who appreciate timeless sophistication—sleek designs with refined
                                        details, powered by mechanical mastery.</p>
                                    <a href="{{ route('all-products') }}"
                                        class="btn btn-outline-dark text-uppercase mt-3 py-3">Explore the
                                        Collections</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="row banner-item align-items-center">
                                <div class="col-lg-6">
                                    <div class="image-holder">
                                        <img src="{{asset('images/banner3.webp')}}" alt="product" class=" banner-img img-fluid">
                                    </div>
                                </div>
                                <div class="banner-content col-lg-6 order-1 order-lg-2 p-5">
                                    <h2 class="display-2 fw-bold text-uppercase txt-fx slide-up">Sport & Adventure</h2>
                                    <p>Engineered for precision under pressure—robust, high-performance watches for the
                                        modern explorer.</p>
                                    <a href="{{ route('all-products') }}"
                                        class="btn btn-outline-dark text-uppercase mt-3 py-3">Explore the
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

    @include('frontend.components.testimonial_section')








    {{-- brand logo --}}
    <section class="logo-bar py-5 my-5">
        <div class="container">
            <div class="row gx-5 gy-4">

                <div class="col-6 col-sm-4 col-md-2 d-flex justify-content-center">
                    <img src="{{ asset('images/logo1.png') }}" alt="logo" class="img-fluid">
                </div>

                <div class="col-6 col-sm-4 col-md-2 d-flex justify-content-center">
                    <img src="{{ asset('images/logo2.png') }}" alt="logo" class="img-fluid">
                </div>

                <div class="col-6 col-sm-4 col-md-2 d-flex justify-content-center">
                    <img src="{{ asset('images/logo3.png') }}" alt="logo" class="img-fluid">
                </div>

                <div class="col-6 col-sm-4 col-md-2 d-flex justify-content-center">
                    <img src="{{ asset('images/logo4.png') }}" alt="logo" class="img-fluid">
                </div>

                <div class="col-6 col-sm-4 col-md-2 d-flex justify-content-center">
                    <img src="{{ asset('images/logo5.png') }}" alt="logo" class="img-fluid">
                </div>

                <div class="col-6 col-sm-4 col-md-2 d-flex justify-content-center">
                    <img src="{{ asset('images/logo3.png') }}" alt="logo" class="img-fluid">
                </div>

            </div>
        </div>
    </section>






@endsection
