<div class="order-md-last">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">Your cart</span>
        <span class="badge bg-primary rounded-pill">{{ count(session('cart', [])) }}</span>
    </h4>
    <ul class="list-group mb-3">
        @php $total = 0; @endphp
        @foreach (session('cart', []) as $id => $item)
            @php $total += $item['price'] * $item['quantity']; @endphp
            <li class="list-group-item d-flex justify-content-between lh-sm align-items-center">
                <div>
                    <h6 class="my-0">{{ $item['name'] }}</h6>
                    <small class="text-body-secondary">Qty: {{ $item['quantity'] }}</small>
                </div>
                <div class="d-flex align-items-center">
                    <span class="text-body-secondary me-2">${{ $item['price'] * $item['quantity'] }}</span>
                    <button class="btn btn-sm btn-danger remove-cart-item" data-id="{{ $id }}">&times;</button>
                </div>
            </li>
        @endforeach
        <li class="list-group-item d-flex justify-content-between">
            <span>Total (USD)</span>
            <strong>${{ $total }}</strong>
        </li>
    </ul>

    <button class="w-100 btn btn-primary btn-lg">Continue to checkout</button>
</div>
