<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\CarBrandsExport;
use App\Imports\CarBrandsImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class CarBrandController extends Controller
{
    public function index(){
        $carBrands = CarBrand::latest()->paginate(10);
        return view('admin.brand.all', compact('carBrands'));
    }

    public function create(){
        return view('admin.brand.add');
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            "title" => "required|string",
            "description" => "nullable|string",
            "brand_image" => "nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048",
        ]);

        $slug = CarBrand::generateSlug($request->title);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $imageName = null;
        if ($request->hasFile('brand_image')) {
            $image = $request->file('brand_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/brands'), $imageName);
        }

        CarBrand::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'brand_image' => $imageName,
        ]);

        return redirect()->route('brand.index')->with('success', 'Car Brand Added Successfully');
    }


    public function show($id){
        $carBrand = CarBrand::find($id);
        return view('admin.brand.show', compact('carBrand'));
    }

    public function edit($id){
        $carBrand = CarBrand::find($id);
        return view('admin.brand.edit', compact('carBrand'));
    }

    public function update(Request $request, $id){
        $carBrand = CarBrand::findOrFail($id);

        $validation = Validator::make($request->all(), [
            "title" => "required|string",
            "description" => "nullable|string",
            "brand_image" => "nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048",
        ]);

        // Slug will be untouch
        $slug = $carBrand->slug;

        // if user change the slug manually and send then (slug should be add in table)
        if ($request->filled('slug')) {
            $candidate = Str::slug($request->input('slug'));
            $exists = DB::table('car_brands')
                        ->where('slug', $candidate)
                        ->where('id', '!=', $carBrand->id)
                        ->exists();
            if ($exists) {
                $candidate = $candidate . '-' . $carBrand->id;
            }
            $slug = $candidate;
        }

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $carBrand = CarBrand::findOrFail($id);
        $imageName = $carBrand->brand_image; // keep old image

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

        $carBrand->update([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'brand_image' => $imageName,
        ]);

        return redirect()->route('brand.index')->with('success', 'Car Brand Updated Successfully');
    }


    public function destroy($id)
    {
        $carBrand = CarBrand::find($id);
    
        // check if record exists
        if (!$carBrand) {
            return redirect()->route('brand.index')->with('error', 'Car Brand not found.');
        }
    
        // delete image if exists
        if (!empty($carBrand->brand_image) && file_exists(public_path('images/models/' . $carBrand->brand_image))) {
            unlink(public_path('images/models/' . $carBrand->brand_image));
        }
    
        // delete record
        $carBrand->delete();
    
        return redirect()->route('brand.index')->with('success', 'Car Brand Deleted Successfully');
    }


    public function importBrandView(){
        return view('admin.exp_imp.import_brands');
    }

    public function exportExcel(){
        return Excel::download(new CarBrandsExport, 'car_brands.xlsx');
    }

    public function importExcel(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new CarBrandsImport, $request->file('file'));

        return redirect()->route('brand.index')->with('success', 'Car Brands Imported Successfully!');
    }
    
    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');
    
        if (empty($ids)) {
            return redirect()->route('brand.index')
                ->with('error', 'Please select at least one brand to delete.');
        }
    
        // Get brands
        $carBrands = CarBrand::whereIn('id', $ids)->get();
    
        foreach ($carBrands as $brand) {
            if (!empty($brand->brand_image)) {
                $imagePath = public_path('images/brands/' . $brand->brand_image);
    
                if (file_exists($imagePath)) {
                    @unlink($imagePath);
                }
            }
        }
    
        // Delete from database
        CarBrand::whereIn('id', $ids)->delete();
    
        return redirect()->route('brand.index')
            ->with('success', 'Selected Car Brands Deleted Successfully!');
    }

    // seach functionality
    public function carBrandSearch(Request $request){
        $q = trim($request->input('q', ''));
        
        if($q === ''){
            return redirect()->back()->with('error', 'Write something in search box.');
        }
        
        $carBrands = CarBrand::query()
        ->where('title', 'LIKE', "%{$q}%")
        ->latest()
        ->paginate(100)
        ->appends(['q' => $request->query('q')]);
        
        return view('admin.brand.search', compact('carBrands', 'q'));
    }
}
