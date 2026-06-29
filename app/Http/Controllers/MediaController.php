<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    // Show all feature images
    public function featureImagePage(Request $request)
    {
        $path = public_path('images/parts/feature');

        // folder ke andar jitni files hain get karo
        $files = File::files($path);

        // newest sabse upar lane ke liye reverse order
        usort($files, function ($a, $b) {
            return filemtime($b->getRealPath()) <=> filemtime($a->getRealPath());
        });

        // sirf file names nikal lo
        $images = [];
        foreach ($files as $file) {
            $images[] = 'images/parts/feature/' . $file->getFilename();
        }

        // array ko Laravel Collection mein convert karo
        $images = collect($images);

        // Pagination settings
        $perPage = 102; // per page 102 images
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        // Paginate manually
        $paginated = new LengthAwarePaginator(
            $images->slice($offset, $perPage)->values(),
            $images->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.media.feature', ['images' => $paginated]);
    }

    // Upload multiple feature images
    public function uploadFeatureImages(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "multi_images.*" => "required|image|mimes:jpg,jpeg,png,webp,gif,svg|max:2048",
        ]);

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }

        // Upload path
        $path = public_path('images/parts/feature');

        // Folder create if not exist
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }

        // Loop through and save images
        if ($request->hasFile('multi_images')) {
            foreach ($request->file('multi_images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($path, $filename);
            }
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    // Delete single feature image
    public function deleteSingle(Request $request)
    {

        $filename = $request->input('id');

        $filePath = public_path('images/parts/feature/' . $filename);

        if (File::exists($filePath)) {
            File::delete($filePath);
            return redirect()->route('featureImage.view')->with('success', 'Image deleted successfully.');
        } else {
            return redirect()->route('featureImage.view')->with('error', 'Image not found.');
        }
    }

    // Delete multi selected feature images
     public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return redirect()->route('featureImage.view')->with('error', 'Please select at least one image.');
        }

        foreach ($ids as $filename) {
            $filePath = public_path('images/parts/feature/' . $filename);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        return redirect()->route('featureImage.view')->with('success', 'Selected images deleted successfully.');
    }

    // Show all gallery images
    public function galleryImagePage(Request $request)
    {
        $path = public_path('images/parts/gallery');

        // folder ke andar jitni files hain get karo
        $files = File::files($path);

        // newest sabse upar lane ke liye reverse order
        usort($files, function ($a, $b) {
            return filemtime($b->getRealPath()) <=> filemtime($a->getRealPath());
        });

        // sirf file names nikal lo
        $images = [];
        foreach ($files as $file) {
            $images[] = 'images/parts/gallery/' . $file->getFilename();
        }

        // array ko Laravel Collection mein convert karo
        $images = collect($images);

        // Pagination settings
        $perPage = 102; // per page 102 images
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        // Paginate manually
        $paginated = new LengthAwarePaginator(
            $images->slice($offset, $perPage)->values(),
            $images->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.media.feature', ['images' => $paginated]);
    }

    // Upload multiple gallery images
    public function uploadGalleryImages(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "multi_images.*" => "required|image|mimes:jpg,jpeg,png,webp,gif,svg|max:2048",
        ]);

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }

        // Upload path
        $path = public_path('images/parts/gallery');

        // Folder create if not exist
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }

        // Loop through and save images
        if ($request->hasFile('multi_images')) {
            foreach ($request->file('multi_images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($path, $filename);
            }
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    // Delete single gallery image
    public function deleteSingleGallery(Request $request)
    {

        $filename = $request->input('id');

        $filePath = public_path('images/parts/gallery/' . $filename);

        if (File::exists($filePath)) {
            File::delete($filePath);
            return redirect()->route('galleryImage.view')->with('success', 'Image deleted successfully.');
        } else {
            return redirect()->route('galleryImage.view')->with('error', 'Image not found.');
        }
    }

    // Delete multi selected gallery images
     public function deleteSelectedGallery(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return redirect()->route('galleryImage.view')->with('error', 'Please select at least one image.');
        }

        foreach ($ids as $filename) {
            $filePath = public_path('images/parts/gallery/' . $filename);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        return redirect()->route('galleryImage.view')->with('success', 'Selected images deleted successfully.');
    }

    // Show all categories images
    public function categoryImagePage(Request $request)
    {
        $path = public_path('images/types');

        // folder ke andar jitni files hain get karo
        $files = File::files($path);

        // newest sabse upar lane ke liye reverse order
        usort($files, function ($a, $b) {
            return filemtime($b->getRealPath()) <=> filemtime($a->getRealPath());
        });

        // sirf file names nikal lo
        $images = [];
        foreach ($files as $file) {
            $images[] = 'images/types/' . $file->getFilename();
        }

        // array ko Laravel Collection mein convert karo
        $images = collect($images);

        // Pagination settings
        $perPage = 102; // per page 102 images
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        // Paginate manually
        $paginated = new LengthAwarePaginator(
            $images->slice($offset, $perPage)->values(),
            $images->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.media.category', ['images' => $paginated]);
    }

    // Upload multiple categories images
    public function uploadCategoryImages(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "multi_images.*" => "required|image|mimes:jpg,jpeg,png,webp,gif,svg|max:2048",
        ]);

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }

        // Upload path
        $path = public_path('images/types');

        // Folder create if not exist
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }

        // Loop through and save images
        if ($request->hasFile('multi_images')) {
            foreach ($request->file('multi_images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($path, $filename);
            }
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    // Delete single category image
    public function deleteSingleCategory(Request $request)
    {

        $filename = $request->input('id');

        $filePath = public_path('images/types/' . $filename);

        if (File::exists($filePath)) {
            File::delete($filePath);
            return redirect()->route('categoryImage.view')->with('success', 'Category image deleted successfully.');
        } else {
            return redirect()->route('categoryImage.view')->with('error', 'Category image not found.');
        }
    }

    // Delete multi selected categories images
     public function deleteSelectedCategory(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return redirect()->route('categoryImage.view')->with('error', 'Please select at least one image.');
        }

        foreach ($ids as $filename) {
            $filePath = public_path('images/types/' . $filename);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        return redirect()->route('categoryImage.view')->with('success', 'Selected category images deleted successfully.');
    }

    // Show all brand images
    public function brandImagePage(Request $request)
    {
        $path = public_path('images/brands');

        // folder ke andar jitni files hain get karo
        $files = File::files($path);

        // newest sabse upar lane ke liye reverse order
        usort($files, function ($a, $b) {
            return filemtime($b->getRealPath()) <=> filemtime($a->getRealPath());
        });

        // sirf file names nikal lo
        $images = [];
        foreach ($files as $file) {
            $images[] = 'images/brands/' . $file->getFilename();
        }

        // array ko Laravel Collection mein convert karo
        $images = collect($images);

        // Pagination settings
        $perPage = 102; // per page 102 images
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        // Paginate manually
        $paginated = new LengthAwarePaginator(
            $images->slice($offset, $perPage)->values(),
            $images->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.media.brand', ['images' => $paginated]);
    }

    // Upload multiple brand images
    public function uploadBrandImages(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "multi_images.*" => "required|image|mimes:jpg,jpeg,png,webp,gif,svg|max:2048",
        ]);

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }

        // Upload path
        $path = public_path('images/brands');

        // Folder create if not exist
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }

        // Loop through and save images
        if ($request->hasFile('multi_images')) {
            foreach ($request->file('multi_images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($path, $filename);
            }
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    // Delete single brand image
    public function deleteSingleBrand(Request $request)
    {

        $filename = $request->input('id');

        $filePath = public_path('images/brands/' . $filename);

        if (File::exists($filePath)) {
            File::delete($filePath);
            return redirect()->route('brandImage.view')->with('success', 'Image deleted successfully.');
        } else {
            return redirect()->route('brandImage.view')->with('error', 'Image not found.');
        }
    }

    // Delete multi selected brand images
     public function deleteSelectedBrand(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return redirect()->route('categoryImage.view')->with('error', 'Please select at least one image.');
        }

        foreach ($ids as $filename) {
            $filePath = public_path('images/brands/' . $filename);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        return redirect()->route('brandImage.view')->with('success', 'Selected images deleted successfully.');
    }

    // Show all model images
    public function modelImagePage(Request $request)
    {
        $path = public_path('images/models');

        // folder ke andar jitni files hain get karo
        $files = File::files($path);

        // newest sabse upar lane ke liye reverse order
        usort($files, function ($a, $b) {
            return filemtime($b->getRealPath()) <=> filemtime($a->getRealPath());
        });

        // sirf file names nikal lo
        $images = [];
        foreach ($files as $file) {
            $images[] = 'images/models/' . $file->getFilename();
        }

        // array ko Laravel Collection mein convert karo
        $images = collect($images);

        // Pagination settings
        $perPage = 102; // per page 102 images
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        // Paginate manually
        $paginated = new LengthAwarePaginator(
            $images->slice($offset, $perPage)->values(),
            $images->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.media.model', ['images' => $paginated]);
    }

    // Upload multiple model images
    public function uploadModelImages(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "multi_images.*" => "required|image|mimes:jpg,jpeg,png,webp,gif,svg|max:2048",
        ]);

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }

        // Upload path
        $path = public_path('images/models');

        // Folder create if not exist
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }

        // Loop through and save images
        if ($request->hasFile('multi_images')) {
            foreach ($request->file('multi_images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($path, $filename);
            }
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    // Delete single model image
    public function deleteSingleModel(Request $request)
    {

        $filename = $request->input('id');

        $filePath = public_path('images/models/' . $filename);

        if (File::exists($filePath)) {
            File::delete($filePath);
            return redirect()->route('modelImage.view')->with('success', 'Image deleted successfully.');
        } else {
            return redirect()->route('modelImage.view')->with('error', 'Image not found.');
        }
    }

    // Delete multi selected model images
     public function deleteSelectedModel(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return redirect()->route('modelImage.view')->with('error', 'Please select at least one image.');
        }

        foreach ($ids as $filename) {
            $filePath = public_path('images/models/' . $filename);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        return redirect()->route('modelImage.view')->with('success', 'Selected images deleted successfully.');
    }

    // Show all user images
    public function userImagePage(Request $request)
    {
        $path = public_path('images/users');

        // folder ke andar jitni files hain get karo
        $files = File::files($path);

        // newest sabse upar lane ke liye reverse order
        usort($files, function ($a, $b) {
            return filemtime($b->getRealPath()) <=> filemtime($a->getRealPath());
        });

        // sirf file names nikal lo
        $images = [];
        foreach ($files as $file) {
            $images[] = 'images/users/' . $file->getFilename();
        }

        // array ko Laravel Collection mein convert karo
        $images = collect($images);

        // Pagination settings
        $perPage = 102; // per page 102 images
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        // Paginate manually
        $paginated = new LengthAwarePaginator(
            $images->slice($offset, $perPage)->values(),
            $images->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.media.user', ['images' => $paginated]);
    }

     // Upload multiple model images
    public function uploadUserImages(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "multi_images.*" => "required|image|mimes:jpg,jpeg,png,webp,gif,svg|max:2048",
        ]);

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }

        // Upload path
        $path = public_path('images/users');

        // Folder create if not exist
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }

        // Loop through and save images
        if ($request->hasFile('multi_images')) {
            foreach ($request->file('multi_images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($path, $filename);
            }
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    // Delete single user image
    public function deleteSingleUser(Request $request)
    {

        $filename = $request->input('id');

        $filePath = public_path('images/users/' . $filename);

        if (File::exists($filePath)) {
            File::delete($filePath);
            return redirect()->route('userImage.view')->with('success', 'Image deleted successfully.');
        } else {
            return redirect()->route('userImage.view')->with('error', 'Image not found.');
        }
    }

    // Delete multi selected user images
     public function deleteSelectedUser(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return redirect()->route('userImage.view')->with('error', 'Please select at least one image.');
        }

        foreach ($ids as $filename) {
            $filePath = public_path('images/users/' . $filename);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        return redirect()->route('userImage.view')->with('success', 'Selected images deleted successfully.');
    }

    // Model search functionality
     public function searchModelImages(Request $request)
    {
        $search = trim($request->input('search'));
        $path = public_path('images/models');
        $files = File::files($path);

        $matched = [];

        foreach ($files as $file) {
            $fileName = $file->getFilename();
            if (stripos($fileName, $search) !== false) {
                $matched[] = 'images/models/' . $fileName;
            }
        }

        // pagination for search results
        $images = collect($matched);
        $perPage = 102;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        $paginated = new LengthAwarePaginator(
            $images->slice($offset, $perPage)->values(),
            $images->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.media.model', [
            'images' => $paginated,
            'search' => $search
        ]);
    }
}
