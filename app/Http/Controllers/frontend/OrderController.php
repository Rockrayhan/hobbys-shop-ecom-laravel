<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{


    public function showCheckoutPage(Request $request)
    {
        // 🛒 Existing cart
        $cart = session()->get('cart', []);

        // 💥 Handle Buy Now (if product param exists)
        if ($request->has('product')) {
            $product = Product::where('slug', $request->product)->firstOrFail();

            // Temporary Buy Now item (not saved in cart)
            $buyNowItem = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->current_price,
                'quantity' => 1,
                'image' => $product->image ? asset($product->image) : null,
                'is_buy_now' => true, // flag for UI
            ];

            // Store temporarily in session for checkout
            session(['buy_now_item' => $buyNowItem]);

            // ✅ Merge cart + buy now item (but do not modify session cart)
            $cartWithBuyNow = $cart;
            $cartWithBuyNow[$buyNowItem['id']] = $buyNowItem;
        } else {
            // Normal checkout
            $cartWithBuyNow = $cart;
        }

        // 🧮 Calculate subtotal
        $subtotal = collect($cartWithBuyNow)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('frontend.checkout', [
            'cart' => $cartWithBuyNow,
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
    $cart = collect($frontendCart)->mapWithKeys(function ($item) {
        $unitPrice = $item['lineTotal'] / $item['qty'];
        return [
            $item['id'] => [
                'id' => $item['id'],
                'name' => $item['name'],
                'price' => $unitPrice,
                'quantity' => $item['qty'],
            ]
        ];
    });

    $subtotal = $cart->sum(fn($item) => $item['price'] * $item['quantity']);
    $total = $subtotal + $deliveryCharge;

    try {
        DB::beginTransaction();

        $order = Order::create([
            'user_name' => $data['user_name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'delivery_charge' => $deliveryCharge,
            'subtotal' => $subtotal,
            'grand_total' => $total,
            'order_status' => 'pending',
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
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




    // show success page
    public function success(Order $order)
    {
        $order->load('items.product');
        return view('frontend.order_success', compact('order'));
    }
}
