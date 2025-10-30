@extends('backend.layouts.app')

@section('content')
    <style>
        /* Improved table styling */
        .table-responsive {
            position: relative;
            overflow-y: auto;
            overflow-x: auto;
            max-height: 90vh;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table thead.sticky-header th {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: #212529 !important;
            color: #fff;
            padding: 16px 12px;
            font-weight: 600;
            font-size: 0.9rem;
            border-bottom: 2px solid #dee2e6;
        }

        .table td {
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Top scrollbar container */
        .table-scrollbar-top {
            overflow-x: auto;
            overflow-y: hidden;
            height: 12px;
            margin-bottom: 8px;
            border-radius: 6px;
        }

        .table-scrollbar-top::-webkit-scrollbar {
            height: 8px;
        }

        .table-scrollbar-top::-webkit-scrollbar-thumb {
            background-color: #6c757d;
            border-radius: 3px;
        }

        .table-scrollbar-top::-webkit-scrollbar-track {
            background-color: #e9ecef;
            border-radius: 3px;
        }

        /* Improved column widths */


        /* ID */
        .table th:nth-child(1),
        .table td:nth-child(1) {
            width: 80px;
        }

        /* Customer */
        .table th:nth-child(2),
        .table td:nth-child(2) {
            width: 150px;
            min-width: 150px;
        }

        /* Phone */
        .table th:nth-child(3),
        .table td:nth-child(3) {
            width: 140px;
            min-width: 140px;
        }

        /* Address */
        .table th:nth-child(4),
        .table td:nth-child(4) {
            width: 200px;
            min-width: 200px;
        }

        /* Subtotal */
        .table th:nth-child(5),
        .table td:nth-child(5) {
            width: 120px;
            min-width: 120px;
        }

        /* Delivery */
        .table th:nth-child(6),
        .table td:nth-child(6) {
            width: 120px;
            min-width: 120px;
        }

        /* Grand Total */
        .table th:nth-child(7),
        .table td:nth-child(7) {
            width: 130px;
            min-width: 130px;
        }

        /* Status */
        .table th:nth-child(8),
        .table td:nth-child(8) {
            width: 150px;
            min-width: 150px;
        }

        /* Items */
        .table th:nth-child(9),
        .table td:nth-child(9) {
            width: 250px;
            min-width: 250px;
        }

        /* Date */
        .table th:nth-child(10),
        .table td:nth-child(10) {
            width: 160px;
            min-width: 160px;
        }

        /* Action */
        .table th:nth-child(11),
        .table td:nth-child(11) {
            width: 150px;
            min-width: 150px;
        }


        /* Status badge improvements */
        .badge {
            font-size: 0.75rem;
            padding: 6px 10px;
            border-radius: 12px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 8px;
        }

        /* Status form improvements */
        .status-form {
            margin-top: 8px;
        }

        .status-form .form-select {
            font-size: 0.8rem;
            padding: 4px 8px;
            border-radius: 6px;
            border: 1px solid #ced4da;
        }

        /* Product items styling */
        .product-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
            border-bottom: 1px solid #f5f5f5;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-item img {
            border-radius: 6px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .product-item span {
            font-size: 0.85rem;
            line-height: 1.4;
            color: #495057;
        }


        /* Empty state styling */
        .table tbody tr td.text-center {
            padding: 40px;
            color: #6c757d;
            font-style: italic;
        }

        /* Table header improvements */
        .table th {
            white-space: nowrap;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.8rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .table-responsive {
                max-height: 70vh;
            }

            .table td,
            .table th {
                padding: 12px 8px;
                font-size: 0.85rem;
            }
        }
    </style>

    <div class="container">

        <div class="d-flex justify-content-between mb-3 align-items-center flex-wrap">
            <h2 class="mb-0">All Orders</h2>

            <form method="GET" action="{{ route('admin.orders') }}" class="d-flex align-items-center gap-2 mb-0">
                <label for="status" class="mb-0 fw-semibold">Filter by Status:</label>
                <select name="status" id="status" class="form-select form-select-sm d-inline-block w-auto shadow"
                    onchange="this.form.submit()">
                    <option value="">All</option>
                    @foreach (['pending', 'processing', 'completed', 'cancelled'] as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>




        <!-- Top scrollbar -->
        <div id="table-scroll-top" class="table-scrollbar-top">
            <div id="scroll-sync" style="width: 1800px;"></div>
        </div>

        @php
            $highlightId = session('highlight_id');
        @endphp

        <!-- Main scrollable table -->
        <div id="table-container" class="table-responsive">
            <table id="orders-table" class="table table-bordered align-middle px-3">
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
                        <tr @if ($highlightId == $order->id) id="highlight-row" class="table-success" @endif>
                            <td><strong>{{ $order->id }}</strong></td>
                            <td>{{ $order->user_name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>
                                <div style="max-height: 60px; overflow: hidden; text-overflow: ellipsis;">
                                    {{ Str::limit($order->address, 50) }}
                                </div>
                            </td>
                            <td class="text-nowrap">{{ number_format($order->subtotal, 2) }} bdt</td>
                            <td class="text-nowrap">{{ number_format($order->delivery_charge, 2) }} bdt</td>
                            <td class="text-nowrap"><strong>{{ number_format($order->grand_total, 2) }} bdt</strong></td>
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
                                <div class="d-flex flex-column gap-1">
                                    @foreach ($order->items as $item)
                                        <div class="product-item">
                                            @if ($item->product && $item->product->image)
                                                <img src="{{ asset($item->product->image) }}"
                                                    alt="{{ $item->product->name }}" width="50" height="50"
                                                    class="rounded border">
                                            @else
                                                <div class="rounded border bg-light d-flex align-items-center justify-content-center"
                                                    style="width: 50px; height: 50px;">
                                                    <small class="text-muted">No Image</small>
                                                </div>
                                            @endif
                                            <span>
                                                <strong>{{ $item->product ? $item->product->name : 'Product #' . $item->product_id }}</strong><br>
                                                <small class="text-muted">Qty: {{ $item->quantity }}</small>
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-nowrap">{{ $order->created_at->format('d M Y, h:i A') }}</td>
                            <td>

                                <span>
                                    Change Status :
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST"
                                        class="status-form mb-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="order_status" class="form-select form-select-sm"
                                            onchange="this.form.submit()">
                                            @foreach (['pending', 'processing', 'completed', 'cancelled'] as $status)
                                                <option value="{{ $status }}"
                                                    {{ $order->order_status === $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </span>

                                <span>
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                        class="delete-form mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                            Delete
                                        </button>
                                    </form>
                                </span>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-4">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $orders->links('pagination::bootstrap-5') }}
                    
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const topScroll = document.getElementById("table-scroll-top");
            const tableContainer = document.getElementById("table-container");
            const table = document.getElementById("orders-table");

            // Sync scroll both ways
            topScroll.addEventListener("scroll", () => {
                tableContainer.scrollLeft = topScroll.scrollLeft;
            });

            tableContainer.addEventListener("scroll", () => {
                topScroll.scrollLeft = tableContainer.scrollLeft;
            });

            // Auto set top scrollbar width to match table
            document.getElementById("scroll-sync").style.width = table.scrollWidth + "px";

            // ✅ Highlighted row scroll
            const highlightRow = document.getElementById("highlight-row");
            if (highlightRow && tableContainer) {
                // Calculate offset relative to scrollable container
                const containerTop = tableContainer.getBoundingClientRect().top;
                const rowTop = highlightRow.getBoundingClientRect().top;
                const scrollOffset = rowTop - containerTop - tableContainer.clientHeight / 2;

                tableContainer.scrollTo({
                    top: tableContainer.scrollTop + scrollOffset,
                    behavior: "smooth"
                });

                // Optional: remove highlight after 3s
                setTimeout(() => {
                    highlightRow.classList.remove("table-success");
                }, 3000);
            }
        });
    </script>

@endsection
