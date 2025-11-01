@extends('frontend.layouts.app')

@section('title', 'About')

@section('content')


    <style>
        .social-icon {
            width: 100px;
            height: 100px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .social-icon:hover {
            transform: scale(1.1);
        }
    </style>

    <div>

        {{-- Contact Info Section --}}
        <section class="container my-5">

            <div class="text-center mb-5">
                <h3 class=" fw-semibold"> Contact Us </h3>

                <div class="d-flex justify-content-center">
                    <p class="text-secondary fs-5 w-75 ">
                        We value your feedback and are here to assist you. If you have any questions or need support,
                        feel free to contact our team. We’re always happy to help!
                    </p>
                </div>

            </div>


            <div class="row g-4 align-items-start">

                {{-- Left side (Contact Details) --}}
                <div class="col-lg-5">
                    <div class="card border-0 shadow p-4 h-100">
                        <h5 class="fw-bold mb-4">Contact Information</h5>

                        <p class="text-secondary mb-4">
                            <i class="bi bi-telephone-outbound me-2 text-primary fs-5"></i>
                            <strong>Hotline (24/7):</strong><br>
                            <a class="text-dark d-block fs-5 fw-semibold" href="tel:+8801535835810">01535-835810</a>
                            <a class="text-dark d-block fs-5 fw-semibold" href="tel:+8801830200789">01830-200789</a>
                        </p>

                        <p class="text-secondary mb-4">
                            <i class="bi bi-envelope me-2 text-primary fs-5"></i>
                            <strong>Email:</strong><br>
                            <a class="fw-semibold text-dark" href="mailto:hobbyshopbuy@gmail.com">
                                hobbyshopbuy@gmail.com
                            </a>
                        </p>

                        <p class="text-secondary mb-0">
                            <i class="bi bi-geo-alt me-2 text-primary fs-5"></i>
                            <strong>Address:</strong><br>
                            <span class="fw-semibold text-dark">South Pirerbug, Mirpur, Dhaka</span>
                        </p>
                    </div>
                </div>

                {{-- Right side (Social & Support Links) --}}
                <div class="col-lg-7">
                    <div class="card border-0 shadow p-4 h-100">
                        <h5 class="fw-bold mb-4 text-center"> Live Chat 🤝 Connect With Us</h5>

                        <div class="d-flex flex-column flex-sm-row justify-content-around align-items-center gap-4">

                            <a target="_blank" href="https://www.facebook.com/HobbyShopBD23"
                                class="text-decoration-none text-center">
                                <img class="social-icon img-fluid rounded-circle shadow-sm mb-2"
                                    src="{{ asset('images/messenger-icon.webp') }}" alt="Messenger">
                                <p class="text-black fw-semibold mb-0">Chat on Messenger</p>
                            </a>

                            <a target="_blank" href="https://wa.me/+8801535835810" class="text-decoration-none text-center">
                                <img class="social-icon img-fluid rounded-circle shadow-sm mb-2"
                                    src="{{ asset('images/whatsapp-icon.png') }}" alt="WhatsApp">
                                <p class="text-black fw-semibold mb-0">Chat on WhatsApp</p>
                            </a>
                        </div>

                        <p class="text-secondary fs-6 mt-5">
                            Our dedicated support team is committed to providing excellent service.
                            Whether it’s about orders, products, or shipping — we’re here to help.
                        </p>
                    </div>
                </div>

            </div>


        </section>






        {{-- contact form --}}
        <section class="contact-section jarallax">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 py-5 my-5">
                        <div class="text-center pb-4">
                            <h2 class="section-title text-uppercase text-white fw-bold">Get In Touch With Us</h2>
                            <p class="text-light">We’d love to hear from you! Please fill out the form below.</p>
                        </div>

                        <form id="contact-form" class="p-4 rounded shadow">
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email address</label>
                                <input type="email" name="email" id="email" class="form-control form-control-lg"
                                    placeholder="Enter your email" required>
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label fw-semibold">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control form-control-lg"
                                    placeholder="Subject" required>
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label fw-semibold">Message</label>
                                <textarea name="message" id="message" class="form-control form-control-lg" rows="5"
                                    placeholder="Write your message..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 text-uppercase">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
            <img src="images/bg-newsletter.jpg" alt="contact background" class="jarallax-img img-fluid" />
        </section>


    </div>

@endsection
