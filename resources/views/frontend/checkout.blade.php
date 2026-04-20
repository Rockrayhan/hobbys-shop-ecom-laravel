@extends('frontend.layouts.app')


<style>
    .checkout-form ::placeholder {
        font-size: 16px;
        color: #adb5bd;
    }
</style>

@section('content')
    <div class="container py-5">

        <!-- Header -->
        <div class="text-center mb-4">
            <h3 class="fw-bold text-dark mb-1">Checkout</h3>
            <p class="text-muted small">Review your order and complete purchase</p>
        </div>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger shadow-sm rounded-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Empty Cart --}}
        @if (count($cart) == 0)
            <div class="alert alert-info text-center rounded-3 p-4">
                <h5>Your cart is empty 😕</h5>
                <a href="{{ route('home') }}" class="btn btn-primary mt-3">Return to Shop</a>
            </div>
        @else
            <div class="row g-4">

                <!-- ================= CART SUMMARY ================= -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4">

                        <div class="card-header bg-white border-0 pt-4 pb-0">
                            <h5 class="fw-semibold mb-0">Order Summary</h5>
                            <small class="text-muted">Your selected items</small>
                        </div>

                        <div class="card-body">

                            <div id="cart-items">

                                @php $subtotal = 0; @endphp

                                @foreach ($cart as $id => $item)
                                    @php
                                        $lineTotal = $item['price'] * $item['quantity'];
                                        $subtotal += $lineTotal;
                                    @endphp

                                    <div class="d-flex justify-content-between align-items-center border rounded-3 p-3 mb-3 cart-item"
                                        data-id="{{ $item['id'] }}" data-variation-id="{{ $item['variation_id'] }}"
                                        data-price="{{ $item['price'] }}">

                                        <!-- Left -->
                                        <div class="d-flex align-items-center gap-3">

                                            <img src="{{ $item['image'] ?? 'https://via.placeholder.com/60' }}"
                                                class="rounded border" width="60" height="60"
                                                style="object-fit: cover;">

                                            <div>

                                                <h6 class="mb-1 fw-semibold">
                                                    {{ $item['name'] }}
                                                </h6>

                                                @if (isset($item['size']))
                                                    <small class="text-muted d-block">
                                                        Type: {{ $item['size'] }}
                                                    </small>
                                                @endif

                                                <div class="d-flex align-items-center mt-2">

                                                    <button class="btn btn-sm btn-outline-secondary decrease-qty">−</button>

                                                    <span class="mx-2 fw-semibold quantity">
                                                        {{ $item['quantity'] }}
                                                    </span>

                                                    <button class="btn btn-sm btn-outline-secondary increase-qty">+</button>

                                                    <button class="btn btn-sm btn-outline-danger ms-3 delete-item">
                                                        <i class="bi bi-trash"></i>
                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- Right -->
                                        <div class="text-end fw-semibold line-total">
                                            BDT {{ number_format($lineTotal, 2) }}
                                        </div>

                                    </div>
                                @endforeach

                            </div>

                            <!-- Summary -->
                            <div class="border-top pt-3 mt-3">

                                <div class="d-flex justify-content-between small text-muted mb-2">
                                    <span>Subtotal</span>
                                    <span id="subtotal" class="fw-semibold text-dark">
                                        BDT {{ number_format($subtotal, 2) }}
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between small text-muted mb-2">
                                    <span>Delivery</span>
                                    <span id="delivery-charge" class="fw-semibold text-dark">BDT 60</span>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between fs-5 fw-bold">
                                    <span>Total</span>
                                    <span id="total">
                                        BDT {{ number_format($subtotal + 60, 2) }}
                                    </span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- ================= SHIPPING FORM ================= -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4">

                        <div class="card-header bg-white border-0 pt-4 pb-0">
                            <h5 class="fw-semibold mb-0">Shipping Details</h5>
                            <small class="text-muted">Enter delivery information</small>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('checkout.place') }}" method="POST" class="checkout-form">
                                @csrf

                                <!-- Name -->
                                <div class="mb-3">
                                    <label class="form-label small text-muted fw-semibold">Full Name</label>
                                    <input type="text" class="form-control form-control-lg" name="user_name"
                                        placeholder="Enter your full name" required>
                                </div>

                                <!-- Phone -->
                                <div class="mb-3">
                                    <label class="form-label small text-muted fw-semibold">Phone Number</label>
                                    <input type="text" class="form-control form-control-lg" name="phone"
                                        placeholder="e.g. 017XXXXXXXX" required>
                                </div>

                                <!-- Address -->
                                <div class="mb-3">
                                    <label class="form-label small text-muted fw-semibold">Delivery Address</label>
                                    <textarea class="form-control form-control-lg" name="address" rows="3" placeholder="Enter full address" required></textarea>
                                </div>

                                <!-- Delivery -->
                                <div class="mb-3">
                                    <label class="form-label small text-muted fw-semibold">Delivery Option</label>

                                    <div class="border rounded-3 p-3">

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

                                <!-- Hidden -->
                                <input type="hidden" name="cart_data" id="cart_data">
                                <input type="hidden" name="delivery_charge" id="delivery_charge_input" value="60">

                                <!-- Button -->
                                <button type="submit" class="btn btn-success btn-lg w-100 fw-semibold mt-3">
                                    <i class="bi bi-bag-check me-2"></i> Place Order
                                </button>

                            </form>

                        </div>

                    </div>
                </div>

            </div>
        @endif

    </div>

    {{-- JS (unchanged) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function updateTotals() {
                let subtotal = 0;
                let cartData = [];

                document.querySelectorAll('#cart-items > div').forEach(item => {

                    const qty = parseInt(item.querySelector('.quantity').textContent);
                    const unitPrice = parseFloat(item.getAttribute('data-price'));
                    const id = item.getAttribute('data-id');

                    const name = item.querySelector('h6').childNodes[0].textContent.trim();
                    const sizeEl = item.querySelector('small');
                    const size = sizeEl ? sizeEl.textContent.replace('Type: ', '').trim() : null;

                    const lineTotal = unitPrice * qty;

                    subtotal += lineTotal;

                    item.querySelector('.line-total').textContent =
                        'BDT ' + lineTotal.toFixed(2);

                    cartData.push({
                        id,
                        variation_id: item.getAttribute('data-variation-id') ?
                            parseInt(item.getAttribute('data-variation-id')) :
                            null,
                        name,
                        size,
                        qty,
                        lineTotal
                    });

                });

                const delivery = parseInt(
                    document.querySelector('input[name="delivery"]:checked').value
                );

                document.getElementById('subtotal').textContent = 'BDT ' + subtotal.toFixed(2);
                document.getElementById('delivery-charge').textContent = 'BDT ' + delivery;
                document.getElementById('total').textContent = 'BDT ' + (subtotal + delivery).toFixed(2);
                document.getElementById('delivery_charge_input').value = delivery;
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
