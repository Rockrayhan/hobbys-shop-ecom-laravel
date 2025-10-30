<nav class="navbar fixed-top navbar-expand-lg bg-white text-uppercase fs-6 py-1  border-bottom">
    <div class="container-fluid d-flex justify-content-between justify-content-md-around align-items-center">


        <!-- Left: Brand -->
        <a class="navbar-brand d-flex gap-2 align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/main-logo.png') }}" class="nav-logo" alt="logo">
            <h5 class="m-0 fw-bold">Hobby's Shop BD</h5>
        </a>

        <!-- Middle (Desktop Only) -->
        <div class="d-none d-lg-flex align-items-center">
            <ul class="navbar-nav justify-content-center flex-grow-1 gap-3">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('all-products') }}">All Products</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            </ul>
        </div>

        <!-- Right: Cart + Search + Toggler -->
        <div class="d-flex align-items-center gap-3">

            <!-- Cart -->
            <a href="#" class="text-uppercase fw-bold position-relative d-flex align-items-center "
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                <i class="bi bi-bag-fill fs-5 text-primary-emphasis"></i>
                <span
                    class="badge bg-danger text-white rounded-circle position-absolute top-0 start-100 translate-middle p-1 cart-count"
                    style="font-size: 10px; min-width: 18px; height: 18px; display: flex; align-items: center; justify-content: center;">
                    {{ count(session('cart', [])) }}
                </span>
            </a>

            <!-- Search -->
            <li class="search-box mx-2">
                <a href="#search" class="search-button">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#search"></use>
                    </svg>
                </a>
            </li>


            <!-- Toggler (visible on mobile only) -->
            <button class="navbar-toggler border-0 shadow-none d-lg-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>
    </div>

    <!-- Offcanvas for Mobile Menu (Visible on mobile only) -->
    <div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="offcanvasNavbar"
        aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-center flex-grow-1 gap-3">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('all-products') }}">All Products</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            </ul>
        </div>
    </div>



</nav>
