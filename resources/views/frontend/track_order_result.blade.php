@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm p-4">
        <h4 class="fw-bold mb-3 text-success">Order Details</h4>
        <p><strong>Tracking Number:</strong> {{ $order->tracking_number }}</p>
        <p><strong>Name:</strong> {{ $order->user_name }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Status:</strong> 
            <span class="badge bg-info text-dark">{{ ucfirst($order->order_status) }}</span>
        </p>
        <p><strong>Total:</strong> ৳{{ number_format($order->grand_total, 2) }}</p>
    </div>
</div>
@endsection
