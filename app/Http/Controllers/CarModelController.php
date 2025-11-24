<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\CarModelsExport;
use App\Imports\CarModelsImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class CarModelController extends Controller
{
    public function index(){
        $carModels = CarModel::latest()->paginate(10);
        return view('admin.model.index', compact('carModels'));
    }

    public function create(){
        $carBrands = CarBrand::all();
        return view('admin.model.create', compact('carBrands'));
    }

    public function show($id){
        $carModel = CarModel::find($id);
        return view('admin.model.show', compact('carModel'));
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            "car_brand_id" => "nullable|integer|exists:car_brands,id",
            "title" => "required|string",
            "year" => "nullable|integer",
            "description" => "nullable|string",
            "model_image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048",
        ]);

        $slug = CarModel::generateSlug($request->title);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $imageName = null;
        if ($request->hasFile('model_image')) {
            $image = $request->file('model_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/models'), $imageName);
        }

        CarModel::create([
            'car_brand_id' => $request->car_brand_id,
            'title' => $request->title,
            'slug' => $slug,
            'year' => $request->year,
            'description' => $request->description,
            'model_image' => $imageName,
        ]);

        return redirect()->route('model.index')->with('success', 'Model created successfully');
    }

    public function edit($id){
        $carModel = CarModel::find($id);
        $carBrands = CarBrand::all();
        return view('admin.model.edit', compact('carModel', 'carBrands'));
    }

    public function update(Request $request, $id){
        $carModel = CarModel::findOrFail($id);

        $validation = Validator::make($request->all(), [
            "car_brand_id" => "nullable|integer|exists:car_brands,id",
            "title" => "required|string",
            "year" => "nullable|integer",
            "description" => "nullable|string",
            "model_image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048",
        ]);

        // Slug will be untouch
        $slug = $carModel->slug;

        // if user change the slug manually and send then (slug should be add in table)
        if ($request->filled('slug')) {
            $candidate = Str::slug($request->input('slug'));
            $exists = DB::table('car_models')
                        ->where('slug', $candidate)
                        ->where('id', '!=', $carModel->id)
                        ->exists();
            if ($exists) {
                $candidate = $candidate . '-' . $carModel->id;
            }
            $slug = $candidate;
        }

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $carModel = CarModel::findOrFail($id);
        $imageName = $carModel->model_image; // default: keep old image

        if ($request->hasFile('model_image')) {
            // delete old image if exists
            if ($imageName && file_exists(public_path('images/models/' . $imageName))) {
                @unlink(public_path('images/models/' . $imageName)); // @ = suppress errors if file missing
            }

            // upload new image
            $image = $request->file('model_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/models'), $imageName);
        }

        $carModel->update([
            'car_brand_id' => $request->car_brand_id,
            'title' => $request->title,
            'slug' => $slug,
            'year' => $request->year,
            'description' => $request->description,
            'model_image' => $imageName,
        ]);

        return redirect()->route('model.index')->with('success', 'Model updated successfully');
    }

    public function destroy($id){
            $carModel = CarModel::findOrFail($id);

            // delete image if exists
            if ($carModel->model_image && file_exists(public_path('images/models/' . $carModel->model_image))) {
                unlink(public_path('images/models/' . $carModel->model_image));
            }

            $carModel->delete();

            return redirect()->route('model.index')->with('success', 'Model deleted successfully');
    }

    public function imporViewModel(){
        return view('admin.exp_imp.import_models');
    }

    public function exportExcel(){
        return Excel::download(new CarModelsExport, 'car_models.xlsx');
    }

    public function importExcel(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new CarModelsImport, $request->file('file'));

        return redirect()->route('model.index')->with('success', 'Car Models imported successfully');
    }
    
    public function deleteSelected(Request $request){
        $ids = $request->input('ids');
        
        if(empty($ids)){
            return redirect()->route('model.index')->with('errors', 'Record not found.');
        }
        
        // Get Models
        $carModels = CarModel::whereIn('id', $ids)->get();
        
        foreach ($carModels as $model) {
        if (!empty($model->model_image)) {
            $imagePath = public_path('images/models/' . $model->model_image);

            if (file_exists($imagePath)) {
                @unlink($imagePath);
            }
        }
    }

    // Delete from database
    CarModel::whereIn('id', $ids)->delete();

    return redirect()->route('model.index')
        ->with('success', 'Selected Car Models Deleted Successfully!');
    }
    
    public function modelSearch(Request $request){
        $q = trim($request->input);
        
        if($q === ''){
            return redirect()->back()->with('error', 'Write something in search box.');
        }
        
        $carModels = CarModel::query()
        ->where('title', 'LIKE', "%{$q}%")
        ->latest()
        ->paginate(100)
        ->appends(['q' => $request->query('q')]);
        
        return view('admin.model.search', compact('carModels', 'q'));
    }
}
