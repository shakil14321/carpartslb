<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\CarPartType;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FwiProductController extends Controller
{
    public function index(Request $request)
    {
        $response = Http::get(config('services.fwi.base_url') . '/fwi-products', [
            'page' => $request->get('page', 1),
            'per_page' => 20,
        ]);

        if (!$response->successful()) {
            return back()->with('error', 'FWI API connection failed');
        }

        $body = $response->json();

        $products = $body['data']['data'] ?? [];
        $pagination = $body['data'] ?? [];

        return view('admin.fwi-products.index', compact('products', 'pagination'));
    }

    public function add($sourceProductId)
    {
        $exists = Product::where('source_type', 'freeworldimports')
            ->where('source_product_id', $sourceProductId)
            ->exists();

        if ($exists) {
            return redirect()->route('fwi-products.index')
                ->with('error', 'This product already added.');
        }

        $response = Http::get(config('services.fwi.base_url') . '/fwi-products/' . $sourceProductId);

        if (!$response->successful()) {
            return redirect()->route('fwi-products.index')
                ->with('error', 'Product not found from FWI API.');
        }

        $fwiProduct = (object) $response->json('data');

        $selectedCategory = null;
        $selectedSubCategory = null;

        if (!empty($fwiProduct->category['name'])) {
            $selectedCategory = CarPartType::firstOrCreate(
                ['slug' => Str::slug($fwiProduct->category['name'])],
                [
                    'title' => $fwiProduct->category['name'],
                    'description' => $fwiProduct->category['description'] ?? null,
                ]
            );
        }

        if (!empty($fwiProduct->sub_category['name'])) {
            $selectedSubCategory = SubCategories::firstOrCreate(
                ['slug' => Str::slug($fwiProduct->sub_category['name'])],
                [
                    'title' => $fwiProduct->sub_category['name'],
                    'description' => $fwiProduct->sub_category['description'] ?? null,
                ]
            );
        }

        $categories = CarPartType::orderBy('id', 'desc')->get();
        $subCategories = SubCategories::orderBy('id', 'desc')->get();

        return view('admin.fwi-products.add', compact(
            'fwiProduct',
            'categories',
            'subCategories',
            'selectedCategory',
            'selectedSubCategory'
        ));
    }

    public function storeToCarPart(Request $request, $sourceProductId)
    {
        $exists = Product::where('source_type', 'freeworldimports')
            ->where('source_product_id', $sourceProductId)
            ->exists();

        if ($exists) {
            return redirect()->route('fwi-products.index')
                ->with('error', 'This product already added.');
        }

        $request->validate([
            'cat_id' => 'required',
            'sub_cat_id' => 'nullable',
            'profit_margin' => 'required|numeric|min:0',
            'status' => 'required|in:0,1',
        ]);

        $response = Http::get(config('services.fwi.base_url') . '/fwi-products/' . $sourceProductId);

        if (!$response->successful()) {
            return redirect()->route('fwi-products.index')
                ->with('error', 'Product not found from FWI API.');
        }

        $item = $response->json('data');

        $sourcePrice = (float) ($item['source_price'] ?? 0);
        $minQuantity = (int) ($item['min_quantity'] ?? 0);

        $sellPrice = $sourcePrice + ($sourcePrice * ((float) $request->profit_margin / 100));

        Product::create([
            'part_type_id' => $request->cat_id,
            'part_brand_id' => $request->sub_cat_id,

            'title' => $item['product_name'],
            'slug' => Str::slug($item['product_name']) . '-' . $item['source_product_id'],
            'sku' => $item['unique_id'] ?? 'FWI-' . $item['source_product_id'],
            'part_number' => $item['unique_id'] ?? 'FWI-' . $item['source_product_id'],

            'original_price' => $sourcePrice,
            'sale_price' => $sellPrice,

            'stock_type' => 'in',
            'stock_quantity' => $minQuantity,

            'feature_image' => $item['image'] ?? null,
            'description' => $item['description'] ?? null,
            'short_description' => $item['meta_description'] ?? null,
            'meta_title' => $item['product_name'],
            'meta_description' => $item['meta_description'] ?? null,

            'source_type' => 'freeworldimports',
            'source_product_id' => $item['source_product_id'],
            'unique_id' => $item['unique_id'] ?? 'FWI-' . $item['source_product_id'],
            'profit_margin' => $request->profit_margin,

            'source_cat_id' => $item['category']['source_id'] ?? null,
            'source_sub_cat_id' => $item['sub_category']['source_id'] ?? null,
            'source_cat_name' => $item['category']['name'] ?? null,
            'source_sub_cat_name' => $item['sub_category']['name'] ?? null,
        ]);

        return redirect()->route('fwi-products.index')
            ->with('success', 'Product added successfully.');
    }
}
