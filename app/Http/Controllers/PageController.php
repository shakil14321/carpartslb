<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Brand;
use App\Models\SubCategories;
use App\Models\SiteSetting;
use App\Models\CarPartType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class PageController extends Controller
{
    // Home page functionality
    public function index(){
        $title = 'Auto Parts Accessories';
        $meta_des = 'At CarPartsLB, we specialize in providing genuine and high-quality spare parts for BMW, MINI, and BMW Motorrad. As trusted auto parts resellers in Lebanon, we focus on reliability, affordability, and performance to keep your vehicle running at its best.';
        $carParts = product::where('fav_product', 1)
            ->latest()
            ->take(12)
            ->get();

        if ($carParts->count() < 12) {
            $extraParts = product::whereNotIn('id', $carParts->pluck('id'))
                ->latest()
                ->take(12 - $carParts->count())
                ->get();

            $carParts = $carParts->merge($extraParts);
        }
        $latestParts = product::latest()->get();

        $setting = SiteSetting::first();
        $brandQuantity = $setting ? $setting->brand_quantity : 0;

        $carPartTypes = CarPartType::withCount('carPart')->get();
        $Brands = Brand::take($brandQuantity)->get();
        $subCategories = SubCategories::latest()->paginate(100);

        $partType10 =  CarPartType::withCount('carPart')->skip(0)->take(10)->get();
        $partType20 =  CarPartType::withCount('carPart')->skip(11)->take(10)->get();
        $partType30 =  CarPartType::withCount('carPart')->skip(21)->take(10)->get();
        $partType40 =  CarPartType::withCount('carPart')->skip(31)->take(10)->get();
        $partType50 =  CarPartType::withCount('carPart')->skip(41)->take(10)->get();
        $partType60 =  CarPartType::withCount('carPart')->skip(51)->take(10)->get();
        $partType70 =  CarPartType::withCount('carPart')->skip(61)->take(9)->get();
        $partType80 =  CarPartType::withCount('carPart')->skip(70)->take(10)->get();

        return view('front.pages.home', compact('carParts', 'latestParts', 'carPartTypes', 'Brands', 'subCategories', 'partType10', 'partType20', 'partType30', 'partType40', 'partType50', 'partType60', 'partType70', 'partType80', 'title', 'meta_des', 'setting'));
    }

    // About us page
    public function aboutPage(){
        return view('front.pages.about');
    }

    // Contact us page.
    public function contactPage(){
        $setting = SiteSetting::first();
        return view('front.pages.contact', compact('setting'));
    }

    // terms and condtitions page
    public function termsConditions(){
        return view('front.pages.terms-conditions');
    }

    // Car part type page means category
    public function partType(){
        $partTypes = CarPartType::latest()->paginate(100);

        return view('front.pages.types', compact('partTypes'));
    }

    // All Sub Categoriess page
    public function partBrand(){
        $partBrands = SubCategories::latest()->paginate(100);

        return view('front.pages.part-brands', compact('partBrands'));
    }

    // All car brands page
    public function brands(){
        $brands = Brand::latest()->paginate(100);

        return view('front.pages.brands', compact('brands'));
    }

    // It is shop page.
    public function shop(Request $request){
        $carPartTypes = CarPartType::withCount('carPart')->get();
        $carPartsFav = products::latest()->where('fav_product', 1)->get();

        $query = products::query();

        $rawMinPrice = products::min('sale_price') ?? 0;
        $rawMaxPrice = products::max('sale_price');

        $globalMinPrice = floor($rawMinPrice); // round down
        $globalMaxPrice = ceil($rawMaxPrice);  // round up

        // --- Price Filter ---
        $minPrice = $request->input('min_price', $globalMinPrice);
        $maxPrice = $request->input('max_price', $globalMaxPrice);

        if ($minPrice) {
            $query->where('sale_price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $query->where('sale_price', '<=', $maxPrice);
        }

        // --- Sorting ---
        $sort = (int) $request->query('sort', 1);
        if ($sort === 2) {
            $query->orderBy('sale_price', 'asc');
        } elseif ($sort === 3) {
            $query->orderBy('sale_price', 'desc');
        } elseif ($sort === 4) {
            $query->orderBy('rating', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // --- Pagination ---
        $carParts = $query->paginate(90)->appends($request->only(['sort', 'min_price', 'max_price']));
        $carParts->load(['brand', 'carModel', 'carPartType']);

        // --- AJAX support ---
        if ($request->ajax()) {
            return view('front.partials.products_list', compact('carParts'))->render();
        }

        return view('front.pages.shop', compact('carParts', 'carPartTypes', 'carPartsFav', 'globalMinPrice', 'globalMaxPrice', 'minPrice', 'maxPrice'));
    }

    // Product show by categories. It is carPart archive page.
    public function shopType(Request $request, $slug) {
        $carPartTypes = CarPartType::withCount('carPart')->get();
        $carPartsFav = product::where('fav_product', 10)->get();

        $partType = CarPartType::where('slug', $slug)->firstOrFail();

        $query = product::where('part_type_id', $partType->id);

        $rawMinPrice = product::min('sale_price') ?? 0;
        $rawMaxPrice = product::max('sale_price');

        $globalMinPrice = floor($rawMinPrice); // round down
        $globalMaxPrice = ceil($rawMaxPrice);  // round up

        // --- Price Filter ---
        $minPrice = $request->input('min_price', $globalMinPrice);
        $maxPrice = $request->input('max_price', $globalMaxPrice);


        // Price filter logic
         if ($minPrice) {
            $query->where('sale_price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $query->where('sale_price', '<=', $maxPrice);
        }
        // if ($request->filled('min_price')) {
        //     $query->where('sale_price', '>=', $request->min_price);
        // }
        // if ($request->filled('max_price')) {
        //     $query->where('sale_price', '<=', $request->max_price);
        // }

        // Sorting
        $sort = $request->query('sort', '1');
        if ($sort === '2') {
            $query->orderBy('sale_price', 'asc');
        } elseif ($sort === '3') {
            $query->orderBy('sale_price', 'desc');
        } elseif ($sort === '4') {
            $query->orderBy('rating', 'desc');
        } else {
            $query->latest();
        }

        $carParts = $query->paginate(12)->appends($request->all());

        if ($request->ajax()) {
            return view('front.partials.products_list', compact('carParts'))->render();
        }

        return view('front.pages.type', compact('partType', 'carParts', 'carPartTypes', 'carPartsFav', 'globalMinPrice', 'globalMaxPrice', 'minPrice', 'maxPrice'));
    }

    // Product show by car brand. It is brand archive page.
//    public function brandBy(Request $request, $slug) {
//        $carPartTypes = CarPartType::withCount('carPart')->get();
//        $carPartsFav = products::where('fav_product', 10)->get();
//
//        $brand = Brand::where('slug', $slug)->firstOrFail();
//
//        $query = products::where('car_brand_id', $brand->id);
//
//        // Price filter logic
//        if ($request->filled('min_price')) {
//            $query->where('sale_price', '>=', $request->min_price);
//        }
//        if ($request->filled('max_price')) {
//            $query->where('sale_price', '<=', $request->max_price);
//        }
//
//        // Sorting
//        $sort = $request->query('sort', '1');
//        if ($sort === '2') {
//            $query->orderBy('sale_price', 'asc');
//        } elseif ($sort === '3') {
//            $query->orderBy('sale_price', 'desc');
//        } elseif ($sort === '4') {
//            $query->orderBy('rating', 'desc');
//        } else {
//            $query->latest();
//        }
//
//        $carParts = $query->paginate(12)->appends($request->all());
//
//        if ($request->ajax()) {
//            return view('front.partials.products_list', compact('carParts'))->render();
//        }
//
//        return view('front.pages.brand', compact('brand', 'carParts', 'carPartTypes', 'carPartsFav'));
//    }


    public function brandBy(Request $request, $slug) {
        $carPartTypes = CarPartType::withCount('carPart')->get();
        $carPartsFav = product::where('fav_product', 10)->get();

        $brand = Brand::where('slug', $slug)->firstOrFail();

        $query = product::where('car_brand_id', $brand->id);

        if ($request->filled('min_price')) {
            $query->where('sale_price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('sale_price', '<=', $request->max_price);
        }

        $sort = $request->query('sort', '1');

        if ($sort === '2') {
            $query->orderBy('sale_price', 'asc');
        } elseif ($sort === '3') {
            $query->orderBy('sale_price', 'desc');
        } elseif ($sort === '4') {
            $query->orderBy('rating', 'desc');
        } else {
            $query->latest();
        }

        $carParts = $query->paginate(12)->appends($request->all());

        if ($request->ajax()) {
            return view('front.partials.products_list', compact('carParts'))->render();
        }

        return view('front.pages.brand', compact('brand', 'carParts', 'carPartTypes', 'carPartsFav'));
    }

    // Product show by Sub Categoriess
    public function partBrandBy(Request $request, $slug) {
        $carPartTypes = CarPartType::withCount('carPart')->get();
        $carPartsFav = product::where('fav_product', 10)->get();

        $setting = SiteSetting::first();

        $partBrand = SubCategories::where('slug', $slug)->firstOrFail();
        $title = $partBrand->title;
        $meta_des = "Buy genuine {$partBrand->title} parts at CarPartsLB. High-quality, affordable, and reliable original spare parts for perfect performance.";



        $query = product::where('part_brand_id', $partBrand->id);

        $rawMinPrice = product::min('sale_price') ?? 0;
        $rawMaxPrice = product::max('sale_price');

        $globalMinPrice = floor($rawMinPrice); // round down
        $globalMaxPrice = ceil($rawMaxPrice);  // round up

        // --- Price Filter ---
        $minPrice = $request->input('min_price', $globalMinPrice);
        $maxPrice = $request->input('max_price', $globalMaxPrice);

        // Price filter logic
        if ($minPrice) {
            $query->where('sale_price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $query->where('sale_price', '<=', $maxPrice);
        }
        // if ($request->filled('min_price')) {
        //     $query->where('sale_price', '>=', $request->min_price);
        // }
        // if ($request->filled('max_price')) {
        //     $query->where('sale_price', '<=', $request->max_price);
        // }

        // Sorting
        $sort = $request->query('sort', '1');
        if ($sort === '2') {
            $query->orderBy('sale_price', 'asc');
        } elseif ($sort === '3') {
            $query->orderBy('sale_price', 'desc');
        } elseif ($sort === '4') {
            $query->orderBy('rating', 'desc');
        } else {
            $query->latest();
        }

        $carParts = $query->paginate(12)->appends($request->all());

        if ($request->ajax()) {
            return view('front.partials.products_list', compact('carParts'))->render();
        }

        return view('front.pages.part-brand', compact('setting','partBrand', 'carParts', 'carPartTypes', 'carPartsFav', 'title', 'meta_des', 'globalMinPrice', 'globalMaxPrice', 'minPrice', 'maxPrice'));
    }

    //It is refund policy page.
    public function refundPolicyPage(){
        return view('front.pages.refund_policy');
    }

    //It is privacy policy page.
    public function privacyPolicyPage(){
        return view('front.pages.privacy_policy');
    }

    // It is faq's page.
    public function faqPage(){
        return view('front.pages.faq');
    }

    // Search results Blade page
    public function searchPage(Request $request) {
        $carPartTypes = CarPartType::withCount('carPart')->get();
        $carPartsFav = product::where('fav_product', 10)->get();

        $query = product::query();

        // --- Search filter ---
        $search = $request->input('query');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('part_number', 'like', "%{$search}%")
                ->orWhere('vin_code', 'like', "%{$search}%")
                ->orWhereHas('carPartType', function($sub) use ($search) {
                    $sub->where('title', 'like', "%{$search}%");
                })
                ->orWhereHas('brand', function($sub) use ($search) {
                    $sub->where('title', 'like', "%{$search}%");
                });
            });
        }

        $rawMinPrice = $query->min('sale_price') ?? 0;
        $rawMaxPrice = $query->max('sale_price') ?? 0;

        $globalMinPrice = floor($rawMinPrice); // round down
        $globalMaxPrice = ceil($rawMaxPrice);  // round up
        // dd($globalMinPrice,$globalMaxPrice);

        // --- Price Filter ---
        $minPrice = $request->input('min_price', $globalMinPrice);
        $maxPrice = $request->input('max_price', $globalMaxPrice);

        // --- Price Filter ---
        // $minPrice = $request->input('min_price');
        // $maxPrice = $request->input('max_price');

        if ($minPrice) {
            $query->where('sale_price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $query->where('sale_price', '<=', $maxPrice);
        }

        // --- Sorting ---
        $sort = (int) $request->query('sort', 1);
        if ($sort === 2) {
            $query->orderBy('sale_price', 'asc');
        } elseif ($sort === 3) {
            $query->orderBy('sale_price', 'desc');
        } elseif ($sort === 4) {
            $query->orderBy('rating', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // --- Pagination ---
        $carParts = $query->paginate(12)->appends(
            $request->only(['query','sort','min_price','max_price'])
        );
        $carParts->load(['brand', 'carModel', 'carPartType']);

        // --- AJAX support ---
        if ($request->ajax()) {
            return view('front.partials.products_list', compact('carParts'))->render();
        }

        return view('front.pages.search', compact('carParts', 'carPartTypes', 'carPartsFav', 'search', 'globalMinPrice', 'globalMaxPrice', 'minPrice', 'maxPrice'));
    }

     // JSON search API
     public function search(Request $request){
         $query = $request->input('query');
         if(!$query) {
             return response()->json([]);
         }

         $results = product::query()
             ->where('title', 'like', "%{$query}%")
             ->orWhere('part_number', 'like', "%{$query}%")
             ->orWhere('vin_code', 'like', "%{$query}%")
             ->orWhereHas('carPartType', function($q) use ($query) {
                 $q->where('title', 'like', "%{$query}%");
             })
             ->orWhereHas('brand', function($q) use ($query) {
                 $q->where('title', 'like', "%{$query}%");
             })
             ->with(['brand', 'carPartType'])
             ->paginate(5);

         // Highlight matches
         $results->getCollection()->transform(function($item) use ($query) {
             $highlight = fn($text) => preg_replace("/($query)/i", '<mark>$1</mark>', $text);
             $item->title = $highlight($item->title);
             $item->part_number = $highlight($item->part_number);
             $item->vin_code = $highlight($item->vin_code);
             $item->car_brand_name = $item->brand ? $highlight($item->brand->title) : '-';
             $item->car_part_type_name = $item->carPartType ? $highlight($item->carPartType->title) : '-';
             return $item;
         });

         return response()->json($results);
     }

     // Cache page in admin dashboard
    public function cache(){
         return view('admin.cache.index');
    }

    // Route cache clear
    public function routeCache(Request $request){
        Artisan::call('route:clear');
        Artisan::call('route:cache');

        return response()->json([
            'status' => 'success',
            'message' => 'Route cache cleared successfully!'
        ]);
    }

     // View cache clear
    public function viewCache(){
        Artisan::call('view:clear');

        return response()->json([
        "status" => "success",
        "message" => "View cache cleared successfully!"
        ]);
    }

     // Config cache clear
    public function configCache(){
        Artisan::call('config:clear');

        return response()->json([
        "status" => "success",
        "message" => "Config cache cleared successfully!"
        ]);
    }

     // Simple cache clear
    public function simpleCache(){
        Artisan::call('cache:clear');

        return response()->json([
        "status" => "success",
        "message" => "Simple cache cleared successfully!"
        ]);
    }

     // All cache clear
    public function allCache(){
        Artisan::call('route:clear');
        Artisan::call('route:cache');
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('optimize:clear');

        return response()->json([
        "status" => "success",
        "message" => "All cache cleared successfully!"
        ]);
    }

    public function cacheClear()
    {
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
       Artisan::call('optimize:clear'); // clears route, config, view, event caches

        // Optionally rebuild config cache
        Artisan::call('route:cache'); // optional if you want faster route loading

        return redirect()->back()->with('success', 'Caches cleared and rebuilt successfully!');
    }
}
