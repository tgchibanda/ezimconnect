<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Role;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryCotroller;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Backend\SubCategoryCotroller;

// default routes
Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/index/login', [MainController::class, 'Login'])->name('index.login');
Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');

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

    // SucCategory Routes 
    Route::controller(SubCategoryCotroller::class)->group(function(){
        Route::get('/all/subcategories' , 'AllSubCategories')->name('all.subcategories');
        Route::get('/add/subcategory' , 'AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory' , 'StoreSubCategory')->name('store.subcategory');
        Route::post('/edit/subcategory' , 'EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory' , 'UpdateSubCategory')->name('update.subcategory');
        Route::post('/remove/subcategory' , 'RemoveSubCategory')->name('remove.subcategory');

    });

});


require __DIR__.'/auth.php';
