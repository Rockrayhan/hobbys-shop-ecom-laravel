@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Card wrapper -->
            <div class="card shadow-sm border-0">
                <div class="card-body text-center p-5">

                    <!-- Success Icon -->
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success fs-1"></i>
                    </div>

                    <h2 class="mb-3">Order #{{ $order->id }} Placed!</h2>
                    <p class="lead">
                        Thank you, <strong>{{ $order->user_name }}</strong>!<br>
                        Your order status is <span class="badge bg-warning text-dark">{{ ucfirst($order->order_status) }}</span>.
                    </p>

                    <!-- Order Summary -->
                    <div class="mt-4 text-start">
                        <h4 class="mb-3">Order Summary</h4>
                        <ul class="list-group shadow-sm">

                            @foreach ($order->items as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        {{ $item->product ? $item->product->name : 'Product #' . $item->product_id }}
                                        <div class="small text-muted">Qty: {{ $item->quantity }}</div>
                                    </div>
                                    <span>{{ number_format($item->total_price, 2) }} BDT</span>
                                </li>
                            @endforeach

                            <li class="list-group-item d-flex justify-content-between">
                                <span>Subtotal</span>
                                <strong>{{ number_format($order->subtotal, 2) }} BDT</strong>
                            </li>

                            <li class="list-group-item d-flex justify-content-between">
                                <span>Delivery</span>
                                <strong>{{ number_format($order->delivery_charge, 2) }} BDT</strong>
                            </li>

                            <li class="list-group-item d-flex justify-content-between bg-light fw-bold">
                                <span>Total</span>
                                <strong>{{ number_format($order->grand_total, 2) }} BDT</strong>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg shadow-sm">
                            Back to Shop
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
