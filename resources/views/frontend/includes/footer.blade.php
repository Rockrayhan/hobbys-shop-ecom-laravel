    <footer id="footer" class="mt-5">
        <div class="container">
            <div class="row d-flex flex-wrap justify-content-between py-5">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu footer-menu-001">
                        <div class="footer-intro mb-4">
                            <a href="index.html">
                                <img src="{{ asset('images/main-logo.png') }}" alt="logo" class="footer-logo">
                            </a>
                        </div>
                        <p> Fulfill Your Hobby at Your Fingertips ! </p>
                        <div class="social-links">
                            <ul class="list-unstyled d-flex flex-wrap gap-3">
                                <li>
                                    <a href="#" class="text-secondary">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#facebook"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-secondary">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#twitter"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-secondary">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#youtube"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-secondary">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#pinterest"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-secondary">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#instagram"></use>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu footer-menu-002">
                        <h5 class="widget-title text-uppercase mb-4">Quick Links</h5>
                        <ul class="menu-list list-unstyled text-uppercase border-animation-left fs-6">
                            <li class="menu-item">
                                <a href="/" class="item-anchor">Home</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('all-products') }}" class="item-anchor">All Products</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('contact')}}" class="item-anchor">Contact</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu footer-menu-003">
                        <h5 class="widget-title text-uppercase mb-4">Help & Info</h5>
                        <ul class="menu-list list-unstyled text-uppercase border-animation-left fs-6">
                            <li class="menu-item">
                                <a href="{{ route('order.track') }}" class="item-anchor">Track Your Order</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('privacy.policy') }}" class="item-anchor">Privacy Policy</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('return-refund-policy') }}" class="item-anchor">Return & Refund
                                    Policy</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu footer-menu-004 border-animation-left">
                        <h5 class="widget-title text-uppercase mb-4">Contact Us</h5>
                        <p>Do you have any questions or suggestions? <a href="mailto:hobbyshopbuy@gmail.com"
                                class="item-anchor">hobbyshopbuy@gmail.com</a></p>
                        <p>Do you need support? Give us a call. <a href="tel:+8801535835810" class="item-anchor">
                                01535-835810</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 d-flex flex-wrap">

                    </div>
                    <div class="col-md-6 text-end">
                        {{-- <p class="footer-credit">
                            © Copyright 2025 Elegant. All rights reserved.
                            Design by <a href="https://templatesjungle.com" target="_blank">TemplatesJungle</a>
                        </p> --}}
                        <p>
                            Develped by <a target="_blank" href="https://khayrul-alam-portfo.netlify.app/">Khayrul
                                Alam 👨‍💻</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
