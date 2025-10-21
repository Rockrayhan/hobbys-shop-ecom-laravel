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
        // Get existing cart from session or empty array
        $cart = session()->get('cart', []);
        $subtotal = 0;

        // ✅ Handle Buy Now
        if ($request->has('product')) {
            $product = Product::where('slug', $request->product)->firstOrFail();

            // If product already exists in cart, just increase quantity by 1
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += 1;
            } else {
                // Otherwise, add new product to existing cart
                $cart[$product->id] = [
                    'name' => $product->name,
                    'price' => $product->current_price,
                    'quantity' => 1,
                    'image' => $product->image ? asset($product->image) : null,
                ];
            }

            // ✅ Save back to session
            session(['cart' => $cart]);
        }

        // ✅ Calculate subtotal for all cart items
        foreach ($cart as $item) {
            $subtotal += ((float) $item['price']) * ((int) $item['quantity']);
        }

        return view('frontend.checkout', compact('cart', 'subtotal'));
    }



    // public function buynow($id)
    // {
    //     $product = Product::with('category')->where('id', $id)->firstOrFail();

    //     return view('frontend.checkoutSingleProduct', compact('product', 'relatedProducts'));
    // }



    // place order
    public function placeOrder(Request $request)
    {
        // 1️⃣ Get the cart from session
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        // 2️⃣ Validate request
        $data = $request->validate([
            'user_name' => 'required|string|max:255',
            'phone' => 'required|string|max:40',
            'address' => 'required|string|max:1000',
            'is_inside_dhaka' => 'sometimes|boolean',
        ]);

        // 3️⃣ Determine delivery charge
        $isInside = $request->boolean('is_inside_dhaka', true);
        $deliveryCharge = $isInside ? 60.00 : 120.00;

        // 4️⃣ Calculate subtotal & total from session cart
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += ((float)$item['price']) * ((int)$item['quantity']);
        }
        $total = $subtotal + $deliveryCharge;

        // 5️⃣ Use DB transaction for safety
        try {
            DB::beginTransaction();

            // Create the order
            $order = Order::create([
                'user_name' => $data['user_name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'is_inside_dhaka' => $isInside,
                'delivery_charge' => $deliveryCharge,
                'subtotal' => $subtotal,
                'grand_total' => $subtotal + $deliveryCharge, // <- use correct column
                'order_status' => 'pending',
            ]);

            // Create order items
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

            // Clear cart session
            session()->forget('cart');

            // Redirect to success page
            return redirect()->route('order.success', $order->id);
        } catch (\Throwable $e) {
            DB::rollBack();

            // Log the detailed error for developers/admins
            Log::error('Order placement failed: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stack' => $e->getTraceAsString(),
            ]);

            // Show a generic error message to the user
            return back()->withErrors('Something went wrong while placing your order. Please try again later.');
        }
    }



    // show success page
    public function success(Order $order)
    {
        $order->load('items.product');
        return view('frontend.order_success', compact('order'));
    }
}
