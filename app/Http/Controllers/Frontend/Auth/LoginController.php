<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\CarPart;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function adminDashboard(){
        $orders = Order::all()->count();
        $reviewOrders = Order::where('status', 'review')->count();
        $processOrders = Order::where('status', 'process')->count();
        $deliverOrders = Order::where('status', 'deliver')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $canceldOrders = Order::where('status', 'cancel')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        
        $totalCustomers = User::where('role', 'customer')->count();
        
        $products = CarPart::all()->count();
        
        $reviews = Review::all()->count();
        
        return view('admin.dashboard.index', compact('orders', 'reviewOrders', 'processOrders', 'deliverOrders', 'completedOrders', 'canceldOrders', 'totalRevenue', 'totalCustomers', 'products', 'reviews'));
    }
    
    public function authorDashboard(){
        return view('admin.dashboard.author');
    }
    
    public function showForm()
    {
        return view('front.pages.login');
    }

    public function adminLoginPage(){
        return view('front.pages.adminLogin');
    }
    
    public function authorLoginPage(){
        return view('front.pages.authorLogin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
            // 'g-recaptcha-response' => 'required'
        ]);

        // TODO: verify recaptcha server-side

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email incorrect.'])->withInput();
        }

        if (!$user->isVerified()) {
            return redirect()->route('verify.form')->withErrors(['email' => 'Email not verified. Please verify first.'])->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password incorrect.'])->withInput();
        }

        if ($user->role !== 'customer') {
            return back()->withErrors(['role' => 'You are not allowed to login here.'])->withInput();
        }

        Auth::login($user, $request->filled('remember'));

        // redirect to role dashboard

           return redirect()->intended(route('customerDashboard'));

    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
            // 'g-recaptcha-response' => 'required'
        ]);

        // TODO: verify recaptcha server-side

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email incorrect.'])->withInput();
        }

        if (!$user->isVerified()) {
            return redirect()->route('verify.form')->withErrors(['email' => 'Email not verified. Please verify first.'])->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password incorrect.'])->withInput();
        }

        if ($user->role !== 'admin') {
            return back()->withErrors(['role' => 'You are not allowed to login here.'])->withInput();
        }

        Auth::login($user, $request->filled('remember'));

        // redirect to role dashboard
        if ($user) {
            return redirect()->route('dashboard');
        }
    }
    
    public function authorLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
            // 'g-recaptcha-response' => 'required'
        ]);

        // TODO: verify recaptcha server-side

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email incorrect.'])->withInput();
        }

        if (!$user->isVerified()) {
            return redirect()->route('verify.form')->withErrors(['email' => 'Email not verified. Please verify first.'])->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password incorrect.'])->withInput();
        }

        if ($user->role !== 'author') {
            return back()->withErrors(['role' => 'You are not allowed to login here.'])->withInput();
        }

        Auth::login($user, $request->filled('remember'));

        // redirect to role dashboard
        if ($user) {
            return redirect()->route('authorDashboard.view');
        }
    }
    

    // Logout functionality
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.form')->with('success', 'Logged out.');
    }
}
