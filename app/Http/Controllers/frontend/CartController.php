<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Add product to session cart
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $id = $request->id;
        $name = $request->name;
        $price = (float) $request->price;
        $image = $request->image; // ✅ capture image

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $name,
                'price' => $price,
                'image' => $image, // ✅ store image
                'quantity' => 1
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
