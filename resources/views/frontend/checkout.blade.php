@extends('frontend.layouts.app')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Checkout</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        @if (count($cart) == 0)
            <div class="alert alert-info">Your cart is empty.</div>
            <a href="{{ route('home') }}" class="btn btn-primary">Go Back</a>
        @else
            <div class="row">
                <!-- Cart Items -->
                <div class="col-md-6 mb-4">
                    <h4>Cart Items</h4>
                    @php $total = 0; @endphp
                    @foreach ($cart as $id => $item)
                        @php
                            $lineTotal = $item['price'] * $item['quantity'];
                            $total += $lineTotal;
                        @endphp
                        <div class="border p-2 mb-2 rounded d-flex align-items-center">
                            <!-- Image -->
                            <img src="{{ $item['image'] ?? 'https://via.placeholder.com/60' }}" alt="{{ $item['name'] }}"
                                class="img-fluid rounded me-2" width="60">

                            <div class="flex-grow-1">
                                <strong>{{ $item['name'] }}</strong> <br>
                                <small>Qty: {{ $item['quantity'] }}</small>
                            </div>

                            <div class="fw-bold">
                                BDT {{ number_format($lineTotal, 2) }}
                            </div>
                        </div>
                    @endforeach
                    <div class="border-top pt-2 mt-2 d-flex justify-content-between fw-bold">
                        <span>Subtotal:</span>
                        <span>BDT {{ number_format($total, 2) }}</span>
                    </div>
                </div>


                <!-- Checkout Form -->
                <div class="col-md-6">
                    <h4>Shipping Details</h4>
                    <form action="{{ route('checkout.place') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="user_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="user_name" id="user_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" name="address" id="address" rows="3" required></textarea>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_inside_dhaka" id="is_inside_dhaka"
                                value="1" checked>
                            <label class="form-check-label" for="is_inside_dhaka">
                                Inside Dhaka (Delivery Charge: BDT 60)
                            </label>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Place Order</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
