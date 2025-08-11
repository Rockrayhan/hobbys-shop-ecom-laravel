<div id="offcanvasCart" class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" aria-labelledby="offcanvasCartLabel">
    <div class="offcanvas-header justify-content-center">
        <button type="button" class="btn-close bg-primary" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Include only the inner cart content here -->
    <div class="offcanvas-body" id="offcanvasCartBody">
        @include('frontend.includes.cart_body')
    </div>
</div>
