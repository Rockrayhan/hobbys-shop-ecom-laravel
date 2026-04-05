<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class CartController extends Controller
{

    // Add product to session cart
   public function addToCart(Request $request)
{
    $cart = session()->get('cart', []);

    $id = $request->id;
    $variationId = $request->variation_id;

    $name = $request->name;
    $price = (float) $request->price;
    $image = $request->image;

    // ✅ Get variation (if selected)
    $variation = $variationId ? ProductVariation::find($variationId) : null;
    $size = $variation ? $variation->size : null;

    // ✅ Check if product has variations
    $product = Product::with('variations')->find($id);
    $hasVariation = $product && $product->variations->count() > 0;

    // 🔑 UNIQUE KEY (product + variation)
    $cartKey = $variationId ? $id . '-' . $variationId : $id;

    if (isset($cart[$cartKey])) {
        $cart[$cartKey]['quantity']++;
    } else {
        $cart[$cartKey] = [
            'id' => $id,
            'variation_id' => $variationId,
            'size' => $size,
            'has_variation' => $hasVariation, // ✅ IMPORTANT
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'quantity' => 1,
        ];
    }

    session()->put('cart', $cart);

    return response()->json([
        'status' => 'success',
        'cart_count' => count($cart),
        'cart_view' => view('frontend.includes.cart_body')->render()
    ]);
}


    // Remove item
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'status' => 'success',
            'cart_count' => count($cart),
            'cart_view' => view('frontend.includes.cart_body')->render()
        ]);
    }



    // Update quantity
    public function updateQuantity(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($request->action === 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($request->action === 'decrease' && $cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            }
            session()->put('cart', $cart);
        }

        return response()->json([
            'status' => 'success',
            'cart_count' => count($cart),
            'cart_view' => view('frontend.includes.cart_body')->render()
        ]);
    }
}
