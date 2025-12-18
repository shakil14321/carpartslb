<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShippingController extends Controller
{
    // List standard shipping methods
    public function standardIndex()
    {
        $standardShippings = [
            [
                'id' => 1,
                'name' => 'Inside City',
                'cost' => 5,
                'status' => 'Active',
            ],
            [
                'id' => 2,
                'name' => 'Outside City',
                'cost' => 10,
                'status' => 'Inactive',
            ],
        ];


        return view('admin.shipping.standard.index', compact('standardShippings'));
    }

    public function standardAdd()
    {
        // Example static data (optional prefill)
        $shipping = [
            'name' => '',
            'cost' => '',
            'status' => 'Active'
        ];

        return view('admin.shipping.standard.add', compact('shipping'));
    }


    // Edit standard shipping
    public function standardEdit($id)
    {
        $shipping = [
            'id' => $id,
            'name' => 'Inside City',
            'cost' => 5,
            'status' => 'Active',
        ];


        return view('admin.shipping.standard.edit', compact('shipping'));
    }


    // Update standard shipping (static)
    public function standardUpdate(Request $request, $id)
    {
        return redirect()->route('admin.shipping.standard.index')
            ->with('success', 'Standard shipping updated successfully');
    }


    // Delete standard shipping (static)
    public function standardDelete($id)
    {
        return redirect()->route('admin.shipping.standard.index')
            ->with('success', 'Standard shipping deleted successfully');
    }



     // List distance shipping (static)
    public function distanceIndex()
    {
        $shippings = [
            ['id' => 1, 'name' => 'Distance Shipping 1', 'per_km_cost' => '$0.5', 'min_cost' => '$3', 'max_cost' => '$25', 'status' => 'Active'],
            ['id' => 2, 'name' => 'Distance Shipping 2', 'per_km_cost' => '$1', 'min_cost' => '$5', 'max_cost' => '$50', 'status' => 'Inactive'],
        ];

        return view('admin.shipping.distance.index', compact('shippings'));
    }

    // Add distance shipping (static)
    public function distanceAdd()
    {
        $shipping = [
            'name' => '',
            'per_km_cost' => '',
            'min_cost' => '',
            'max_cost' => '',
            'status' => 'Active'
        ];

        return view('admin.shipping.distance.add', compact('shipping'));
    }

    // Edit distance shipping (static)
    public function distanceEdit($id)
    {
        $shipping = [
            'id' => $id,
            'name' => "Distance Shipping $id",
            'per_km_cost' => '$0.5',
            'min_cost' => '$3',
            'max_cost' => '$25',
            'status' => 'Active'
        ];

        return view('admin.shipping.distance.edit', compact('shipping'));
    }

    // Update distance shipping (just redirect, static)
    public function distanceUpdate(Request $request, $id)
    {
        return redirect()->route('shipping.distance.index')->with('success', 'Distance shipping updated successfully!');
    }

    // Delete distance shipping (just redirect, static)
    public function distanceDelete($id)
    {
        return redirect()->route('shipping.distance.index')->with('success', 'Distance shipping deleted successfully!');
    }

}
