<?php
namespace App\Http\Controllers;

use App\Models\brand;
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
        $brands = brand::latest()->get();

        return view('admin.siteSetting.brand', compact('setting', 'brands'));
    }

    public function homeText(){
        $setting = SiteSetting::first();
        return view('admin.siteSetting.homeText', compact('setting'));
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
        'slider1_subtitle' => 'nullable|string',
        'slider1_maintitle' => 'nullable|string',
        'slider1_desc' => 'nullable|string',
        'slider2_subtitle' => 'nullable|string',
        'slider2_maintitle' => 'nullable|string',
        'slider2_desc' => 'nullable|string',
        'slider3_subtitle' => 'nullable|string',
        'slider3_maintitle' => 'nullable|string',
        'slider3_desc' => 'nullable|string',
        'brand_quantity' => 'nullable|integer',
        'google_verification' => 'nullable|string',
        'shipping_text' => 'nullable|string',
        'price_guarantee_text' => 'nullable|string',
        'footer_about_text' => 'nullable|string',
        'footer_facebook_link' => 'nullable|url',
        'footer_instagram_link' => 'nullable|url',
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
    if($request->slider1_subtitle){
        $setting->slider1_subtitle = $request->slider1_subtitle;
    }
    if($request->slider1_maintitle){
        $setting->slider1_maintitle = $request->slider1_maintitle;
    }

    if($request->slider1_desc){
        $setting->slider1_desc = $request->slider1_desc;
    }
    if($request->slider2_subtitle){
        $setting->slider2_subtitle = $request->slider2_subtitle;
    }
    if($request->slider2_maintitle){
        $setting->slider2_maintitle = $request->slider2_maintitle;
    }
    if($request->slider2_desc){
        $setting->slider2_desc = $request->slider2_desc;
    }
    if($request->slider3_subtitle){
        $setting->slider3_subtitle = $request->slider3_subtitle;
    }
    if($request->slider3_maintitle){
        $setting->slider3_maintitle = $request->slider3_maintitle;
    }
    if($request->slider3_desc){
        $setting->slider3_desc = $request->slider3_desc;
    }
    if($request->notice_bar){
        $setting->notice_bar = $request->notice_bar;
    }
    if($request->brand_quantity){
        $setting->brand_quantity = $request->brand_quantity;
    }
    if($request->google_verification){
        $setting->google_verification = $request->google_verification;
    }
    if($request->shipping_text){
        $setting->shipping_text = $request->shipping_text;
    }
    if($request->price_guarantee_text){
        $setting->price_guarantee_text = $request->price_guarantee_text;
    }
    if($request->footer_about_text){
        $setting->footer_about_text = $request->footer_about_text;
    }
    if($request->footer_facebook_link){
        $setting->footer_facebook_link = $request->footer_facebook_link;
    }
    if($request->footer_instagram_link){
        $setting->footer_instagram_link = $request->footer_instagram_link;
    }




    // Sirf tab update karo jab menu_items empty na ho
    if (!empty($menu_items)) {
        $setting->menu_items = $menu_items;
    }

    // Save all changes
    $setting->save();

    return redirect()->back()->with('success', 'Settings updated successfully!');
}

}
