    {{-- categories --}}
    <section class="categories full-width-container overflow-hidden pb-5 slide-clip-animation" data-aos="fade-in">
        <div class="row d-flex flex-wrap g-0">
            @forelse ($featuredCategories as $cat)
                <div class="col-lg-4 col-md-6 col-6">
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
