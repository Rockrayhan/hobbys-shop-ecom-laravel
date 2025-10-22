<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('items.product')->latest();

        // Filter by status if provided
        if ($request->filled('status') && in_array($request->status, ['pending', 'processing', 'completed', 'cancelled'])) {
            $query->where('order_status', $request->status);
        }

        $orders = $query->paginate(10)->withQueryString(); // preserve filter in pagination links

        return view('backend.orders.index', compact('orders'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }




    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->order_status = $request->order_status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated to ' . ucfirst($order->order_status) . '!')
            ->with('highlight_id', $order->id);
    }




    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return redirect()->back()->with('success', 'Order deleted!');
    }
}
