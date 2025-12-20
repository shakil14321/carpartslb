<?php

namespace App\Http\Controllers;

use App\Models\StandardShipping;
use App\Models\DistanceShipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function standardIndex(Request $request)
    {
        $q = $request->query('q'); 
        $standardShippings = StandardShipping::when($q, function ($query, $q) {
            $query->where('title', 'like', "%{$q}%");
        })->latest()->paginate(10);

        return view('admin.shipping.standard.index', compact('standardShippings', 'q'));
    }



    public function standardAdd()
    {
        return view('admin.shipping.standard.add');
    }


    public function standardStore(Request $request)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'cost'   => 'required|numeric|min:0',
            'status' => 'required|in:0,1',
        ]);

        StandardShipping::create([
            'title'  => $request->title,
            'cost'   => $request->cost,
            'status' => $request->status,
        ]);

        return redirect()->route('shipping.standard.index')
            ->with('success', 'Standard shipping added successfully');
    }


    public function standardEdit($id)
    {
        $shipping = StandardShipping::findOrFail($id);

        return view('admin.shipping.standard.edit', compact('shipping'));
    }


    public function standardUpdate(Request $request, $id)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'cost'   => 'required|numeric|min:0',
            'status' => 'required|in:0,1',
        ]);

        $shipping = StandardShipping::findOrFail($id);

        $shipping->update([
            'title'  => $request->title,
            'cost'   => $request->cost,
            'status' => $request->status,
        ]);

        return redirect()->route('shipping.standard.index')
            ->with('success', 'Standard shipping updated successfully');
    }


    public function standardDelete($id)
    {
        $shipping = StandardShipping::findOrFail($id);
        $shipping->delete();
        return redirect()->route('shipping.standard.index')
            ->with('success', 'Standard shipping deleted successfully');
    }






    // public function distanceIndex()
    // {
    //     $shippings = DistanceShipping::latest()->paginate(0); // pagination
    //     return view('admin.shipping.distance.index', compact('shippings'));
    // }

    // Add page
    public function distanceAdd()
    {
        return view('admin.shipping.distance.add');
    }

    // Store
    public function distanceStore(Request $request)
    {
        $request->validate([
            'per_km_price' => 'required|numeric|min:0',
            'min_cost'     => 'required|numeric|min:0',
            'max_cost'     => 'nullable|numeric|min:0',
        ]);

        DistanceShipping::create([
            'per_km_price' => $request->per_km_price,
            'min_cost'     => $request->min_cost,
            'max_cost'     => $request->max_cost,
        ]);

        return redirect()->route('shipping.distance.add')
            ->with('success', 'Distance shipping added successfully');
    }

    // Delete
    // public function distanceDelete($id)
    // {
    //     $shipping = DistanceShipping::findOrFail($id);
    //     $shipping->delete();

    //     return redirect()->route('shipping.distance.index')
    //         ->with('success', 'Distance shipping deleted successfully');
    // }

}
