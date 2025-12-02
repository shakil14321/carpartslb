<?php

namespace App\Http\Controllers;

use App\Models\CarPartType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\CarPartTypesExport;
use App\Imports\CarPartTypesImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class CarPartTypeController extends Controller
{
    public function index(){
        $types = CarPartType::latest()->paginate(100);
        return view('admin.type.index', compact('types'));
    }

    public function create(){
        return view('admin.type.create');
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'part_type_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);

        $slug = CarPartType::generateSlug($request->title);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $imageName = null;
        if ($request->hasFile('part_type_image')) {
            $image = $request->file('part_type_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/types'), $imageName);
        }

        CarPartType::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'part_type_image' => $imageName,
        ]);

        return redirect()->route('type.index')->with('success', 'Product Category Added Successfully');
    }

    public function show($id){
        $type = CarPartType::find($id);
        return view('admin.type.show', compact('type'));
    }

    public function edit($id){
        $type = CarPartType::find($id);
        return view('admin.type.edit', compact('type'));
    }

    public function update(Request $request, $id){
        $carPartType = CarPartType::findOrFail($id);

        $validation = Validator::make($request->all(), [
            "title" => "required|string",
            'description' => 'nullable|string',
            'part_type_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);

         // Slug will be untouch
        $slug = $carPartType->slug;

        // if user change the slug manually and send then (slug should be add in table)
        if ($request->filled('slug')) {
            $candidate = Str::slug($request->input('slug'));
            $exists = DB::table('car_part_types')
                        ->where('slug', $candidate)
                        ->where('id', '!=', $carPartType->id)
                        ->exists();
            if ($exists) {
                $candidate = $candidate . '-' . $carPartType->id;
            }
            $slug = $candidate;
        }

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $carPartType = CarPartType::findOrFail($id);

        // Image handling
        $imageName = $carPartType->part_type_image; // Default purani image
        if ($request->hasFile('part_type_image')) {
            // Purani image delete karo agar exist karti hai
            if ($imageName && file_exists(public_path('images/types/' . $imageName))) {
                unlink(public_path('images/types/' . $imageName));
            }

            $image = $request->file('part_type_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/types'), $imageName);
        }

        $carPartType->update([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'part_type_image' => $imageName,
        ]);

        return redirect()->route('type.index')->with('success', 'Product Category Updated Successfully');
    }

    public function destroy($id){
        $carPartType = CarPartType::findOrFail($id);

        // Agar image hai toh delete karo
        if ($carPartType->part_type_image && file_exists(public_path('images/types/' . $carPartType->part_type_image))) {
            unlink(public_path('images/types/' . $carPartType->part_type_image));
        }

        // Record delete karo
        $carPartType->delete();

        return redirect()->route('type.index')->with('success', 'Product Category Deleted Successfully');
    }

    public function imporViewPartType(){
        return view('admin.exp_imp.import_part_types');
    }

    // EXPORT
    public function exportExcel(){
        return Excel::download(new CarPartTypesExport, 'car_part_types.xlsx');
    }

    // IMPORT
    public function importExcel(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new CarPartTypesImport, $request->file('file'));
            return redirect()->route('type.index')->with('success', 'Data imported successfully!');
        } catch (\Exception $e) {
            return redirect()->route('type.index')->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return redirect()->route('type.index')
                ->with('error', 'Please select at least one brand to delete.');
        }

        // Get brands
        $types = CarPartType::whereIn('id', $ids)->get();

        foreach ($types as $type) {
            if (!empty($brand->part_type_image)) {
                $imagePath = public_path('images/types/' . $type->part_type_image);

                if (file_exists($imagePath)) {
                    @unlink($imagePath);
                }
            }
        }

        // Delete from database
        CarPartType::whereIn('id', $ids)->delete();

        return redirect()->route('type.index')
            ->with('success', 'Selected Car Categories Deleted Successfully!');
    }

    public function productTypeSearchAdmin(Request $request){
        $q = trim($request->input('q', ''));

        if($q === ''){
            return redirect()->back()->with('error', 'Write something in search box.');
        }

         $types = CarPartType::query()
         ->where('title', 'LIKE', "%{$q}%")
         ->latest()
         ->paginate(100)
         ->appends(['q', $request->query('q')]);

         return view('admin.type.search', compact('types', 'q'));
    }
}