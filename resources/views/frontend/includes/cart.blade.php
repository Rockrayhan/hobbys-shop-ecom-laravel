<div id="offcanvasCart" 
     class="offcanvas offcanvas-end" 
     data-bs-scroll="true" 
     tabindex="-1" 
     aria-labelledby="offcanvasCartLabel">

    <!-- Header -->
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasCartLabel" class="mb-0 fw-bold text-primary">Your Cart</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Body -->
    <div class="offcanvas-body p-3" id="offcanvasCartBody">
        @include('frontend.includes.cart_body')
    </div>
</div>
