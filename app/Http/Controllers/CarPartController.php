<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\product;
use App\Models\brand;
use App\Models\CarModel;
use App\Models\CarPartType;
use Illuminate\Support\Str;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Exports\CarPartsExport;
use App\Imports\CarPartsImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class CarPartController extends Controller
{
    public function index(){
        $carParts = product::latest()->paginate(200);
        return view('admin.product.index', compact('carParts'));
    }

    public function create(){
        $brands = brand::all();
        $carModels = CarModel::all();
        $partTypes = CarPartType::all();
        $partBrands = SubCategories::all();

        // Models grouped by brand
        $modelsByBrand = CarModel::all()->groupBy('car_brand_id');

        return view('admin.product.create' , compact('brands' , 'carModels' , 'partTypes', 'modelsByBrand', 'partBrands'));
    }

    public function show($slug){
        $carPart = product::where('slug', $slug)->firstOrFail();
        $carPart->load(['brand', 'carModel', 'carPartType', 'SubCategories']);

        // decode gallery images JSON into array
        $carPart->gallery_images = $carPart->gallery_images
            ? json_decode($carPart->gallery_images, true)
            : [];

            // Fetch related products (6–8 random)
        $relatedProducts = product::where('part_type_id', $carPart->part_type_id)
        ->where('id', '!=', $carPart->id) // exclude current product
        ->inRandomOrder()
        ->take(8)
        ->get();

        $productId = $carPart->id;
        $productReviews = Review::where('product_id', $productId)->get();
        $averageRating = $productReviews->avg('rating');

        return view('front.pages.product', compact('carPart', 'relatedProducts', 'productReviews', 'averageRating'));
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            "car_brand_id" => "sometimes|nullable|integer|exists:brands,id",
            "car_model_id" => "sometimes|nullable|integer|exists:car_models,id",
            "part_type_id" => "sometimes|nullable|integer|exists:car_part_types,id",
            "part_brand_id" => "sometimes|nullable|integer|exists:SubCategories,id",

            "title" => "required|string",
            "sku" => "required|string|unique:products,sku",
            "part_number" => "required|string",
            "vin_code" => "nullable|string",
            'fav_product' => 'nullable|in:0,1',

            "original_price"     => "required|numeric|min:0",
            "sale_price" => "required|numeric|min:0",
            "stock_quantity" => "nullable|integer|min:0",
            "stock_type" => ['nullable', Rule::in(['in', 'out'])],

            "feature_image" => "nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048",
            "gallery_images" => "nullable|array",
            "gallery_images.*" => "nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048",

            "description" => "nullable|string",
            "short_description" => "nullable|string",
            "meta_title" => "nullable|string|max:65",
            "meta_description" => "nullable|string|max:170",
        ]);

         $slug = product::generateSlug($request->title);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        // Feature Image Upload
        $featureImageName = null;
        if($request->hasFile('feature_image')){
            $image = $request->file('feature_image');
            $featureImageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/parts/feature'), $featureImageName);
        }

        // Gallery Images Upload
        $galleryImageNames = [];
        if($request->hasFile('gallery_images')){
            foreach($request->file('gallery_images') as $galleryImage){
                $name = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
                $galleryImage->move(public_path('images/parts/gallery'), $name);
                $galleryImageNames[] = $name;
            }
        }

        // Create Car Part
        $carPart = product::create([
            "car_brand_id" => $request->car_brand_id ?: null,
            "car_model_id" => $request->car_model_id ?: null,
            "part_type_id" => $request->part_type_id ?: null,
            "part_brand_id" => $request->part_brand_id ?: null,
            "title" => $request->title,
            "slug" => $slug,
            "sku" => $request->sku,
            "part_number" => $request->part_number,
            "vin_code" => $request->vin_code,
            "fav_product" => $request->fav_product,
            "original_price" => $request->original_price,
            "sale_price" => $request->sale_price,
            "feature_image" => $featureImageName,
            "gallery_images" => json_encode($galleryImageNames), // assuming DB column is text/json
            "description" => $request->description,
            "short_description" => $request->short_description,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            'stock_type' => $request->stock_type,
            'stock_quantity' => $request->stock_quantity,
        ]);

        return redirect()->route('product.index')->with('success', 'Product Added Successfully');
    }

    public function edit($id){
        $product = product::findOrFail($id);
        $brands = brand::all();
        $carModels = CarModel::all();
        $partTypes = CarPartType::all();
        $partBrands = SubCategories::all();

        $modelsByBrand = CarModel::all()->groupBy('car_brand_id');

        return view('admin.product.edit', compact('product', 'brands', 'carModels', 'partTypes', 'modelsByBrand', 'partBrands'));
    }

    public function update(Request $request, $id){
        $carPart = product::findOrFail($id);

        $validation = Validator::make($request->all(), [
            "car_brand_id" => "sometimes|nullable|integer|exists:brands,id",
            "car_model_id" => "sometimes|nullable|integer|exists:car_models,id",
            "part_type_id" => "sometimes|nullable|integer|exists:car_part_types,id",
            "part_brand_id" => "sometimes|nullable|integer|exists:sub_categories,id",

            "title" => "required|string",
            "sku"   => "required|string|unique:products,sku,".$id,
            "part_number" => "required|string",
            "vin_code" => "nullable|string",
            'fav_product' => 'nullable|in:0,1',

            "original_price"     => "required|numeric|min:0",
            "sale_price" => "required|numeric|min:0",
            "stock_quantity" => "nullable|integer|min:0",
            "stock_type" => ['nullable', Rule::in(['in', 'out'])],

            "feature_image" => "nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048",
            "gallery_images" => "nullable|array",
            "gallery_images.*" => "nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048",

            "description" => "nullable|string",
            "short_description" => "nullable|string",
            "meta_title" => "nullable|string|max:65",
            "meta_description" => "nullable|string|max:170",
        ]);

        // Slug ko untouched rakho
        $slug = $carPart->slug;

        // Agar user ne manually slug bheja ho (form mein ek input rakho 'slug' ka)
        if ($request->filled('slug')) {
            $candidate = Str::slug($request->input('slug'));
            $exists = DB::table('products')
                        ->where('slug', $candidate)
                        ->where('id', '!=', $carPart->id)
                        ->exists();
            if ($exists) {
                $candidate = $candidate . '-' . $carPart->id;
            }
            $slug = $candidate;
        }

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        // Feature Image Upload & Delete Old
        if($request->hasFile('feature_image')){
            if($carPart->feature_image && file_exists(public_path('images/parts/feature/'.$carPart->feature_image))){
                unlink(public_path('images/parts/feature/'.$carPart->feature_image));
            }

            $image = $request->file('feature_image');
            $featureImageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/parts/feature'), $featureImageName);
            $carPart->feature_image = $featureImageName;
        }

        // Gallery Images Upload (replace or append)
        if ($request->hasFile('gallery_images')) {

    // Keep old images
    $existingGallery = json_decode($carPart->gallery_images, true) ?? [];
    $newGallery = [];

    // Upload new ones
    foreach ($request->file('gallery_images') as $galleryImage) {
        $name = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
        $galleryImage->move(public_path('images/parts/gallery'), $name);
        $newGallery[] = $name;
    }

    // Append new images with old ones
    $mergedGallery = array_merge($existingGallery, $newGallery);

    $carPart->gallery_images = json_encode($mergedGallery);
}

        // if($request->hasFile('gallery_images')){
        //     $galleryImageNames = [];

        //     // Optionally delete old gallery images
        //     if($carPart->gallery_images){
        //         $oldGallery = json_decode($carPart->gallery_images, true);
        //         foreach($oldGallery as $oldImg){
        //             if(file_exists(public_path('images/parts/gallery/'.$oldImg))){
        //                 unlink(public_path('images/parts/gallery/'.$oldImg));
        //             }
        //         }
        //     }

        //     foreach($request->file('gallery_images') as $galleryImage){
        //         $name = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
        //         $galleryImage->move(public_path('images/parts/gallery'), $name);
        //         $galleryImageNames[] = $name;
        //     }
        //     $carPart->gallery_images = json_encode($galleryImageNames);
        // }

        // Update other fields
        $carPart->update([
            "car_brand_id" => $request->car_brand_id ?? null,
            "car_model_id" => $request->car_model_id ?? null,
            "part_type_id" => $request->part_type_id ?? null,
            "part_brand_id" => $request->part_brand_id ?? null,
            "title" => $request->title,
            "slug"  => $slug,
            "sku"   => $request->sku,
            "part_number" => $request->part_number,
            "vin_code" => $request->vin_code,
            "fav_product" => $request->fav_product,
            "original_price" => $request->original_price,
            "sale_price" => $request->sale_price,
            'stock_type' => $request->stock_type,
            'stock_quantity' => $request->stock_quantity,
            "description" => $request->description,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
        ]);
        $carPart->save();

        return redirect()->route('product.index')->with('success', 'Product Updated Successfully');
    }

    public function destroy($id){
        $carPart = product::findOrFail($id);

        // Delete feature image (if file exists)
        if (!empty($carPart->feature_image)) {
            $featurePath = public_path('images/parts/feature/'.$carPart->feature_image);
            if (is_file($featurePath)) {   // more strict than file_exists
                @unlink($featurePath);     // @ suppresses warning if file missing
            }
        }

        // Delete gallery images (if any)
        if (!empty($carPart->gallery_images)) {
            $galleryImages = json_decode($carPart->gallery_images, true) ?? [];
            foreach ($galleryImages as $image) {
                $galleryPath = public_path('images/parts/gallery/'.$image);
                if (is_file($galleryPath)) {
                    @unlink($galleryPath);
                }
            }
        }

        // Delete DB record
        $carPart->delete();

        return redirect()->route('product.index')
                         ->with('success', 'Product Deleted Successfully');
    }

    public function deleteGalleryImage(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id', // ✅ correct table
            'image'      => 'required|string'
        ]);

        $product = product::findOrFail($request->product_id); // ✅ model bhi products use karo
        $imageToDelete = $request->image;

        $gallery = json_decode($product->gallery_images, true) ?? [];

        if (($key = array_search($imageToDelete, $gallery)) !== false) {
            unset($gallery[$key]);

            $product->gallery_images = json_encode(array_values($gallery));
            $product->save();

            $filePath = public_path('images/parts/gallery/' . $imageToDelete);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Image not found']);
    }


    public function importPartView(){
        return view('admin.exp_imp.import_products');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            product::truncate();
            Excel::import(new CarPartsImport, $request->file('file'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->with('error', 'Some rows failed validation')->with('failures', $failures);
        }

        // ✅ Redirect to route instead of back
        return redirect()->route('product.index')->with('success', 'Car Parts imported successfully.');
    }

    public function exportExcel()
    {
        $fileName = 'products' . now()->format('Y_m_d_H_i_s') . '.xlsx';
        return Excel::download(new CarPartsExport, $fileName);
    }

     public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return redirect()->route('product.index')
                ->with('error', 'Please select at least one brand to delete.');
        }

        // Get brands
        $carParts = product::whereIn('id', $ids)->get();

        foreach ($carParts as $carPart) {
            if (!empty($carPart->feature_image)) {
                $imagePath = public_path('images/feature/' . $carPart->feature_image);

                if (file_exists($imagePath)) {
                    @unlink($imagePath);
                }
            }
        }

        // Delete from database
        product::whereIn('id', $ids)->delete();

        return redirect()->route('product.index')
            ->with('success', 'Selected Products Deleted Successfully!');
    }

    public function productSearchAdmin(Request $request)
    {
        $q = trim($request->input('q', ''));

        if ($q === '') {
            return redirect()->back()->with('error', 'Write something in search box.');
        } else {
            $carParts = product::query()
                ->where('title', 'LIKE', "%{$q}%")
                ->orWhere('sku', 'LIKE', "%{$q}%")
                ->orWhere('part_number', 'LIKE', "%{$q}%")
                ->orWhereHas('brand', function ($qbr) use ($q) {
                    $qbr->where('title', 'LIKE', "%{$q}%");
                })
                ->latest()
                ->paginate(100)
                ->appends(['q' => $q]);
        }

        return view('admin.product.search', compact('carParts', 'q'));
    }

}
