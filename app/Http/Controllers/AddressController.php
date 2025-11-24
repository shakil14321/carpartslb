<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AddressController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $addresses = $user->addresses;
        $orders = $user->orders()->latest()->paginate(10);

        return view('customer.dashboard', compact('addresses', 'orders'));
    }

    public function create()
    {
        return view('customer.address.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'nullable|string|max:50',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'is_default' => 'sometimes|boolean',
        ]);

        // Ensure is_default is true/false
        $validated['is_default'] = $request->has('is_default') ? true : false;

        $user = Auth::user();

        // Reset other addresses only if current is default
        if ($validated['is_default']) {
            $user->addresses()->update(['is_default' => false]);
        }

        $user->addresses()->create($validated);

        return redirect()->route('customerDashboard')->with('success', 'Address added successfully.');
    }

    public function edit(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            return redirect()->route('customerDashboard')->with('error', 'Unauthorized.');
        }

        return view('customer.address.edit', compact('address'));
    }

   public function update(Request $request, Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            return redirect()->route('customerDashboard')->with('error', 'Unauthorized.');
        }

        $validated = $request->validate([
            'type' => 'nullable|string|max:50',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        // Convert checkbox to boolean manually
        $validated['is_default'] = $request->has('is_default') ? true : false;

        // Reset other addresses if this one is default
        if ($validated['is_default']) {
            $address->user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
        }

        // Update current address
        $address->update($validated);

        return redirect()->route('customerDashboard')->with('success', 'Address updated successfully.');
    }


    public function destroy(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            return redirect()->route('customerDashboard')->with('error', 'Unauthorized.');
        }

        $address->delete();

        return redirect()->route('customerDashboard')->with('success', 'Address deleted successfully.');
    }
}
