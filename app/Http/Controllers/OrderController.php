<?php

namespace App\Http\Controllers;

use App\Mail\AdminOrderMail;
use App\Mail\OrderCancelledByCustomerMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use App\Mail\OrderStatusUpdatedMail;
use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // This is for admin dashboard. Show all orders
    public function index()
    {
        $orders = Order::latest()->paginate(100);

        return view('admin.order.index', compact('orders'));
    }

    // Show review orders in admin dashboard
    public function reviewOrders(){
        $orders = Order::where('status', 'review')->latest()->paginate(100);

        return view('admin.order.review', compact('orders'));
    }

    // Show process orders in admin dashboard
    public function processOrders(){
        $orders = Order::where('status', 'process')->latest()->paginate(100);

        return view('admin.order.process', compact('orders'));
    }

    // Show deliver order in admin dashboard
    public function deliverOrders(){
        $orders = Order::where('status', 'deliver')->latest()->paginate(100);

        return view('admin.order.deliver', compact('orders'));
    }

    // Show complete order in admin dashboard
    public function completeOrders(){
        $orders = Order::where('status', 'complete')->latest()->paginate(100);

        return view('admin.order.complete', compact('orders'));
    }

    // Show cancel order in admin dashboard
    public function cancelOrders(){
        $orders = Order::where('status', 'cancel')->latest()->paginate(100);

        return view('admin.order.cancel', compact('orders'));
    }

    // Single Order details in customer dashboard
    public function orderView($id){
        $order = Order::findOrFail($id);

        return view('customer.order.show', compact('order'));
    }

    // This is admin dashboard. Single order details
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.order.show', compact('order'));
    }

    // This is for checkout page
    // public function store(Request $request)
    // {
    //     $user_id = Auth::id();
    //     $cartItems = Cart::where('user_id', $user_id)->get();
    //     if ($cartItems->isEmpty()) return back()->with('error', 'Cart is empty.');

    //     $total = 0;
    //     $products = [];
    //     foreach ($cartItems as $item) {
    //         $price = $item->sale_price ?? $item->original_price ?? 0;
    //         $total += $price * $item->quantity;

    //         $products[$item->product_id] = [
    //             'title' => $item->product->title ?? '',
    //             'sale_price' => $item->sale_price,
    //             'original_price' => $item->original_price,
    //             'quantity' => $item->quantity,
    //             'slug' => $item->product->slug ?? '',
    //             'sku' => $item->sku,
    //             'part_number' => $item->part_number
    //         ];
    //     }

    //     $order = Order::create([
    //         'user_id' => $user_id,
    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'address_line_1' => $request->address_line_1,
    //         'address_line_2' => $request->address_line_2,
    //         'city' => $request->city,
    //         'state' => $request->state,
    //         'country' => $request->country,
    //         'postal_code' => $request->postal_code,
    //         'order_notes' => $request->order_notes,
    //         'total' => $total,
    //         'payment_method' => $request->payment_method ?? 'cod',
    //         'status' => 'pending',
    //         'order_number' => Str::upper(Str::random(10)),
    //         'order_address_default' => $request->order_address_default ?? 'no',
    //         'products' => $products,
    //     ]);

    //     // Clear user's cart
    //     Cart::where('user_id', $user_id)->delete();

    //     $user= User::find($request->user_id);
    //     // Session::forget('cart');
    //     try {
    //         // Customer email
    //         Mail::to($user->email)->send(new OrderMail($order));

    //         sleep(1);
    //         // Admin email
    //         Mail::to(env('MAIL_FROM_ADDRESS'))->send(new AdminOrderMail($order));

    //     } catch (\Exception $e) {

    //         // Log error
    //         Log::error('Order Email Error: '.$e->getMessage());

    //         // Show warning but DO NOT stop order creation
    //         return redirect()
    //             ->route('checkout.page')
    //             ->with('warning', 'Order placed but email failed to send. Please contact support.');
    //     }

    //     return redirect()->route('checkout.page', $order->id)
    //         ->with('success', 'Order placed successfully!');
    // }
    public function store(Request $request)
    {
        $user_id = Auth::id(); // may be null if guest

        // Get cart from session
        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return back()->with('error', 'Cart is empty.');
        }

        $total = 0;
        $products = [];

        foreach ($cartItems as $item) {
            $price = $item['sale_price'] ?? $item['original_price'] ?? 0;
            $total += $price * $item['quantity'];

            $products[$item['product_id']] = [
                'title' => $item['title'] ?? '',
                'sale_price' => $item['sale_price'] ?? 0,
                'original_price' => $item['original_price'] ?? 0,
                'quantity' => $item['quantity'],
                'slug' => $item['slug'] ?? '',
                'sku' => $item['sku'] ?? '',
                'part_number' => $item['part_number'] ?? ''
            ];
        }

        $order = Order::create([
            'user_id' => $user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'order_notes' => $request->order_notes,
            'total' => $total,
            'payment_method' => $request->payment_method ?? 'cod',
            'status' => 'pending',
            'order_number' => Str::upper(Str::random(10)),
            'order_address_default' => $request->order_address_default ?? 'no',
            'products' => $products,
        ]);

        // Clear session cart after order
        session()->forget('cart');

        try {
            if ($user_id) {
                $user = Auth::user();
                Mail::to($user->email)->send(new OrderMail($order));
            }

            // Admin notification
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new AdminOrderMail($order));

        } catch (\Exception $e) {
            Log::error('Order Email Error: '.$e->getMessage());

            return redirect()
                ->route('checkout.page')
                ->with('warning', 'Order placed but email failed to send. Please contact support.');
        }

        return redirect()->route('checkout.page', $order->id)
            ->with('success', 'Order placed successfully!');
    }


    public function storeDefault(Request $request)
    {
        // Validation
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'address_id' => 'nullable|exists:addresses,id',
            'order_notes' => 'nullable|string',
            'payment_method' => 'required|string',
            'status' => 'nullable|string|in:review,processing,complete,cancel',

            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address_line_1' => 'required|string',
            'address_line_2' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'country' => 'nullable|string',
            'order_address_default' => 'nullable|string',
        ]);

        // Get cart from session
        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return back()->with('error', 'Cart is empty.');
        }

        $total = 0;
        $products = [];

        foreach ($cartItems as $item) {
            $price = $item['sale_price'] ?? $item['original_price'] ?? 0;
            $total += $price * $item['quantity'];

            $products[$item['product_id']] = [
                'title' => $item['title'] ?? '',
                'sale_price' => $item['sale_price'] ?? 0,
                'original_price' => $item['original_price'] ?? 0,
                'quantity' => $item['quantity'],
                'slug' => $item['slug'] ?? '',
                'sku' => $item['sku'] ?? '',
                'part_number' => $item['part_number'] ?? ''
            ];
        }

        $randomOrderNumber = 'ORD-' . Str::upper(Str::random(8));

        // Create order
        $order = Order::create([
            'user_id' => $request->user_id,
            'address_id' => $request->address_id,
            'order_number' => $randomOrderNumber,
            'order_notes' => $request->order_notes,
            'payment_method' => $request->payment_method,
            'status' => $request->status ?? 'review',

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country ?? 'USA',
            'order_address_default' => $request->order_address_default,

            'total' => $total,
            'products' => $products,
        ]);

        // Clear session cart
        session()->forget('cart');

        // Send emails
        try {
            $user = User::find($request->user_id);
            if ($user) {
                Mail::to($user->email)->send(new OrderMail($order));
            }

            // Admin notification
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new AdminOrderMail($order));

        } catch (\Exception $e) {
            Log::error('Order Email Error: ' . $e->getMessage());

            return redirect()
                ->route('checkout.page')
                ->with('warning', 'Order placed but email failed to send. Please contact support.');
        }

        return redirect()->route('checkout.page')
            ->with('success', 'Order submitted successfully.');
    }

    // public function storeDefault(Request $request)
    // {
    //     // Validation
    //     $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'address_id' => 'nullable|exists:addresses,id',
    //         'order_notes' => 'nullable|string',
    //         'payment_method' => 'required|string',
    //         'status' => 'nullable|string|in:review,processing,complete,cancel',

    //         'first_name' => 'required|string',
    //         'last_name' => 'required|string',
    //         'address_line_1' => 'required|string',
    //         'address_line_2' => 'nullable|string',
    //         'city' => 'required|string',
    //         'state' => 'nullable|string',
    //         'postal_code' => 'nullable|string',
    //         'country' => 'nullable|string',
    //         'order_address_default' => 'nullable|string',

    //         'total' => 'required|string',
    //         'products' => 'required|array', // products ko array me bhejna hoga
    //     ]);

    //     // $user_id = Auth::id();
    //     $cartItems = Cart::where('user_id', $request->user_id)->get();
    //     if ($cartItems->isEmpty()) return back()->with('error', 'Cart is empty.');


    //     $total = 0;
    //     $products = [];
    //     foreach ($cartItems as $item) {
    //         $price = $item->sale_price ?? $item->original_price ?? 0;
    //         $total += $price * $item->quantity;

    //         $products[$item->product_id] = [
    //             'title' => $item->product->title ?? '',
    //             'sale_price' => $item->sale_price,
    //             'original_price' => $item->original_price,
    //             'quantity' => $item->quantity,
    //             'slug' => $item->product->slug ?? '',
    //             'sku' => $item->sku,
    //             'part_number' => $item->part_number
    //         ];
    //     }

    //     $randomOrderNumber = 'ORD-' . Str::upper(Str::random(8));

    //     // Order create
    //     $order = Order::create([
    //         'user_id' => $request->user_id,
    //         'address_id' => $request->address_id,
    //         'order_number' => $randomOrderNumber,
    //         'order_notes' => $request->order_notes,
    //         'payment_method' => $request->payment_method,
    //         'status' => $request->status ?? 'review',

    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'address_line_1' => $request->address_line_1,
    //         'address_line_2' => $request->address_line_2,
    //         'city' => $request->city,
    //         'state' => $request->state,
    //         'postal_code' => $request->postal_code,
    //         'country' => $request->country ?? 'USA',
    //         'order_address_default' => $request->order_address_default,

    //         'total' => $request->total,
    //         // 'products' => $request->products, // JSON format me save hoga
    //         'products' => $products,
    //     ]);

    //      Cart::where('user_id', $request->user_id)->delete();
    //      $user= User::find($request->user_id);
    //     // Session::forget('cart');
    //     try {
    //         // Customer email
    //         Mail::to($user->email)->send(new OrderMail($order));

    //         sleep(1);
    //         // Admin email
    //         Mail::to(env('MAIL_FROM_ADDRESS'))->send(new AdminOrderMail($order));

    //     } catch (\Exception $e) {

    //         // Log error
    //         Log::error('Order Email Error: '.$e->getMessage());

    //         // Show warning but DO NOT stop order creation
    //         return redirect()
    //             ->route('checkout.page')
    //             ->with('warning', 'Order placed but email failed to send. Please contact support.');
    //     }

    //     return redirect()->route('checkout.page')->with('success', 'Order submitted successfully.');
    // }

    // This is admin dashboard. Edit order
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.order.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'status' => $request->status,
        ]);

        if ($order->user && $order->user->email) {
            Mail::to($order->user->email)
                ->send(new OrderStatusUpdatedMail($order, $request->status));
        }

        return redirect()->back()
                         ->with('success', 'Order updated successfully.');
    }

    public function updateCustomer(Request $request, $id){
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'status' => $request->status,
        ]);

        if($request->status === 'cancel'){
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new OrderCancelledByCustomerMail($order));
        }

        return redirect()->back()
                         ->with('success', 'Order cancel successfully.');
    }


    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Order deleted successfully.');
    }

    // Multiple selected delete items
    public function deleteSelected(Request $request)
    {
       $ids = $request->ids;

       if($ids){
           Order::whereIn('id', $ids)->delete();
            return redirect()->route('orderView.admin')->with('success', 'Selected orders deleted successfully.');
       }
        return redirect()->route('orderView.admin')->with('error', 'No data found.');
    }

    // All delete items
    public function deleteAll()
    {
        Order::truncate();

        return redirect()->route('checkout.page')->with('success', 'All orders deleted successfully.');
    }

    // search functionality for all orders
    public function orderSearch(Request $request)
    {
        $q = trim($request->input('q', ''));

        if ($q === '') {
            return redirect()->route('orderView.admin')->with('error', 'Write something in search box.');
        }

        $orders = Order::query()
            ->where('order_number', 'LIKE', "%{$q}%")
            ->orWhere('first_name', 'LIKE', "%{$q}%")
            ->orWhere('last_name', 'LIKE', "%{$q}%")
            ->latest()
            ->paginate(100)
            ->appends(['q' => $q]);

        return view('admin.order.search', compact('orders', 'q'));
    }

    // search functionality for review orders
   public function orderReviewSearch(Request $request)
    {
        $q = trim($request->input('q', ''));

        if ($q === '') {
            return redirect()->route('reviewOrder.admin')->with('error', 'Write something in search box.');
        }

        $orders = Order::query()
            ->where('status', 'review')
            ->where(function($query) use ($q) {
                $query->where('order_number', 'LIKE', "%{$q}%")
                      ->orWhere('first_name', 'LIKE', "%{$q}%")
                      ->orWhere('last_name', 'LIKE', "%{$q}%");
            })
            ->latest()
            ->paginate(100)
            ->appends(['q' => $q]);

        return view('admin.order.reviewSearch', compact('orders', 'q'));
    }

    // search functionality for processing orders
   public function orderProcessSearch(Request $request)
    {
        $q = trim($request->input('q', ''));

        if ($q === '') {
            return redirect()->route('processOrder.admin')->with('error', 'Write something in search box.');
        }

        $orders = Order::query()
            ->where('status', 'process')
            ->where(function($query) use ($q) {
                $query->where('order_number', 'LIKE', "%{$q}%")
                      ->orWhere('first_name', 'LIKE', "%{$q}%")
                      ->orWhere('last_name', 'LIKE', "%{$q}%");
            })
            ->latest()
            ->paginate(100)
            ->appends(['q' => $q]);

        return view('admin.order.processSearch', compact('orders', 'q'));
    }

    // search functionality for deliver orders
   public function orderDeliverSearch(Request $request)
    {
        $q = trim($request->input('q', ''));

        if ($q === '') {
            return redirect()->route('deliverOrder.admin')->with('error', 'Write something in search box.');
        }

        $orders = Order::query()
            ->where('status', 'deliver')
            ->where(function($query) use ($q) {
                $query->where('order_number', 'LIKE', "%{$q}%")
                      ->orWhere('first_name', 'LIKE', "%{$q}%")
                      ->orWhere('last_name', 'LIKE', "%{$q}%");
            })
            ->latest()
            ->paginate(100)
            ->appends(['q' => $q]);

        return view('admin.order.deliverSearch', compact('orders', 'q'));
    }

    // search functionality for complete orders
   public function orderCompleteSearch(Request $request)
    {
        $q = trim($request->input('q', ''));

        if ($q === '') {
            return redirect()->route('completeOrder.admin')->with('error', 'Write something in search box.');
        }

        $orders = Order::query()
            ->where('status', 'complete')
            ->where(function($query) use ($q) {
                $query->where('order_number', 'LIKE', "%{$q}%")
                      ->orWhere('first_name', 'LIKE', "%{$q}%")
                      ->orWhere('last_name', 'LIKE', "%{$q}%");
            })
            ->latest()
            ->paginate(100)
            ->appends(['q' => $q]);

        return view('admin.order.completeSearch', compact('orders', 'q'));
    }

    // search functionality for cancel orders
   public function orderCancelSearch(Request $request)
    {
        $q = trim($request->input('q', ''));

        if ($q === '') {
            return redirect()->route('cancelOrders.admin')->with('error', 'Write something in search box.');
        }

        $orders = Order::query()
            ->where('status', 'cancel')
            ->where(function($query) use ($q) {
                $query->where('order_number', 'LIKE', "%{$q}%")
                      ->orWhere('first_name', 'LIKE', "%{$q}%")
                      ->orWhere('last_name', 'LIKE', "%{$q}%");
            })
            ->latest()
            ->paginate(100)
            ->appends(['q' => $q]);

        return view('admin.order.cancelSearch', compact('orders', 'q'));
    }


    public function cancelItem(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'sku'      => 'required|string',
        ]);

        $order = Order::find($request->order_id);

        // Only allow cancel if order status allows it
        if (!in_array($order->status, ['pending', 'process', 'review'])) {
            return back()->with('error', 'You cannot cancel items in this order.');
        }

        $products = $order->products; // this is decoded JSON array

        // Find product by SKU
        $productKey = null;
        foreach ($products as $key => $p) {
            if ($p['sku'] === $request->sku) {
                $productKey = $key;
                break;
            }
        }

        if ($productKey === null) {
            return back()->with('error', 'Product not found in order.');
        }

        // ❗ Change quantity to 0 instead of deleting
        $products[$productKey]['quantity'] = 0;

        // Recalculate total ignoring canceled items
        $total = 0;
        foreach ($products as $p) {
            if (($p['quantity'] ?? 0) > 0) { // ← ignore canceled products
                $price = $p['sale_price'] ?? $p['original_price'] ?? 0;
                $total += $price * $p['quantity'];
            }
        }

        // Update database
        $order->update([
            'products' => $products,
            'total'    => $total,
        ]);
        return redirect()->back()->with('success', 'Product canceled successfully.');
    }



    // public function cancelItem(Request $request)
    // {
    //     $request->validate([
    //         'order_id' => 'required|exists:orders,id',
    //         'sku' => 'required|string',
    //     ]);

    //     $order = Order::find($request->order_id);

    //     // Only allow cancel if order status allows it
    //     if (!in_array($order->status, ['pending', 'process', 'review'])) {
    //         return back()->with('error', 'You cannot cancel items in this order.');
    //     }

    //     $products = $order->products; // this is a JSON decoded array

    //     // Find the key of the product by SKU
    //     $productKey = null;
    //     foreach ($products as $key => $p) {
    //         if ($p['sku'] === $request->sku) {
    //             $productKey = $key;
    //             break;
    //         }
    //     }

    //     if (!$productKey) {
    //         return back()->with('error', 'Product not found in order.');
    //     }

    //     // Remove the product
    //     unset($products[$productKey]);

    //     // Recalculate total
    //     $total = 0;
    //     foreach ($products as $p) {
    //         $price = $p['sale_price'] ?? $p['original_price'] ?? 0;
    //         $total += $price * $p['quantity'];
    //     }

    //     // Update the order
    //     $order->update([
    //         'products' => $products,
    //         'total' => $total,
    //     ]);

    //     return back()->with('success', 'Product canceled successfully.');
    // }


}
