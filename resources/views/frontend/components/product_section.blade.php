@php
    $title = $title ?? 'Products';
    $categories = $categories ?? [];
@endphp

<section class="product-grid py-5 clearfix">

    <div class="section-header text-center mb-4">
        <h3 class="section-title text-uppercase fs-2">{{ $title }}</h3>
    </div>

    <div class="container">
        <div class="row">

            {{-- Filters --}}
            <div id="filters" class="button-group d-flex gap-4 justify-content-center py-5">
                <a href="#" class="btn-link text-uppercase is-checked" data-filter="*">All</a>
                @foreach ($categories as $cat)
                    <a href="#" class="btn-link text-uppercase" data-filter=".{{ Str::slug($cat->slug) }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            {{-- Products Grid --}}
            <div class="grid p-0 clearfix">
                @forelse ($products as $item)
                    @php
                        // Filter classes: include parent category
                        $filterClasses = [];
                        if ($item->category) {
                            $filterClasses[] = Str::slug($item->category->slug);
                            if ($item->category->parent) {
                                $filterClasses[] = Str::slug($item->category->parent->slug);
                            }
                        }
                    @endphp

                    {{-- Pass filter classes to product_card --}}
                    @include('frontend.components.product_card', [
                        'item' => $item,
                        'filterClasses' => implode(' ', $filterClasses),
                    ])

                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No products found.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</section>