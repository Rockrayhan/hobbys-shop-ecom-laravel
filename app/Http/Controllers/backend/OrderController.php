<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')->latest()->get();

        return view('backend.orders.index', compact('orders'));
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
