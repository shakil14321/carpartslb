<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CarPartController;
use App\Http\Controllers\brandController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\CarPartTypeController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\CarPartsBrandsController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\VerificationController;
use App\Http\Controllers\Frontend\Auth\PasswordResetController;
use App\Http\Controllers\Admin\FwiProductController;

use App\Http\Controllers\ShippingController;


// Fronted pages
Route::get('/cc', [PageController::class, 'cacheClear'])->name('cacheClear');
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/product/{slug}', [CarPartController::class, 'show'])->name('product.view');
Route::get('/category/{slug}', [PageController::class, 'shopType'])->name('type.view');
Route::get('/categories', [PageController::class, 'partType'])->name('types.view');
Route::get('/brand/{slug}', [PageController::class, 'brandBy'])->name('brand.view');
Route::get('/brands', [PageController::class, 'brands'])->name('brands.view');
Route::get('/part-brand/{slug}', [PageController::class, 'partBrandBy'])->name('partBrand.view');
Route::get('/part-brands', [PageController::class, 'partBrand'])->name('partBrands.view');
Route::get('/shop', [PageController::class, 'shop'])->name('shop');
Route::get('/about', [PageController::class, 'aboutPage'])->name('about');
Route::get('/contact', [PageController::class, 'contactPage'])->name('contact');
Route::get('/refund-policy', [PageController::class, 'refundPolicyPage'])->name('refundPolicy');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicyPage'])->name('privacyPolicy');
Route::get('/faq', [PageController::class, 'faqPage'])->name('faq');
Route::get('/terms-conditions', [PageController::class, 'termsConditions'])->name('termsConditions');

// routes/web.php
Route::post('/get-distance', [ShippingController::class, 'getDistance'])
    ->name('shipping.distance.frontend'); // no auth middleware


// Contact page form data store Route
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Search page (Blade)
Route::get('/search', [PageController::class, 'searchPage'])->name('search.page');

// Search data API (AJAX JSON)
Route::get('/search-products', [PageController::class, 'search'])->name('products.search');

// Cart functionality routes

// Cart
Route::get('/cart/data', [CartController::class, 'data'])->name('cart.data');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/updateQuantity', [CartController::class, 'updateQuantity'])->name('cart.update.quantity');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/checkout', [CartController::class, 'checkoutPage'])->name('checkout.page')->middleware('auth');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::post('/order-default', [OrderController::class, 'storeDefault'])->name('order.default');

// Reviews functionality routes
Route::post('/submit-review', [ReviewController::class, 'store'])->name('review.store');

// Middleware on specious front pages
Route::middleware(['guest', 'prevent-back-history'])->group(function () {

    // Front registration & login
    Route::get('registration', [RegisterController::class, 'showForm'])->name('register.form');
    Route::post('registration', [RegisterController::class, 'register'])->name('register');

    Route::get('/auto/admin/login', [LoginController::class, 'adminLoginPage'])->name('adminLogin.view');
    Route::post('/auto/admin/login', [LoginController::class, 'adminLogin'])->name('adminLogin');

    Route::get('auto/author/login', [LoginController::class, 'authorLoginPage'])->name('authorLogin.view');
    Route::post('auto/author/login', [LoginController::class, 'authorLogin'])->name('authorLogin');

    Route::get('login', [LoginController::class, 'showForm'])->name('login.form');
    Route::post('login', [LoginController::class, 'login'])->name('login');

    Route::get('verify-email', [VerificationController::class, 'showForm'])->name('verify.form');
    Route::post('verify-email', [VerificationController::class, 'verify'])->name('verify');
    Route::get('resend-code-verify-email', [VerificationController::class, 'resendView'])->name('resend.view');
    Route::post('resend-code-verify-email', [VerificationController::class, 'resend'])->name('verify.resend');

    // Password reset
    Route::get('password-reset', [PasswordResetController::class, 'showRequestForm'])->name('password.request');
    Route::post('password-reset', [PasswordResetController::class, 'sendCode'])->name('password.send');
    Route::get('password-reset/verify', [PasswordResetController::class, 'showVerifyForm'])->name('password.verify.form');
    Route::post('password-reset/verify', [PasswordResetController::class, 'verifyCode'])->name('password.verify');
    Route::post('password-reset/update', [PasswordResetController::class, 'updatePassword'])->name('password.update');
});

