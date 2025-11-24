<?php
namespace App\Http\Controllers;

use App\Models\CarBrand;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiteSettingController extends Controller
{
    // Show setting page
    public function index()
    {
        $setting = SiteSetting::first();
        return view('admin.siteSetting.logo', compact('setting'));
    }
    
    public function homeSlider(){
        $setting = SiteSetting::first();
        return view('admin.siteSetting.homeSlider', compact('setting'));
    }
    
    public function announcement(){
        $setting = SiteSetting::first();
        return view('admin.siteSetting.announcement', compact('setting'));
    }
    
    public function menu(){
        $setting = SiteSetting::first();
        return view('admin.siteSetting.menu', compact('setting'));
    }
    
    public function brand(){
        $setting = SiteSetting::first();
        $carBrands = CarBrand::latest()->get();
        
        return view('admin.siteSetting.brand', compact('setting', 'carBrands'));
    }
    
    public function siteVerification(){
         $setting = SiteSetting::first();
        return view('admin.siteSetting.site_verification', compact('setting'));
    }

    // Store or update settings
    // Store or update settings
public function store(Request $request)
{
    $validated = $request->validate([
        'notice_bar' => 'nullable|string',
        'menu_name.*' => 'nullable|string',
        'menu_link.*' => 'nullable|string',
        'site_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'carousel_image_one' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'carousel_image_two' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'carousel_image_three' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'brand_quantity' => 'nullable|integer',
        'google_verification' => 'nullable|string',
    ]);

    $setting = SiteSetting::first() ?? new SiteSetting();

    // ===== Logo Upload =====
    if ($request->hasFile('site_logo')) {
        if ($setting->site_logo && File::exists(public_path('images/logos/' . $setting->site_logo))) {
            File::delete(public_path('images/logos/' . $setting->site_logo));
        }
        $file = $request->file('site_logo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/logos/'), $filename);
        $setting->site_logo = $filename;
    }

    // ===== Carousel 1 Upload =====
    if ($request->hasFile('carousel_image_one')) {
        if ($setting->carousel_image_one && File::exists(public_path('images/banners/' . $setting->carousel_image_one))) {
            File::delete(public_path('images/banners/' . $setting->carousel_image_one));
        }
        $file = $request->file('carousel_image_one');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/banners/'), $filename);
        $setting->carousel_image_one = $filename;
    }

    // ===== Carousel 2 Upload =====
    if ($request->hasFile('carousel_image_two')) {
        if ($setting->carousel_image_two && File::exists(public_path('images/banners/' . $setting->carousel_image_two))) {
            File::delete(public_path('images/banners/' . $setting->carousel_image_two));
        }
        $file = $request->file('carousel_image_two');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/banners/'), $filename);
        $setting->carousel_image_two = $filename;
    }

    // ===== Carousel 3 Upload =====
    if ($request->hasFile('carousel_image_three')) {
        if ($setting->carousel_image_three && File::exists(public_path('images/banners/' . $setting->carousel_image_three))) {
            File::delete(public_path('images/banners/' . $setting->carousel_image_three));
        }
        $file = $request->file('carousel_image_three');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/banners/'), $filename);
        $setting->carousel_image_three = $filename;
    }

    // ===== Menu Items =====
    $menu_items = [];
    if ($request->menu_name && $request->menu_link) {
        foreach ($request->menu_name as $key => $name) {
            if (!empty($name) && !empty($request->menu_link[$key])) {
                $menu_items[] = [
                    'name' => $name,
                    'link' => $request->menu_link[$key],
                ];
            }
        }
    }

    // ===== Assign other settings =====
    $setting->notice_bar = $request->notice_bar;
    $setting->brand_quantity = $request->brand_quantity;
    $setting->google_verification = $request->google_verification;

    // Sirf tab update karo jab menu_items empty na ho
    if (!empty($menu_items)) {
        $setting->menu_items = $menu_items;
    }

    // Save all changes
    $setting->save();

    return redirect()->back()->with('success', 'Settings updated successfully!');
}

}
