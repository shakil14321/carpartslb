<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Support\Str;
use App\Models\CarPartBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CarPartsBrandsExport;
use App\Imports\CarPartsBrandsImport;
use Illuminate\Support\Facades\Validator;

class CarPartsBrandsController extends Controller
{
    public function index(){
        $carPartBrands = CarPartBrand::latest()->paginate(100);
        return view('admin.partsBrand.index', compact('carPartBrands'));
    }

    public function create(){
        return view('admin.partsBrand.create');
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            "title" => "required|string",
            "description" => "nullable|string",
            "brand_image" => "nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048",
        ]);

        $slug = CarPartBrand::generateSlug($request->title);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $imageName = null;
        if ($request->hasFile('brand_image')) {
            $image = $request->file('brand_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/brands'), $imageName);
        }

        CarPartBrand::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'brand_image' => $imageName,
        ]);

        return redirect()->route('part-brand.index')->with('success', 'Car Brand Added Successfully');
    }


    public function show($id){
        $carPartBrand = CarPartBrand::find($id);
        return view('admin.partsBrand.show', compact('carPartBrand'));
    }

    public function edit($id){
        $carPartBrand = CarPartBrand::find($id);
        return view('admin.partsBrand.edit', compact('carPartBrand'));
    }

    public function update(Request $request, $id){
        $carPartBrand = CarPartBrand::findOrFail($id);

        $validation = Validator::make($request->all(), [
            "title" => "required|string",
            "description" => "nullable|string",
            "brand_image" => "nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048",
        ]);

         // Slug will be untouch
        $slug = $carPartBrand->slug;

        // if user change the slug manually and send then (slug should be add in table)
        if ($request->filled('slug')) {
            $candidate = Str::slug($request->input('slug'));
            $exists = DB::table('car_parts_brands')
                        ->where('slug', $candidate)
                        ->where('id', '!=', $carPartBrand->id)
                        ->exists();
            if ($exists) {
                $candidate = $candidate . '-' . $carPartBrand->id;
            }
            $slug = $candidate;
        }

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $carPartBrand = CarPartBrand::findOrFail($id);
        $imageName = $carPartBrand->brand_image; // keep old image

        if ($request->hasFile('brand_image')) {
            // Purani image delete karo agar exist karti hai
            if ($imageName && file_exists(public_path('images/brands/' . $imageName))) {
                @unlink(public_path('images/brands/' . $imageName)); // @ suppress errors
            }

            // Nayi image upload karo
            $image = $request->file('brand_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/brands'), $imageName);
        }

        $carPartBrand->update([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'brand_image' => $imageName,
        ]);

        return redirect()->route('part-brand.index')->with('success', 'Car Brand Updated Successfully');
    }


    public function destroy($id){
        $carPartBrand = CarPartBrand::find($id);

        // delete image if exists
        if ($carPartBrand->brand_image && file_exists(public_path('images/models/' . $carPartBrand->brand_image))) {
            unlink(public_path('images/models/' . $carPartBrand->brand_image));
        }

        $carPartBrand->delete();
        return redirect()->route('part-brand.index')->with('success', 'Car Brand Deleted Successfully');
    }

    public function importBrandView(){
        return view('admin.exp_imp.import_part_brands');
    }

    public function exportExcel(){
        return Excel::download(new CarPartsBrandsExport, 'car_parts_brands.xlsx');
    }

    public function importExcel(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new CarPartsBrandsImport, $request->file('file'));

        return redirect()->route('part-brand.index')->with('success', 'Car Parts Brands Imported Successfully!');
    }
    
     public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');
    
        if (empty($ids)) {
            return redirect()->route('part-brand.index')
                ->with('error', 'Please select at least one brand to delete.');
        }
    
        // Get brands
        $carPartBrands = CarPartBrand::whereIn('id', $ids)->get();
    
        foreach ($carPartBrands as $carPartBrand) {
            if (!empty($carPartBrand->brand_image)) {
                $imagePath = public_path('images/brands/' . $carPartBrand->brand_image);
    
                if (file_exists($imagePath)) {
                    @unlink($imagePath);
                }
            }
        }
    
        // Delete from database
        CarPartBrand::whereIn('id', $ids)->delete();
    
        return redirect()->route('part-brand.index')
            ->with('success', 'Selected Car Part Brands Deleted Successfully!');
    }
    
    public function carPartBrandSearch(Request $request){
        $q = trim($request->input('q', ''));
        
        if($q === ''){
            return redirect()->back()->with('error', 'Write something in search box.');
        }
        
        $carPartBrands = CarPartBrand::query()
        ->where('title', 'LIKE', "%{$q}%")
        ->latest()
        ->paginate(100)
        ->appends(['q' => $request->query('q')]);
        
        return view('admin.partsBrand.search', compact('carPartBrands', 'q'));
    }
}
