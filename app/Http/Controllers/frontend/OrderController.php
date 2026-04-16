<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

    public function showCheckoutPage(Request $request)
    {
        $cart = session()->get('cart', []);

        // ✅ Case 1: Product WITH variation
        if ($request->has('product') && $request->has('variation_id')) {

            $product = Product::where('slug', $request->product)->firstOrFail();
            $variation = ProductVariation::findOrFail($request->variation_id);

            $buyNowItem = [
                'id' => $product->id,
                'variation_id' => $variation->id,
                'size' => $variation->size,
                'name' => $product->name,
                'price' => $product->current_price,
                'quantity' => 1,
                'image' => $product->image ? asset($product->image) : null,
                'is_buy_now' => true,
            ];

            $cart[$product->id . '-' . $variation->id] = $buyNowItem;
        }

        // ✅ Case 2: Product WITHOUT variation
        elseif ($request->has('product')) {

            $product = Product::where('slug', $request->product)->firstOrFail();

            $buyNowItem = [
                'id' => $product->id,
                'variation_id' => null,
                'size' => null,
                'name' => $product->name,
                'price' => $product->current_price,
                'quantity' => 1,
                'image' => $product->image ? asset($product->image) : null,
                'is_buy_now' => true,
            ];

            // 🔑 unique key without variation
            $cart[$product->id] = $buyNowItem;
        }

        // 🧮 subtotal
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('frontend.checkout', [
            'cart' => $cart,
            'subtotal' => $subtotal,
        ]);
    }


    public function placeOrder(Request $request)
    {
        // ✅ Decode updated cart from frontend
        $frontendCart = json_decode($request->input('cart_data'), true) ?? [];

        if (empty($frontendCart)) {
            return back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        // ✅ Validation
        $data = $request->validate([
            'user_name' => 'required|string|max:255',
            'phone' => 'required|string|max:40',
            'address' => 'required|string|max:1000',
            'delivery_charge' => 'required|numeric|in:60,100',
        ]);

        $deliveryCharge = (float) $data['delivery_charge'];

        // ✅ Build normalized cart structure
        $cart = collect($frontendCart)->map(function ($item) {
            return [
                'product_id'   => $item['product_id'] ?? $item['id'],
                'variation_id' => $item['variation_id'] ?? null,
                'name'         => $item['name'],
                'size'         => $item['size'] ?? null,
                'price'        => $item['lineTotal'] / $item['qty'],
                'quantity'     => $item['qty'],
            ];
        });

        // dd($frontendCart, $cart->toArray());


        $subtotal = $cart->sum(fn($item) => $item['price'] * $item['quantity']);
        $total = $subtotal + $deliveryCharge;

        // create unique traking number
        $trackingNumber = 'TRK-' . strtoupper(uniqid());


        try {
            DB::beginTransaction();

            $order = Order::create([
                'tracking_number' => $trackingNumber,
                'user_name' => $data['user_name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'delivery_charge' => $deliveryCharge,
                'subtotal' => $subtotal,
                'grand_total' => $total,
                'order_status' => 'pending',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'variation_id' => $item['variation_id'] ?? null,
                    'size' => $item['size'],
                    'quantity' => (int)$item['quantity'],
                    'unit_price' => (float)$item['price'],
                    'total_price' => ((float)$item['price']) * ((int)$item['quantity']),
                ]);
            }

            DB::commit();

            // ✅ Clear both cart and temporary buy-now item
            session()->forget('cart');
            session()->forget('buy_now_item');

            // ✅ Optional: You can also flash a success message
            // session()->flash('success', 'Your order has been placed successfully!');

            return redirect()->route('order.success', $order->id);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Order placement failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return back()->withErrors('Something went wrong while placing your order.');
        }
    }





    public function trackOrderPage()
    {
        return view('frontend.track_order');
    }





    public function trackOrder(Request $request)
    {
        $request->validate(['tracking_number' => 'required|string']);

        $order = Order::where('tracking_number', $request->tracking_number)->first();

        if (!$order) {
            return back()->withErrors(['tracking_number' => 'Tracking number not found!']);
        }

        return view('frontend.track_order_result', compact('order'));
    }
}
