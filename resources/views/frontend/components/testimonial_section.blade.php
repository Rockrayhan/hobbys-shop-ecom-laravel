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
                                alt="{{ $review->customer_name }}"
                                class="review-image img-fluid rounded-3 shadow-sm border">
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
                                <img src="{{ asset($review->image ?? 'images/default-user.png') }}"
                                    alt="{{ $review->customer_name }}"
                                    class="review-image img-fluid rounded-3 shadow-sm border">
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


    <script>
        
    </script>
</section>
