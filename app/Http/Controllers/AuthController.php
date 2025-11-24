<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\VerifyEmailCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // middleware in routes: role:admin
    public function index()
    {
        $users = User::whereIn('role', ['admin', 'author'])->paginate(20);

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'phone' => 'required|string',
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'role'=>'required|in:admin,author,customer',
            'password'=>'nullable|confirmed'
        ]);

        $password = $request->password ?: Str::random(10);
        $code = strtoupper(Str::random(rand(6,8)));
        if (!preg_match('/\d/', $code)) {
            $code = substr_replace($code, rand(0,9), 0, 1);
        }

        // --- handle image upload ---
        $imageName = null;
        if ($request->hasFile('user_image')) {
            $image = $request->file('user_image');
            $imageName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/users'), $imageName);
        }

        // --- create user ---
        $user = User::create([
            'name' => $request->name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'user_image' => $imageName,
            'password' => Hash::make($password),
            'verification_code' => $code,
            'code_expires_at' => now()->addMinutes(20),
        ]);

        // --- send email ---
        Mail::to($user->email)->send(new VerifyEmailCode($code, $user->name));

        return redirect()->route('user.index')->with('success', 'User created and verification email sent.');
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string',
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'role'  => 'required|in:admin,author,customer',
        ]);

        $data = $request->only(['name', 'first_name', 'last_name', 'email', 'phone', 'role']);

        // Image upload handle karo
        if ($request->hasFile('user_image')) {
            // Purani image delete karo agar woh exist karti hai
            if ($user->user_image && file_exists(public_path('images/users/' . $user->user_image))) {
                unlink(public_path('images/users/' . $user->user_image));
            }

            // New image store karo
            $imageName = time() . '.' . $request->user_image->extension();
            $request->user_image->move(public_path('images/users'), $imageName);
            $data['user_image'] = $imageName;
        }

        $user->update($data);
        
        if(auth()->user()->role === 'author'){
        return redirect()->route('authorDashboard.view')->with('success', 'User updated successfully.');
        }

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Pehle image delete karo agar exist karti hai
        if ($user->user_image && file_exists(public_path('images/users/' . $user->user_image))) {
            unlink(public_path('images/users/' . $user->user_image));
        }

        // Phir user delete karo
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }

    public function destroyCustomer(User $user)
    {
        // Pehle image delete karo agar exist karti hai
        if ($user->user_image && file_exists(public_path('images/users/' . $user->user_image))) {
            unlink(public_path('images/users/' . $user->user_image));
        }

        // Phir user delete karo
        $user->delete();

        return redirect()->route('cutomers.view')->with('success', 'Customer deleted successfully.');
    }

    public function customersView(){
        $users = User::whereIn('role', ['customer'])->paginate(10);

        return view('admin.customer.index', compact('users'));
    }

    public function updateCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user = Auth::user();

        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('customerDashboard')
                        ->with('success', 'Update successfully');
    }
    
    // Multiple user delete functionality
    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');
    
        if (empty($ids)) {
            return redirect()->route('user.index')
                ->with('error', 'Please select at least one user to delete.');
        }
    
        // Get users
        $users = User::whereIn('id', $ids)->get();
    
        foreach ($users as $user) {
            if (!empty($user->user_image)) {
                $imagePath = public_path('images/users/' . $user->user_image);
    
                if (file_exists($imagePath)) {
                    @unlink($imagePath);
                }
            }
        }
    
        // Delete from database
        User::whereIn('id', $ids)->delete();
    
        return redirect()->route('cutomers.view')
            ->with('success', 'Selected Customers Deleted Successfully!');
    }
    
    public function authorView(){
        $users = User::whereIn('role', ['author'])->paginate(20);

        return view('admin.user.author', compact('users'));
    }
    
    public function customerSearch(Request $request)
    {
        $q = trim($request->input('q', ''));
    
        if ($q === '') {
            return redirect()->back()->with('error', 'Write something in search box.');
        }
    
        $users = User::query()
            ->where('role', 'customer') // 👈 sirf customer role filter
            ->where(function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%")
                      ->orWhere('email', 'LIKE', "%{$q}%");
            })
            ->latest()
            ->paginate(100)
            ->appends(['q' => $request->query('q')]);
    
        return view('admin.customer.search', compact('users', 'q'));
    }
}
