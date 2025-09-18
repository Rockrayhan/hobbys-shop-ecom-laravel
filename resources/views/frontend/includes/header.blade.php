    <nav class="navbar fixed-top navbar-expand-lg bg-white text-uppercase fs-6 p-3 border-bottom align-items-center">
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center w-100 gx-0">

                <div class="col-auto">
                    <a class="navbar-brand" href="{{ route('home') }}"><img
                            src=" {{ asset('images/main-logo.png') }}" alt="logo"></a>
                </div>

                <div class="col-auto">
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>

                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 gap-1 gap-md-4 pe-3">

                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('home') }}" aria-haspopup="true"
                                        aria-expanded="false">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('about')}}" aria-haspopup="true"
                                        aria-expanded="false">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('all-products')}}" aria-haspopup="true"
                                        aria-expanded="false">All Products</a>
                                </li>


                                {{-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="{{route('all-products')}}" id="dropdownShop"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Products</a>
                                    <ul class="dropdown-menu list-unstyled" aria-labelledby="dropdownShop">
                                        <li>
                                            <a href="shop.html" class="dropdown-item item-anchor">Shop <span
                                                    class="badge bg-primary">PRO</span></a>
                                        </li>
                                        <li>
                                            <a href="single-product.html" class="dropdown-item item-anchor">Single
                                                Product <span class="badge bg-primary">PRO</span></a>
                                        </li>
                                    </ul>
                                </li> --}}




                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contact</a>
                                </li>


                                <li class="nav-item">
                                    <a class="btn btn-outline-primary rounded-pill"
                                        href="https://templatesjungle.gumroad.com/l/elegant-watch-store-html-template"
                                        target="_blank">Get PRO</a>
                                </li>


                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-3 col-lg-auto">
                    <ul class="list-unstyled d-flex m-0">
                        {{-- <li class="d-none d-lg-block">
                            <a href="wishlist.html" class="text-uppercase mx-3">Wishlist <span
                                    class="wishlist-count">(0)</span>
                            </a>
                        </li> --}}
                        <li class="d-none d-lg-block">
                            <a href="cart.html" class="text-uppercase mx-3 fw-bold" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">  Cart  <i class="bi bi-bag-fill fs-5 text-primary-emphasis"></i> <span
                                    class="cart-count badge bg-danger text-white rounded-pill p-1 fs-6">  {{ count(session('cart', [])) }} </span>
                            </a>
                        </li>
                        <li class="d-lg-none">
                            <a href="#" class="mx-2">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <use xlink:href="#heart"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="d-lg-none">
                            <a href="#" class="mx-2" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <use xlink:href="#cart"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="search-box mx-2">
                            <a href="#search" class="search-button">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <use xlink:href="#search"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

        </div>
    </nav>