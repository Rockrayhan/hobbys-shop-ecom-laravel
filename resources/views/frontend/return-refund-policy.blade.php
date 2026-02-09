@extends('frontend.layouts.app')

@section('title', 'Return & Refund Policy')

@section('meta')
<meta name="robots" content="index, follow">
<meta name="description"
      content="Learn about our return and refund policy, including eligibility, timelines, and refund methods for your purchases.">
@endsection

@section('content')
<div class=" bg-light py-5">
    <div class="row justify-content-center container">
        <div class="col-lg-10">

            <h1 class="mb-4">Return & Refund Policy</h1>

            <p>
                We strive to ensure customer satisfaction. Please read our Return & Refund Policy
                carefully before placing an order.
            </p>

            <hr class="my-4">

            <h5 class="fw-semibold">1. Return Eligibility</h5>
            <p>
                Products may be returned if they are damaged, defective, or incorrect.
                Return requests must be made within <strong>7 days</strong> of receiving the product.
            </p>

            <h5 class="fw-semibold mt-4">2. Non-Returnable Items</h5>
            <ul>
                <li>Products damaged due to misuse or mishandling</li>
                <li>Items without original packaging</li>
                <li>Products marked as non-returnable</li>
            </ul>

            <h5 class="fw-semibold mt-4">3. Refund Process</h5>
            <p>
                Approved refunds will be processed within <strong>7–10 business days</strong>
                using the original payment method or store credit.
            </p>

            <h5 class="fw-semibold mt-4">4. Shipping Costs</h5>
            <p>
                Shipping charges are non-refundable unless the return is due to our mistake.
            </p>

            <h5 class="fw-semibold mt-4">5. Order Cancellation</h5>
            <p>
                Orders can be cancelled before shipment. Once shipped, cancellation is not possible.
            </p>

            <h5 class="fw-semibold mt-4">6. Contact for Returns</h5>
            <p>
                For return or refund requests, please contact us with your order details.
            </p>

        </div>
    </div>
</div>
@endsection
