@extends('backend.layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">All Orders</h2>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark text-uppercase">
                <tr>
                    <th>#ID</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Subtotal</th>
                    <th>Delivery</th>
                    <th>Grand Total</th>
                    <th>Status</th>
                    <th>Items</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user_name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ number_format($order->subtotal, 2) }} bdt</td>
                        <td>{{ number_format($order->delivery_charge, 2) }} bdt</td>
                        <td>{{ number_format($order->grand_total, 2) }} bdt</td>
                        <td>
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-warning text-dark',
                                    'processing' => 'bg-info text-dark',
                                    'completed' => 'bg-success',
                                    'cancelled' => 'bg-danger'
                                ];
                            @endphp
                            <span class="badge {{ $statusClasses[$order->order_status] ?? 'bg-secondary' }}">
                                {{ ucfirst($order->order_status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-2 w-100">
                                @foreach ($order->items as $item)
                                    <div class="d-flex align-items-center gap-2 w-100">
                                        @if($item->product && $item->product->image)
                                            <img src="{{ asset($item->product->image) }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 width="80" height="80" 
                                                 class="rounded border">
                                        @endif
                                        <span>
                                            {{ $item->product ? $item->product->name : 'Product #' . $item->product_id }}
                                            x{{ $item->quantity }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                      <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>

                        <td>
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this order?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
