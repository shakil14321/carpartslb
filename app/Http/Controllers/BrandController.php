<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\CarModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\brandsExport;
use App\Imports\brandsImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class brandController extends Controller
{
    public function index(){
        $brands = brand::latest()->paginate(10);
        return view('admin.brand.all', compact('brands'));
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

        $slug = brand::generateSlug($request->title);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $imageName = null;
        if ($request->hasFile('brand_image')) {
            $image = $request->file('brand_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/brands'), $imageName);
        }

        brand::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'brand_image' => $imageName,
        ]);

        return redirect()->route('brand.index')->with('success', 'Car Brand Added Successfully');
    }


    public function show($id){
        $brand = brand::find($id);
        return view('admin.brand.show', compact('brand'));
    }

    public function edit($id){
        $brand = brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id){
        $brand = brand::findOrFail($id);

        $validation = Validator::make($request->all(), [
            "title" => "required|string",
            "description" => "nullable|string",
            "brand_image" => "nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048",
        ]);

        // Slug will be untouch
        $slug = $brand->slug;

        // if user change the slug manually and send then (slug should be add in table)
        if ($request->filled('slug')) {
            $candidate = Str::slug($request->input('slug'));
            $exists = DB::table('brands')
                        ->where('slug', $candidate)
                        ->where('id', '!=', $brand->id)
                        ->exists();
            if ($exists) {
                $candidate = $candidate . '-' . $brand->id;
            }
            $slug = $candidate;
        }

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $brand = brand::findOrFail($id);
        $imageName = $brand->brand_image; // keep old image

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

        $brand->update([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'brand_image' => $imageName,
        ]);

        return redirect()->route('brand.index')->with('success', 'Car Brand Updated Successfully');
    }


    public function destroy($id)
    {
        $brand = brand::find($id);

        // check if record exists
        if (!$brand) {
            return redirect()->route('brand.index')->with('error', 'Car Brand not found.');
        }

        // delete image if exists
        if (!empty($brand->brand_image) && file_exists(public_path('images/models/' . $brand->brand_image))) {
            unlink(public_path('images/models/' . $brand->brand_image));
        }

        // delete record
        $brand->delete();

        return redirect()->route('brand.index')->with('success', 'Car Brand Deleted Successfully');
    }


    public function importBrandView(){
        return view('admin.exp_imp.import_brands');
    }

    public function exportExcel(){
        return Excel::download(new brandsExport, 'brands.xlsx');
    }

    public function importExcel(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new brandsImport, $request->file('file'));

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
        $brands = brand::whereIn('id', $ids)->get();

        foreach ($brands as $brand) {
            if (!empty($brand->brand_image)) {
                $imagePath = public_path('images/brands/' . $brand->brand_image);

                if (file_exists($imagePath)) {
                    @unlink($imagePath);
                }
            }
        }

        // Delete from database
        brand::whereIn('id', $ids)->delete();

        return redirect()->route('brand.index')
            ->with('success', 'Selected Car Brands Deleted Successfully!');
    }

    // seach functionality
    public function brandSearch(Request $request){
        $q = trim($request->input('q', ''));

        if($q === ''){
            return redirect()->back()->with('error', 'Write something in search box.');
        }

        $brands = brand::query()
        ->where('title', 'LIKE', "%{$q}%")
        ->latest()
        ->paginate(100)
        ->appends(['q' => $request->query('q')]);

        return view('admin.brand.search', compact('brands', 'q'));
    }
}
