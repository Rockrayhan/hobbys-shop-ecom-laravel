@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="text-center mb-4 fw-bold">Track Your Order</h3>

    <form action="{{ route('order.track.post') }}" method="POST" class="text-center">
        @csrf
        <div class="mb-3">
            <input type="text" name="tracking_number" class="form-control w-50 mx-auto" placeholder="Enter Tracking Number" required>
        </div>
        <button type="submit" class="btn btn-primary px-4">Track Order</button>
    </form>

    @error('tracking_number')
        <p class="text-danger mt-3">{{ $message }}</p>
    @enderror
</div>
@endsection
