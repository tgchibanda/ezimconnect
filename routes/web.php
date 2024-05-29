<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Role;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;


// default routes
Route::get('/', function () {
    return view('frontend.index');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/index/profile/store', [MainController::class, 'ProfileStore'])->name('index.profile.store');
    Route::post('/index/update/password', [MainController::class, 'UpdatePassword'])->name('update.password');
    Route::get('/index/logout', [MainController::class, 'Destroy'])->name('index.logout');
});


//login 
Route::get('/index/login', [MainController::class, 'Login'])->name('index.login');

//auth
Route::middleware(['auth', Role::class . ':index'])->group(function () {
    Route::get('/index/dashboard', [MainController::class, 'Dashboard'])->name('index.dashboard');
    Route::get('/index/profile', [MainController::class, 'Profile'])->name('index.profile');
    Route::get('/index/change/password', [MainController::class, 'ChangePassword'])->name('index.change.password');
});



require __DIR__.'/auth.php';
