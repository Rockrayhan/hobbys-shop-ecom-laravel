    <section id="billboard" class="bg-secondary-subtle two-column-swiper slide-clip slide-in pt-4 banner">
        <div class="container">
            <div class="row">
                <div class="swiper overflow-hidden">
                    <div class="swiper-wrapper">
                        {{-- banner 1 --}}
                        <div class="swiper-slide">
                            <a href="{{ route('all-products') }}" class="banner-item d-block image-holder">

                                <!-- Background Image -->
                                <div class="banner-bg "
                                    style="background-image: url('{{ asset('images/banner1.webp') }}');">

                                    <!-- Overlay -->
                                    <div class="banner-overlay"></div>

                                    <!-- Content -->
                                    <div class="banner-content text-center text-lg-start">
                                        <h2 class="display-3 fw-bold text-uppercase text-white">
                                            Crafted for Perfection
                                        </h2>

                                        <button class="btn btn-light mt-3 px-4 py-2 w-50">
                                            Shop Now
                                        </button>
                                    </div>

                                </div>
                            </a>
                        </div>

                        {{-- banner 2 --}}
                        <div class="swiper-slide">
                            <a href="{{ route('all-products') }}" class="banner-item d-block image-holder">

                                <!-- Background Image -->
                                <div class="banner-bg "
                                    style="background-image: url('{{ asset('images/banner2.webp') }}');">

                                    <!-- Overlay -->
                                    <div class="banner-overlay"></div>

                                    <!-- Content -->
                                    <div class="banner-content text-center text-lg-start">
                                        <h2 class="display-3 fw-bold text-uppercase text-white">
                                            Classic Elegence
                                        </h2>

                                        <button class="btn btn-light mt-3 px-4 py-2">
                                            Shop Now
                                        </button>
                                    </div>

                                </div>
                            </a>
                        </div>

                        {{-- banner 3 --}}
                        <div class="swiper-slide">
                            <a href="{{ route('all-products') }}" class="banner-item d-block image-holder">

                                <!-- Background Image -->
                                <div class="banner-bg "
                                    style="background-image: url('{{ asset('images/banner3.webp') }}');">

                                    <!-- Overlay -->
                                    <div class="banner-overlay"></div>

                                    <!-- Content -->
                                    <div class="banner-content text-center text-lg-start">
                                        <h2 class="display-3 fw-bold text-uppercase text-white">
                                            Sports and Adventure
                                        </h2>

                                        <button class="btn btn-light mt-3 px-4 py-2">
                                            Shop Now
                                        </button>
                                    </div>

                                </div>
                            </a>
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
