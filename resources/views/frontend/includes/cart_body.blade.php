<div class="px-3">
    <h6 class="d-flex justify-content-between align-items-center mb-3 fw-bold">
        🛒 Items in Cart
        <span class="badge bg-primary rounded-pill">{{ count(session('cart', [])) }}</span>
    </h6>

    @php $total = 0; @endphp
    @forelse (session('cart', []) as $id => $item)
        @php
            $subtotal = (float) $item['price'] * (int) $item['quantity'];
            $total += $subtotal;
        @endphp

        <!-- Product Row -->
        <div class="row align-items-center border rounded p-2 mb-3 shadow-sm">
            <!-- Product Image -->
            <div class="col-4">
                <img src="{{ $item['image'] ?? 'https://via.placeholder.com/100' }}" 
                     alt="{{ $item['name'] }}" 
                     class="img-fluid rounded">
            </div>

            <!-- Product Info -->
            <div class="col-8">
                <h6 class="fw-semibold mb-1">{{ $item['name'] }}</h6>
                <p class="mb-2 text-muted small">
                    Price: 
                    {{ fmod($item['price'], 1) == 0 ? number_format($item['price'], 0) : number_format($item['price'], 2) }}
                    bdt
                </p>

                <!-- Quantity + Remove -->
                <div class="d-flex gap-2 align-items-center">
                    <button class="btn btn-sm btn-outline-secondary update-qty" 
                            data-id="{{ $id }}" data-action="decrease">−</button>
                    <span class="fw-bold">{{ $item['quantity'] }}</span>
                    <button class="btn btn-sm btn-outline-secondary update-qty" 
                            data-id="{{ $id }}" data-action="increase">+</button>

                    <button class="btn btn-danger btn-sm ms-auto remove-cart-item" 
                            data-id="{{ $id }}">
                        Remove
                    </button>
                </div>
            </div>

            <!-- Subtotal -->
            <div class="col-12 mt-2 text-end">
                <span class="fw-bold text-secondary">
                    tk: 
                    {{ fmod($subtotal, 1) == 0 ? number_format($subtotal, 0) : number_format($subtotal, 2) }} bdt
                </span>
            </div>
        </div>
    @empty
        <p class="text-center text-muted">Your cart is empty</p>
    @endforelse

    <!-- Cart Summary -->
    <div class="d-flex justify-content-between border-top pt-3 fw-bold">
        <h6>SubTotal</h6>
        <h6>{{ fmod($total, 1) == 0 ? number_format($total, 0) : number_format($total, 2) }} bdt</h6>
    </div>

    <!-- Checkout -->
    <div class="mt-3">
        <button class="w-100 btn btn-lg btn-warning text-dark fw-semibold shadow-sm">
            Order Now
        </button>
    </div>
</div>
