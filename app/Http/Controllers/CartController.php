<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\CarPart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\DistanceShipping;
use App\Models\StandardShipping;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Get cart data (AJAX)
    public function data()
    {

        $cart = session()->get('cart', []);
        // dd($cart);
        $total = 0;
        $count = 0;

        foreach ($cart as $item) {
            $price = $item['sale_price'] ?? $item['original_price'] ?? 0;
            $total += $price * $item['quantity'];
            // $count += $item['quantity'];
        }

        $count = count($cart);

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'total' => '$' . number_format($total, 2),
            'raw_total' => $total,
            'count' => $count,
        ]);
        // $user_id = Auth::id();
        // $session_id = session()->getId();

        // $cartItems = Cart::with('product')
        //     ->where(function ($q) use ($user_id, $session_id) {
        //         if ($user_id) {
        //             $q->where('user_id', $user_id);
        //         } else {
        //             $q->where('session_id', $session_id);
        //         }
        //     })
        //     ->get();
        // // $cartItems = Cart::with('product')
        // //     ->where(function($q) use ($user_id, $session_id) {
        // //         if ($user_id) {
        // //             $q->where('user_id', $user_id);
        // //         }
        // //     })
        // //     ->get();

        // $total = 0;
        // $count = 0;

        // foreach ($cartItems as $item) {
        //     $price = $item->sale_price ?? $item->original_price ?? 0;
        //     $total += $price * $item->quantity;
        //     // $count += $item->quantity;
        // }
        // $count = $cartItems->count();

        // return response()->json([
        //     'success' => true,
        //     'cart' => $cartItems,
        //     'total' => '$' . number_format($total, 2),
        //     'raw_total' => $total,
        //     'count' => $count,
        // ]);

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
        $cart = session()->get('cart', []); // get cart from session, default empty array

        $productId = $request->product_id;
        $product = CarPart::where('id', $productId)->first();

        if (isset($cart[$productId])) {
            // Product already in cart, increment quantity
            $cart[$productId]['quantity'] += $request->quantity ?? 1;
        } else {
            // Add new product
            $cart[$productId] = [
                'product_id' => $productId,
                'title' => $product->title,
                'quantity' => $request->quantity ?? 1,
                'sale_price' => $request->sale_price,
                'original_price' => $request->original_price,
                'sku' => $request->sku,
                'slug' => $product->slug,
                'part_number' => $request->part_number,
                'image' => $product->feature_image
            ];
        }

        session()->put('cart', $cart); // save back to session

        return $this->data();
        // dd($request->all());
        // $user_id = Auth::id();
        // $session_id = session()->getId();

        // // if (!$user_id) {
        // //     return response()->json([
        // //         'success' => false,
        // //         'message' => "Please login first for 'Add To Cart'"
        // //     ], 200); // still 200 so Ajax won’t throw an error
        // // }
        // $product_id = $request->product_id;

        // // dd($request->all(), $session_id);
        // $query = Cart::query();

        // if ($user_id) {
        //     $query->where('user_id', $user_id);
        // } else {
        //     $query->where('session_id', $session_id);
        // }
        // // if ($user_id) {
        // //     $query->where('user_id', $user_id);
        // // }

        // $cart = $query->where('product_id', $product_id)->first();

        // if ($cart) {
        //     $cart->quantity += 1;
        //     $cart->save();
        // } else {
        //     Cart::create([
        //         'user_id' => $user_id,
        //         'session_id' => $session_id,
        //         'product_id' => $product_id,
        //         'quantity' => $request->quantity ? (int)$request->quantity : 1,
        //         'sale_price' => $request->sale_price,
        //         'original_price' => $request->original_price,
        //         'sku' => $request->sku,
        //         'part_number' => $request->part_number,
        //     ]);
        // }

        // return $this->data(); // now unified

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
        $productId = $request->id; // product_id from frontend
        $cart = session()->get('cart', []);

        if (!isset($cart[$productId])) {
            return response()->json(['success' => false, 'message' => 'Item not found in cart']);
        }

        // Update quantity
        if ($request->type === 'plus') {
            $cart[$productId]['quantity'] += 1;
        } elseif ($request->type === 'minus' && $cart[$productId]['quantity'] > 1) {
            $cart[$productId]['quantity'] -= 1;
        }

        // Save back to session
        session()->put('cart', $cart);

        // Return updated cart data
        return $this->data();
        // $cart = Cart::find($request->id);
        // if (!$cart) return response()->json(['success' => false]);

        // if ($request->type === 'plus') $cart->quantity += 1;
        // elseif ($request->type === 'minus' && $cart->quantity > 1) $cart->quantity -= 1;

        // $cart->save();
        // return $this->data($request);
    }

    // Remove item
    public function removeFromCart(Request $request)
    {
        $productId = $request->id; // the product_id to remove
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]); // remove item
            session()->put('cart', $cart); // save back to session
        }

        return $this->data();
        // $cart = Cart::find($request->id);
        // if ($cart) $cart->delete();
        // return $this->data($request);
    }

    // Checkout page
    public function checkoutPage()
    {
        // $user = Auth::user();
        // $user_id = $user->id;

        // $addresses = Address::where('user_id', $user_id)->get();
        // $defaultAddress = Address::where('user_id', $user_id)->where('is_default', true)->first();

        // $cartItems = Cart::with('product')->where('user_id', $user_id)->get();

        // $total = 0;
        // $count = 0;
        // foreach ($cartItems as $item) {
        //     $price = $item->sale_price ?? $item->original_price ?? 0;
        //     $total += $price * $item->quantity;
        //     $count += $item->quantity;
        // }
        $user = Auth::user();

        // Addresses only for logged-in users
        $addresses = $user ? Address::where('user_id', $user->id)->get() : collect();
        $defaultAddress = $user ? Address::where('user_id', $user->id)->where('is_default', true)->first() : null;

        // Cart from session
        $cart = session()->get('cart', []);

        $cartItems = array_values($cart); // array of items
        $total = 0;
        $count = 0;

        foreach ($cartItems as $item) {
            $price = $item['sale_price'] ?? $item['original_price'] ?? 0;
            $total += $price * $item['quantity'];
            $count += $item['quantity']; // total quantity of items
        }

        $standardShippings = StandardShipping::where('status', 1)->get();
    $distanceShippings = DistanceShipping::where('status', 1)->get();

        return view('front.pages.checkout', compact('user', 'addresses', 'defaultAddress', 'cartItems', 'total', 'count',   'standardShippings',
    'distanceShippings' ));
    }

}