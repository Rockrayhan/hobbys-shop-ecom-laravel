@extends('backend.layouts.app')

@section('content')
    <style>
        /* Sticky table header styling */
        .table-responsive {
            position: relative;
            overflow-y: auto;
            overflow-x: auto;
            max-height: 80vh;
        }

        .table thead.sticky-header th {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: #212529 !important;
            /* same as .table-dark */
            color: #fff;
        }

        /* Top scrollbar container */
        .table-scrollbar-top {
            overflow-x: auto;
            overflow-y: hidden;
            height: 20px;
            margin-bottom: 4px;
        }

        .table-scrollbar-top::-webkit-scrollbar {
            height: 8px;
        }

        .table-scrollbar-top::-webkit-scrollbar-thumb {
            background-color: #6c757d;
            border-radius: 4px;
        }

        .table-scrollbar-top::-webkit-scrollbar-track {
            background-color: #e9ecef;
        }
    </style>

    <div class="container">
        <h2 class="">All Orders</h2>

        <!-- 🔹 Top scrollbar -->
        <div id="table-scroll-top" class="table-scrollbar-top">
            <div id="scroll-sync" style="width: 1800px;"></div>
        </div>

        <!-- 🔹 Main scrollable table -->
        <div id="table-container" class="table-responsive">
            <table id="orders-table" class="table    table-bordered align-middle">
                <thead class="table-dark text-uppercase sticky-header">
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
                                        'cancelled' => 'bg-danger',
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
                                            @if ($item->product && $item->product->image)
                                                <img src="{{ asset($item->product->image) }}"
                                                    alt="{{ $item->product->name }}" width="80" height="80"
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
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const topScroll = document.getElementById("table-scroll-top");
            const tableContainer = document.getElementById("table-container");

            // Sync scroll both ways
            topScroll.addEventListener("scroll", () => {
                tableContainer.scrollLeft = topScroll.scrollLeft;
            });

            tableContainer.addEventListener("scroll", () => {
                topScroll.scrollLeft = tableContainer.scrollLeft;
            });

            // Auto set top scrollbar width to match table
            const table = document.getElementById("orders-table");
            document.getElementById("scroll-sync").style.width = table.scrollWidth + "px";
        });
    </script>
@endsection
