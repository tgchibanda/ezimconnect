<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Middleware\Role;
use App\Http\Controllers\UserController;


//default login 
Route::get('/', function () {
    return view('welcome');
});

//admin login
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

//vendor login
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login');

// default auth dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// default auth routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//auth admin
Route::middleware(['auth', Role::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');
});

//auth vendor
Route::middleware(['auth', Role::class . ':vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');
    Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy'])->name('vendor.logout');
    Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');
    Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('update.password');
});

//auth user
Route::middleware(['auth', 'verified', Role::class . ':user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
    });



require __DIR__.'/auth.php';
