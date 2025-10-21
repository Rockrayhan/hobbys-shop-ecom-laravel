@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark">🛒 Checkout</h2>
        <p class="text-muted mb-0">Review your items and provide your shipping details</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm rounded-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (count($cart) == 0)
        <div class="alert alert-info text-center rounded-3 p-4">
            <h5>Your cart is empty 😕</h5>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Return to Shop</a>
        </div>
    @else
        <div class="row g-4">
            <!-- Cart Summary -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <h4 class="fw-semibold mb-3">Your Items</h4>
                        <div id="cart-items">
                            @php $subtotal = 0; @endphp
                            @foreach ($cart as $id => $item)
                                @php
                                    $lineTotal = $item['price'] * $item['quantity'];
                                    $subtotal += $lineTotal;
                                @endphp
                                <div class="d-flex align-items-center justify-content-between border rounded-3 p-3 mb-3 cart-item"
                                    data-id="{{ $id }}" data-price="{{ $item['price'] }}">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $item['image'] ?? 'https://via.placeholder.com/60' }}"
                                            alt="{{ $item['name'] }}" class="rounded me-3" width="65" height="65">
                                        <div>
                                            <h6 class="mb-1">{{ $item['name'] }}</h6>
                                            <div class="d-flex align-items-center mt-2">
                                                <button class="btn btn-sm btn-outline-secondary rounded-circle decrease-qty">−</button>
                                                <span class="mx-2 fw-semibold quantity">{{ $item['quantity'] }}</span>
                                                <button class="btn btn-sm btn-outline-secondary rounded-circle increase-qty">+</button>
                                                <button class="btn btn-sm btn-outline-danger ms-3 delete-item">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end fw-semibold text-dark line-total">
                                        BDT {{ number_format($lineTotal, 2) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-top mt-3 pt-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal</span>
                                <span id="subtotal" class="fw-semibold">BDT {{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Delivery Charge</span>
                                <span id="delivery-charge" class="fw-semibold">BDT 60</span>
                            </div>
                            <div class="d-flex justify-content-between fs-5 fw-bold border-top pt-3">
                                <span>Total</span>
                                <span id="total">BDT {{ number_format($subtotal + 60, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Form -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <h4 class="fw-semibold mb-3">Shipping Details</h4>
                        <form action="{{ route('checkout.place') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="user_name" class="form-label fw-semibold">Full Name</label>
                                <input type="text" class="form-control form-control-lg rounded-3" name="user_name"
                                    id="user_name" placeholder="Enter your full name" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label fw-semibold">Phone Number</label>
                                <input type="text" class="form-control form-control-lg rounded-3" name="phone" id="phone"
                                    placeholder="e.g. 017XXXXXXXX" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label fw-semibold">Delivery Address</label>
                                <textarea class="form-control form-control-lg rounded-3" name="address" id="address"
                                    rows="3" placeholder="Enter your full address" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Delivery Option</label>
                                <div class="p-3 border rounded-3">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input delivery-option" type="radio" name="delivery"
                                            id="inside_dhaka" value="60" checked>
                                        <label class="form-check-label" for="inside_dhaka">
                                            Inside Dhaka <span class="text-muted">(BDT 60)</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input delivery-option" type="radio" name="delivery"
                                            id="outside_dhaka" value="100">
                                        <label class="form-check-label" for="outside_dhaka">
                                            Outside Dhaka <span class="text-muted">(BDT 100)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="cart_data" id="cart_data">
                            <input type="hidden" name="delivery_charge" id="delivery_charge_input" value="60">

                            <button type="submit" class="btn btn-success btn-lg w-100 mt-3 rounded-3 shadow-sm">
                                <i class="bi bi-bag-check me-2"></i> Place Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateTotals() {
        let subtotal = 0;
        document.querySelectorAll('#cart-items > div').forEach(item => {
            const qty = parseInt(item.querySelector('.quantity').textContent);
            const unitPrice = parseFloat(item.getAttribute('data-price'));
            const lineTotal = unitPrice * qty;
            subtotal += lineTotal;
            item.querySelector('.line-total').textContent = 'BDT ' + lineTotal.toFixed(2);
        });

        const delivery = parseInt(document.querySelector('input[name="delivery"]:checked').value);
        document.getElementById('subtotal').textContent = 'BDT ' + subtotal.toFixed(2);
        document.getElementById('delivery-charge').textContent = 'BDT ' + delivery;
        document.getElementById('total').textContent = 'BDT ' + (subtotal + delivery).toFixed(2);
        document.getElementById('delivery_charge_input').value = delivery;

        // Update hidden cart_data for form submission
        let cartData = [];
        document.querySelectorAll('#cart-items > div').forEach(item => {
            const id = item.getAttribute('data-id');
            const name = item.querySelector('h6').textContent;
            const qty = parseInt(item.querySelector('.quantity').textContent);
            const lineTotal = parseFloat(item.querySelector('.line-total').textContent.replace('BDT', '').trim());
            cartData.push({ id, name, qty, lineTotal });
        });
        document.getElementById('cart_data').value = JSON.stringify(cartData);
    }

    document.querySelectorAll('.increase-qty').forEach(btn => {
        btn.addEventListener('click', function() {
            const qtyEl = this.parentElement.querySelector('.quantity');
            qtyEl.textContent = parseInt(qtyEl.textContent) + 1;
            updateTotals();
        });
    });

    document.querySelectorAll('.decrease-qty').forEach(btn => {
        btn.addEventListener('click', function() {
            const qtyEl = this.parentElement.querySelector('.quantity');
            if (parseInt(qtyEl.textContent) > 1) {
                qtyEl.textContent = parseInt(qtyEl.textContent) - 1;
                updateTotals();
            }
        });
    });

    document.querySelectorAll('.delete-item').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.cart-item').remove();
            updateTotals();
        });
    });

    document.querySelectorAll('.delivery-option').forEach(radio => {
        radio.addEventListener('change', updateTotals);
    });

    updateTotals();
});
</script>
@endsection
