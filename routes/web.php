<?php

use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Role;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryCotroller;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Backend\SubCategoryCotroller;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\PaymentController;

// default routes
Route::get('/', [IndexController::class, 'Index']);

Route::middleware('guest')->group(function () {
Route::get('/index/login', [MainController::class, 'Login'])->name('index.login');
Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');

});

/// Frontend Product and Vendor Details All Route 

Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
Route::get('/vendor/details/{id}', [IndexController::class, 'VendorDetails'])->name('vendor.details');
Route::get('/all/vendors', [IndexController::class, 'AllVendors'])->name('all.vendors');
Route::get('/product/category/{id}/{slug}', [IndexController::class, 'CatWiseProducts']);
Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'SubCatWiseProducts']);


// Product View Modal With Ajax

Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

// Cart Routes
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
Route::get('/product/mini/cart', [CartController::class, 'GetCartProducts']);
Route::get('/minicart/product/remove/{id}', [CartController::class, 'RemoveCart']);


// Checkout Page Route 
Route::get('/checkout', [CartController::class, 'CreateCheckout'])->name('checkout');

Route::controller(CheckoutController::class)->group(function(){
    Route::get('/district-get/ajax/{division_id}' , 'DistrictGetAjax');
    Route::get('/state-get/ajax/{district_id}' , 'StateGetAjax');
    Route::post('/checkout/store' , 'CheckoutStore')->name('checkout.store');
                // Stripe All Route 
        Route::controller(PaymentController::class)->group(function(){
            Route::post('/stripe/order' , 'PayOrder')->name('stripe.order');
            Route::post('/cash/order' , 'PayOrder')->name('cash.order');

        });

}); 

/// Frontend Coupon Option
Route::post('/apply-coupon', [CartController::class, 'ApplyCoupon']);
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/remove-coupon', [CartController::class, 'RemoveCoupon']);

// Wishlist routes
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);
// Compare routes
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);




Route::middleware(['auth'])->group(function () {
    Route::controller(WishlistController::class)->group(function(){
        Route::get('/wishlist' , 'AllWishlist')->name('wishlist');
        Route::get('/get-wishlist-products' , 'GetWishlistProducts');
        Route::get('/remove-wishlist/{id}' , 'RemoveWishlist');
    }); 

// Compare routes
    Route::controller(CompareController::class)->group(function(){
        Route::get('/compare' , 'AllCompare')->name('compare');
        Route::get('/get-compare-products' , 'GetCompareProducts');
        Route::get('/remove-compare/{id}' , 'RemoveCompare');
    }); 

     // Cart Routes 
    Route::controller(CartController::class)->group(function(){
        Route::get('/mycart' , 'MyCart')->name('mycart');
        Route::get('/get-cart-products' , 'GetCartProducts');
        Route::get('/update-cart-quantity/{id}', [CartController::class, 'updateCartQuantity']);

    }); 

}); 



//auth
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/index/profile/store', [MainController::class, 'ProfileStore'])->name('index.profile.store');
    Route::post('/index/update/password', [MainController::class, 'UpdatePassword'])->name('update.password');
    Route::get('/index/logout', [MainController::class, 'Destroy'])->name('index.logout');
});

