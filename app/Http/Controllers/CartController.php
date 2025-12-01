<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\CarPart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Get cart data (AJAX)
    public function data()
    {
        $user_id = Auth::id();
        $session_id = session()->getId();

        $cartItems = Cart::with('product')
            ->where(function($q) use ($user_id, $session_id) {
                if ($user_id) {
                    $q->where('user_id', $user_id);
                }
            })
            ->get();

        $total = 0;
        $count = 0;

        foreach ($cartItems as $item) {
            $price = $item->sale_price ?? $item->original_price ?? 0;
            $total += $price * $item->quantity;
            // $count += $item->quantity;
        }
        $count = $cartItems->count();

        return response()->json([
            'success' => true,
            'cart' => $cartItems,
            'total' => '$' . number_format($total, 2),
            'raw_total' => $total,
            'count' => $count,
        ]);

    }
    // public function data(Request $request)
    // {
    //     $user_id = Auth::id();
    //     $cartItems = Cart::with('product')->where('user_id', $user_id)->get();

    //     $total = 0;
    //     $count = 0;

    //     foreach ($cartItems as $item) {
    //         $price = $item->sale_price ?? $item->original_price ?? 0;
    //         $total += $price * $item->quantity;
    //         $count += $item->quantity;
    //     }

    //     return response()->json([
    //         'cart' => $cartItems,
    //         'total' => '$' . number_format($total, 2),
    //         'raw_total' => $total,
    //         'count' => $count,
    //     ]);
    // }

    // Add to cart
    public function addToCart(Request $request)
    {
        // dd($request->all());
        $user_id = Auth::id();
        if (!$user_id) {
            return response()->json([
                'success' => false,
                'message' => "Please login first for 'Add To Cart'"
            ], 200); // still 200 so Ajax won’t throw an error
        }
        $product_id = $request->product_id;

        // dd($request->all(), $session_id);
        $query = Cart::query();

        if ($user_id) {
            $query->where('user_id', $user_id);
        }

        $cart = $query->where('product_id', $product_id)->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => $request->quantity ? (int)$request->quantity : 1,
                'sale_price' => $request->sale_price,
                'original_price' => $request->original_price,
                'sku' => $request->sku,
                'part_number' => $request->part_number,
            ]);
        }

        return $this->data(); // now unified

        // $cart = Cart::where('user_id', $user_id)->where('product_id', $product_id)->first();
        // if ($cart) {
        //     $cart->quantity += 1;
        //     $cart->save();
        // } else {
        //     Cart::create([
        //         'user_id' => $user_id,
        //         'product_id' => $product_id,
        //         'quantity' => 1,
        //         'sale_price' => $request->sale_price,
        //         'original_price' => $request->original_price,
        //         'sku' => $request->sku,
        //         'part_number' => $request->part_number,
        //     ]);
        // }

        // return $this->data($request);
    }

     // Update quantity
    public function updateQuantity(Request $request)
    {
        $cart = Cart::find($request->id);
        if (!$cart) return response()->json(['success' => false]);

        if ($request->type === 'plus') $cart->quantity += 1;
        elseif ($request->type === 'minus' && $cart->quantity > 1) $cart->quantity -= 1;

        $cart->save();
        return $this->data($request);
    }

    // Remove item
    public function removeFromCart(Request $request)
    {
        $cart = Cart::find($request->id);
        if ($cart) $cart->delete();
        return $this->data($request);
    }

    // Checkout page
    public function checkoutPage()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $addresses = Address::where('user_id', $user_id)->get();
        $defaultAddress = Address::where('user_id', $user_id)->where('is_default', true)->first();

        $cartItems = Cart::with('product')->where('user_id', $user_id)->get();

        $total = 0;
        $count = 0;
        foreach ($cartItems as $item) {
            $price = $item->sale_price ?? $item->original_price ?? 0;
            $total += $price * $item->quantity;
            $count += $item->quantity;
        }

        return view('front.pages.checkout', compact('user', 'addresses', 'defaultAddress', 'cartItems', 'total', 'count'));
    }

}
