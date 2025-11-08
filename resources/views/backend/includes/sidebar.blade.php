<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="/admin" class="d-flex text-white gap-2 ms-md-0 ms-5">
                <i class="fas fa-home mt-2"></i>
                <h4>Dashboard</h4>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                {{-- <li class="nav-item active">
                    <a data-bs-toggle="collapse" href="/admin" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>

                    </a>
                </li> --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>

                {{-- categories --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#Categories">
                        <i class="fas fa-layer-group"></i>
                        <p>Categories</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="Categories">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/admin/categories">
                                    <span class="sub-item">All Categories</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.categories.create') }}">
                                    <span class="sub-item">create Category</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- products --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#Products">
                        <i class="fas fa-layer-group"></i>
                        <p>Products</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="Products">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/admin/products">
                                    <span class="sub-item">All Products</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/products/create">
                                    <span class="sub-item">create Product</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/products/trashed">
                                    <span class="sub-item">Trashed Products</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- orders --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#Orders">
                        <i class="fas fa-layer-group"></i>
                        <p>Orders</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="Orders">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/admin/orders">
                                    <span class="sub-item">All Orders</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                {{-- banners --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#Banners">
                        <i class="fas fa-layer-group"></i>
                        <p> Banners </p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="Banners">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/admin/banners">
                                    <span class="sub-item">All Banners</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/banners/create">
                                    <span class="sub-item">Create Banners</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                {{-- reviews --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#Reviews">
                        <i class="fas fa-layer-group"></i>
                        <p> Reviews </p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="Reviews">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/admin/reviews">
                                    <span class="sub-item">All Reviews</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/reviews/create">
                                    <span class="sub-item">Create Review</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>





            
                <li class="nav-item">
                    <a href="widgets.html">
                        <i class="fas fa-desktop"></i>
                        <p>Widgets</p>
                        <span class="badge badge-success">4</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../documentation/index.html">
                        <i class="fas fa-file"></i>
                        <p>Documentation</p>
                        <span class="badge badge-secondary">1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#submenu">
                        <i class="fas fa-bars"></i>
                        <p>Menu Levels</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a data-bs-toggle="collapse" href="#subnav1">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav1">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a data-bs-toggle="collapse" href="#subnav2">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav2">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