//auth admin
Route::middleware(['auth', Role::class . ':index'])->group(function () {
    Route::get('/index/dashboard', [MainController::class, 'Dashboard'])->name('index.dashboard');
    Route::get('/index/profile', [MainController::class, 'Profile'])->name('index.profile');
    Route::get('/index/change/password', [MainController::class, 'ChangePassword'])->name('index.change.password');
    
    // Vendor
    Route::controller(MainController::class)->group(function(){
        Route::get('/inactive/vendors' , 'InactiveVendors')->name('inactive.vendors');
        Route::get('/active/vendors' , 'ActiveVendors')->name('active.vendors');
        Route::post('/inactive/vendor/details' , 'VendorDetails')->name('inactive.vendor.details');
        Route::post('/change/vendor/status' , 'ChangeStatus')->name('change.vendor.status');
    
    });

    // Brand Routes 
    Route::controller(BrandController::class)->group(function(){
        Route::get('/all/brands', 'AllBrand')->name('all.brands');
        Route::get('/add/brand' , 'AddBrand')->name('add.brand');
        Route::post('/store/brand' , 'StoreBrand')->name('store.brand');
        Route::post('/edit/brand' , 'EditBrand')->name('edit.brand');
        Route::post('/update/brand' , 'UpdateBrand')->name('update.brand');
        Route::post('/remove/brand' , 'RemoveBrand')->name('remove.brand');
    });

    // Category Routes 
    Route::controller(CategoryCotroller::class)->group(function(){
        Route::get('/all/categories', 'AllCategory')->name('all.categories');
        Route::get('/add/category' , 'AddCategory')->name('add.category');
        Route::post('/store/category' , 'StoreCategory')->name('store.category');
        Route::post('/edit/category' , 'EditCategory')->name('edit.category');
        Route::post('/update/category' , 'UpdateCategory')->name('update.category');
        Route::post('/remove/category' , 'RemoveCategory')->name('remove.category');
    });

    // SubCategory Routes 
    Route::controller(SubCategoryCotroller::class)->group(function(){
        Route::get('/all/subcategories' , 'AllSubCategories')->name('all.subcategories');
        Route::get('/add/subcategory' , 'AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory' , 'StoreSubCategory')->name('store.subcategory');
        Route::post('/edit/subcategory' , 'EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory' , 'UpdateSubCategory')->name('update.subcategory');
        Route::post('/remove/subcategory' , 'RemoveSubCategory')->name('remove.subcategory');
        Route::get('/subcategory/ajax/{category_id}' , 'GetSubCategory');

    });

    // Product All Route 
    Route::controller(ProductController::class)->group(function(){
    Route::get('/all/products' , 'AllProducts')->name('all.products');
    Route::get('/add/product' , 'AddProduct')->name('add.product');
    Route::post('/store/product' , 'StoreProduct')->name('store.product');
    Route::post('/edit/product' , 'EditProduct')->name('edit.product');
    Route::post('/update/product' , 'UpdateProduct')->name('update.product');
    Route::post('/update/product/thumbnail' , 'UpdateProductThumbnail')->name('update.product.thumbnail');
    Route::post('/update/product/multiimages' , 'UpdateProductMultiimages')->name('update.product.multiimages');
    Route::post('/remove/product/images' , 'RemoveProductImages')->name('remove.product.images');
    Route::post('/change/product/status' , 'ChangeStatus')->name('change.product.status');
    Route::post('/remove/product' , 'RemoveProduct')->name('remove.product');

    });

    // Slider Routes 
    Route::controller(SliderController::class)->group(function(){
        Route::get('/all/sliders' , 'AllSliders')->name('all.sliders');
        Route::get('/add/slider' , 'AddSlider')->name('add.slider');
        Route::post('/store/slider' , 'StoreSlider')->name('store.slider');
        Route::post('/edit/slider' , 'EditSlider')->name('edit.slider');
        Route::post('/update/slider' , 'UpdateSlider')->name('update.slider');
        Route::post('/remove/slider' , 'RemoveSlider')->name('remove.slider');

    });

    // Banner Routes 
    Route::controller(BannerController::class)->group(function(){
        Route::get('/all/banners' , 'AllBanners')->name('all.banners');
        Route::get('/add/banner' , 'AddBanner')->name('add.banner');
        Route::post('/store/banner' , 'StoreBanner')->name('store.banner');
        Route::post('/edit/banner' , 'EditBanner')->name('edit.banner');
        Route::post('/update/banner' , 'UpdateBanner')->name('update.banner');
        Route::post('/remove/banner' , 'RemoveBanner')->name('remove.banner');

    });

    // Coupons
    Route::controller(CouponController::class)->group(function(){
        Route::get('/all/coupons' , 'AllCoupons')->name('all.coupons');
        Route::get('/add/coupon' , 'AddCoupon')->name('add.coupon');
        Route::post('/store/coupon' , 'StoreCoupon')->name('store.coupon');
        Route::post('/edit/coupon' , 'EditCoupon')->name('edit.coupon');
        Route::post('/update/coupon' , 'UpdateCoupon')->name('update.coupon');
        Route::post('/remove/coupon' , 'RemoveCoupon')->name('remove.coupon');
    });


    // Shipping Area routes
    Route::controller(ShippingAreaController::class)->group(function(){
        // Divisions
        Route::get('/all/divisions' , 'AllDivisions')->name('all.divisions');
        Route::get('/add/division' , 'AddDivision')->name('add.division');
        Route::post('/store/division' , 'StoreDivision')->name('store.division');
        Route::post('/edit/division' , 'EditDivision')->name('edit.division');
        Route::post('/update/division' , 'UpdateDivision')->name('update.division');
        Route::post('/remove/division' , 'RemoveDivision')->name('remove.division');

        // Districts
        Route::get('/all/districts' , 'AllDistricts')->name('all.districts');
        Route::get('/add/district' , 'AddDistrict')->name('add.district');
        Route::post('/update/district' , 'UpdateDistrict')->name('update.district');
        Route::post('/store/district' , 'StoreDistrict')->name('store.district');
        Route::post('/edit/district' , 'EditDistrict')->name('edit.district');
        Route::post('/remove/district' , 'RemoveDistrict')->name('remove.district');

        // States
        Route::get('/all/states' , 'AllStates')->name('all.states');
        Route::get('/add/state' , 'AddState')->name('add.state');
        Route::post('/update/state' , 'UpdateState')->name('update.state');
        Route::post('/store/state' , 'StoreState')->name('store.state');
        Route::post('/edit/state' , 'EditState')->name('edit.state');
        Route::post('/remove/state' , 'RemoveState')->name('remove.state');
        Route::get('/district/ajax/{division_id}' , 'GetDistrict');
    });

});


require __DIR__.'/auth.php';
