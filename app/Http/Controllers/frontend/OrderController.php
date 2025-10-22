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

    // public function showCheckoutPage()
    // {
    //     $cart = session()->get('cart', []);
    //     // if (empty($cart)) {
    //     //     return redirect()->route('home')->with('info', 'Your cart is empty.');
    //     // }


    //     $subtotal = 0;
    //     foreach ($cart as $id => $item) {
    //         $subtotal += ((float)$item['price']) * ((int)$item['quantity']);
    //     }

    //     return view('frontend.checkout', compact('cart', 'subtotal'));
    // }
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


    // public function buynow($id)
    // {
    //     $product = Product::with('category')->where('id', $id)->firstOrFail();

    //     return view('frontend.checkoutSingleProduct', compact('product', 'relatedProducts'));
    // }

public function placeOrder(Request $request)
{
    // 🛒 Combine both sources
    $cart = session()->get('cart', []);
    $buyNowItem = session()->get('buy_now_item');

    if ($buyNowItem) {
        $cart[$buyNowItem['id']] = $buyNowItem;
    }

    if (empty($cart)) {
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
    $subtotal = collect($cart)->sum(fn($item) => ((float) $item['price']) * ((int) $item['quantity']));
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

        // ✅ Clear only Buy Now temp item (keep cart if you want)
        session()->forget('buy_now_item');
        // If you want to clear full cart too, uncomment below:
        // session()->forget('cart');

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