// Customer dashboard
Route::prefix('customer')->middleware(['auth', 'role:customer', 'prevent-back-history'])->group(function () {
    Route::get('/dashboard', [AddressController::class, 'index'])->name('customerDashboard');
    Route::put('/update', [AuthController::class, 'updateCustomer'])->name('customer.update');
    Route::resource('/address', AddressController::class)->except(['show']);
    Route::get('/order/view/{id}', [OrderController::class, 'orderView'])->name('orderView.customer');
    Route::put('/order/{id}', [OrderController::class, 'updateCustomer'])->name('orders.update');
    Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

// Logout route
Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

// Admin and Author routes
Route::prefix('panel')->middleware(['auth', 'role:admin|author', 'prevent-back-history'])->group(function () {

    Route::get('/author/dashboard', [LoginController::class, 'authorDashboard'])->name('authorDashboard.view');

    Route::resource('/post', PostController::class);
    Route::resource('/category', PostCategoryController::class);
    Route::resource('/brand', brandController::class);
    Route::resource('/part-brand', CarPartsBrandsController::class);
    Route::resource('/model', CarModelController::class);
    Route::resource('/type', CarPartTypeController::class);
    Route::resource('/product', CarPartController::class);

    Route::get('/user/{user}/edit', [AuthController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}', [AuthController::class, 'update'])->name('user.update');

    // Search routes
    Route::get('/pro/search', [CarPartController::class, 'productSearchAdmin'])->name('productSearch.admin');
    Route::get('t/search', [CarPartTypeController::class, 'productTypeSearchAdmin'])->name('typeSearch.admin');
    Route::get('b/search', [brandController::class, 'brandSearch'])->name('brandSearch.admin');
    Route::get('pb/search', [CarPartsBrandsController::class, 'SubCategoriesSearch'])->name('SubCategoriesSearch.admin');
    Route::get('m/search', [CarModelController::class, 'modelSearch'])->name('modelSearch.admin');

    // Cache routes
    Route::get('/clear-cache', [PageController::class, 'cache'])->name('cache');
    Route::post('/route-cache', [PageController::class, 'routeCache'])->name('route.cache');
    Route::post('/view-cache', [PageController::class, 'viewCache'])->name('view.cache');
    Route::post('/config-cache', [PageController::class, 'configCache'])->name('config.cache');
    Route::post('simple-cache', [PageController::class, 'simpleCache'])->name('simple.cache');
    Route::post('/all-cache', [PageController::class, 'allCache'])->name('all.cache');

    // Mulitiple products/parts delete routes
    Route::post('product/delete-selected', [CarPartController::class, 'deleteSelected'])->name('product.deleteSelected');

    // Mulitiple car brands delete routes
    Route::post('brand/delete-selected', [brandController::class, 'deleteSelected'])->name('brand.deleteSelected');

    // Mulitiple Sub Categoriess delete routes
    Route::post('part-brand/delete-selected', [CarPartsBrandsController::class, 'deleteSelected'])->name('partBrand.deleteSelected');

    // Mulitiple models delete routes
    Route::post('model/delete-selected', [CarModelController::class, 'deleteSelected'])->name('model.deleteSelected');

    // Mulitiple types/categories delete routes
    Route::post('type/delete-selected', [CarPartTypeController::class, 'deleteSelected'])->name('type.deleteSelected');

    // Media feature images route
    Route::get('/feature-images', [MediaController::class, 'featureImagePage'])->name('featureImage.view');

    // Media gallery images route
    Route::get('/gallery-images', [MediaController::class, 'galleryImagePage'])->name('galleryImage.view');

    // Media products categories images route
    Route::get('/category-images', [MediaController::class, 'categoryImagePage'])->name('categoryImage.view');

    // Media brand images route
    Route::get('/brand-images', [MediaController::class, 'brandImagePage'])->name('brandImage.view');

    // Media model images route
    Route::get('/model-images', [MediaController::class, 'modelImagePage'])->name('modelImage.view');

    // Media user images route
    Route::get('/user-images', [MediaController::class, 'userImagePage'])->name('userImage.view');

    // upload feature images
    Route::post('/upload-feature-images', [MediaController::class, 'uploadFeatureImages'])->name('feature.upload');
    // upload gallery images
    Route::post('/upload-gallery-images', [MediaController::class, 'uploadGalleryImages'])->name('gallery.upload');
    // upload category images
    Route::post('/upload-category-images', [MediaController::class, 'uploadCategoryImages'])->name('category.upload');
    // upload brand images
    Route::post('/upload-brand-images', [MediaController::class, 'uploadBrandImages'])->name('brand.upload');
    // upload model images
    Route::post('/upload-model-images', [MediaController::class, 'uploadModelImages'])->name('model.upload');
    // upload user images
    Route::post('/upload-user-images', [MediaController::class, 'uploadUserImages'])->name('user.upload');

    // Feature images multi selected deleted
    Route::delete('/feature-images/delete', [MediaController::class, 'deleteSelected'])->name('featureImage.deleteSelected');
    // Feature image single delete
    Route::delete('/feature-image/delete', [MediaController::class, 'deleteSingle'])
        ->where('filename', '.*')
        ->name('featureImage.deleteSingle');

    // Gallery images multi selected deleted
    Route::delete('/gallery-images/delete', [MediaController::class, 'deleteSelectedGallery'])->name('galleryImage.deleteSelected');
    // Gallery image single delete
    Route::delete('/gallery-image/delete', [MediaController::class, 'deleteSingleGallery'])
        ->where('filename', '.*')
        ->name('galleryImage.deleteSingle');

    // Product category images multi selected deleted
    Route::delete('/type-images/delete', [MediaController::class, 'deleteSelectedCategory'])->name('categoryImage.deleteSelected');
    // Product category single delete
    Route::delete('/type-image/delete', [MediaController::class, 'deleteSingleCategory'])
        ->where('filename', '.*')
        ->name('categoryImage.deleteSingle');

    // Brand images multi selected deleted
    Route::delete('/brand-images/delete', [MediaController::class, 'deleteSelectedBrand'])->name('brandImage.deleteSelected');
    // Brand single delete
    Route::delete('/brand-image/delete', [MediaController::class, 'deleteSingleBrand'])
        ->where('filename', '.*')
        ->name('brandImage.deleteSingle');

    // Model images multi selected deleted
    Route::delete('/model-images/delete', [MediaController::class, 'deleteSelectedModel'])->name('modelImage.deleteSelected');
    // Model single delete
    Route::delete('/model-image/delete', [MediaController::class, 'deleteSingleModel'])
        ->where('filename', '.*')
        ->name('modelImage.deleteSingle');

    // Model search Route
    Route::get('/model-images/search', [MediaController::class, 'searchModelImages'])->name('modelImage.search');

    Route::post('/product/gallery/delete', [CarPartController::class, 'deleteGalleryImage'])
        ->name('product.gallery.delete');
});

// Admin routes
Route::prefix('panel')->middleware(['auth', 'role:admin', 'prevent-back-history'])->group(function () {

    Route::get('/admin/dashboard', [LoginController::class, 'adminDashboard'])->name('dashboard');

    Route::resource('/user', AuthController::class)->except(['edit', 'update']);

    // Review routes
    Route::get('/reviews', [ReviewController::class, 'index'])->name('review.index');
    Route::get('/review/{id}', [ReviewController::class, 'show'])->name('review.show');
    Route::delete('/review/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
    Route::delete('/review-delete', [ReviewController::class, 'deleteSelected'])->name('review.deleteSelected');
    Route::get('/review/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::put('/review/{id}/update', [ReviewController::class, 'update'])->name('review.update');

    // Search routes
    Route::get('or/search', [OrderController::class, 'orderSearch'])->name('orderSearch.admin');
    Route::get('or/review/search', [OrderController::class, 'orderReviewSearch'])->name('orderReviewSearch.admin');
    Route::get('or/process/search', [OrderController::class, 'orderProcessSearch'])->name('orderProcessSearch.admin');
    Route::get('or/deliver/search', [OrderController::class, 'orderDeliverSearch'])->name('orderDeliverSearch.admin');
    Route::get('or/complete/search', [OrderController::class, 'orderCompleteSearch'])->name('orderCompleteSearch.admin');
    Route::get('or/cancel/search', [OrderController::class, 'orderCancelSearch'])->name('orderCancelSearch.admin');
    Route::get('contact/search', [ContactController::class, 'contactSearch'])->name('contactSearch.admin');
    Route::get('re/search', [ReviewController::class, 'reviewSearch'])->name('reviewSearch.admin');
    Route::get('cus/search', [AuthController::class, 'customerSearch'])->name('customerSearch.admin');

    // Site setting
    Route::get('/setting/logo', [SiteSettingController::class, 'index'])->name('setting.logo');
    Route::get('/setting/home-slider', [SiteSettingController::class, 'homeSlider'])->name('setting.homeSlider');
    Route::get('/setting/announcement-bar', [SiteSettingController::class, 'announcement'])->name('setting.announcement');
    Route::get('/setting/menu', [SiteSettingController::class, 'menu'])->name('setting.menu');
    Route::get('/setting/brand', [SiteSettingController::class, 'brand'])->name('setting.brand');
    Route::get('/setting/homeText', [SiteSettingController::class, 'homeText'])->name('setting.homeText');
    Route::get('/setting/site-verification', [SiteSettingController::class, 'siteVerification'])->name('setting.verification');
    Route::post('/site-setting', [SiteSettingController::class, 'store'])->name('site.setting.store');


    // Mulitiple users/customers delete routes
    Route::post('user/delete-selected', [AuthController::class, 'deleteSelected'])->name('user.deleteSelected');

    // Mulitiple orders delete routes
    Route::delete('orders/delete-selected', [OrderController::class, 'deleteSelected'])->name('orders.deleteSelected');

    // Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orderView.admin');
    Route::get('/orders/review', [OrderController::class, 'reviewOrders'])->name('reviewOrder.admin');
    Route::get('/orders/process', [OrderController::class, 'processOrders'])->name('processOrder.admin');
    Route::get('/orders/deliver', [OrderController::class, 'deliverOrders'])->name('deliverOrder.admin');
    Route::get('/orders/complete', [OrderController::class, 'completeOrders'])->name('completeOrder.admin');
    Route::get('/orders/cancel', [OrderController::class, 'cancelOrders'])->name('cancelOrders.admin');
    Route::get('/order/{id}/view', [OrderController::class, 'show'])->name('order.view');
    Route::post('/order/cancel-item', [OrderController::class, 'cancelItem'])->name('order.cancelItem');
    Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::put('/order/{id}/update', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/order/{id}/delete', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::delete('/orders/delete-all', [OrderController::class, 'deleteAll'])->name('orders.deleteAll');


    Route::get('/fwi-products', [FwiProductController::class, 'index'])
        ->name('fwi-products.index');

    Route::post('/fwi-products/sync', [FwiProductController::class, 'sync'])
        ->name('fwi-products.sync');
    Route::get('/fwi-products/{sourceProductId}/add', [FwiProductController::class, 'add'])
        ->name('fwi-products.add');

    Route::post('/fwi-products/{sourceProductId}/store', [FwiProductController::class, 'storeToCarPart'])
        ->name('fwi-products.store');

    // Standard shipping

    Route::prefix('shipping/standard')->middleware(['auth', 'role:admin', 'prevent-back-history'])->group(function () {
        Route::get('/', [ShippingController::class, 'standardIndex'])->name('shipping.standard.index');
        Route::get('/edit/{id}', [ShippingController::class, 'standardEdit'])->name('shipping.standard.edit');
        Route::post('/store', [ShippingController::class, 'standardStore'])->name('shipping.standard.store');
        Route::get('/add', [ShippingController::class, 'standardAdd'])->name('shipping.standard.add');
        Route::put('/update/{id}', [ShippingController::class, 'standardUpdate'])->name('shipping.standard.update');
        Route::delete('/delete/{id}', [ShippingController::class, 'standardDelete'])->name('shipping.standard.delete');
        Route::get('/', [ShippingController::class, 'standardIndex'])->name('shipping.standard.index');
    });

    // Distance based shipping routes
    Route::prefix('shipping/distance')->middleware(['auth', 'role:admin', 'prevent-back-history'])->group(function () {
        // Route::get('/', [ShippingController::class, 'distanceIndex'])->name('shipping.distance.index');
        Route::get('/add', [ShippingController::class, 'distanceAdd'])->name('shipping.distance.add');
        Route::post('/store', [ShippingController::class, 'distanceStore'])->name('shipping.distance.store');
        // Route::delete('/delete/{id}', [ShippingController::class, 'distanceDelete'])->name('shipping.distance.delete');
    //     Route::post('/get-distance', [ShippingController::class, 'getDistance'])
    // ->name('shipping.distance');


    });





    // User images multi selected deleted
    Route::delete('/user-images/delete', [MediaController::class, 'deleteSelectedUser'])->name('userImage.deleteSelected');
    // User single delete
    Route::delete('/user-image/delete', [MediaController::class, 'deleteSingleUser'])
        ->where('filename', '.*')
        ->name('userImage.deleteSingle');

    // Contact routes
    Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/{id}', [ContactController::class, 'show'])->name('contact.show');
    Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
    Route::delete('/contacts-delete', [ContactController::class, 'deleteSelectedContact'])->name('contact.deleteSelected');

    Route::get('/author', [AuthController::class, 'authorView'])->name('author.view');

    Route::get('/customer', [AuthController::class, 'customersView'])->name('cutomers.view');
    Route::delete('/customer/{user}', [AuthController::class, 'destroyCustomer'])->name('customers.destroy');

    Route::get('/parts-import', [CarPartController::class, 'importPartView'])->name('parts.import');
    Route::post('/import', [CarPartController::class, 'importExcel'])->name('import');
    Route::get('/export', [CarPartController::class, 'exportExcel'])->name('export');

    Route::get('/brands-import', [brandController::class, 'importBrandView'])->name('brands.import');
    Route::post('/brand-import', [brandController::class, 'importExcel'])->name('brand.import');
    Route::get('/brand-export', [brandController::class, 'exportExcel'])->name('brand.export');

    Route::get('/part-brands-import', [CarPartsBrandsController::class, 'importBrandView'])->name('partBrands.import');
    Route::post('/part-brand-import', [CarPartsBrandsController::class, 'importExcel'])->name('partBrand.import');
    Route::get('/part-brand-export', [CarPartsBrandsController::class, 'exportExcel'])->name('partBrand.export');

    Route::get('/part-types-import', [CarPartTypeController::class, 'imporViewPartType'])->name('part-types.import');
    Route::post('/part-type-import', [CarPartTypeController::class, 'importExcel'])->name('part-type.import');
    Route::get('/part-types-export', [CarPartTypeController::class, 'exportExcel'])->name('part-types.export');

    Route::get('/models-import', [CarModelController::class, 'imporViewModel'])->name('models.import');
    Route::post('/model-import', [CarModelController::class, 'importExcel'])->name('model.import');
    Route::get('/models-export', [CarModelController::class, 'exportExcel'])->name('models.export');
});
