<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Role;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Backend\BrandController;


// default routes
Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/index/login', [MainController::class, 'Login'])->name('index.login');

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

    Route::controller(BrandController::class)->group(function(){
        Route::get('/all/brands', 'AllBrand')->name('all.brands');
        Route::get('/add/brand' , 'AddBrand')->name('add.brand');
    });

});


require __DIR__.'/auth.php';
