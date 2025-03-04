<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\driverController;
use App\Http\Controllers\passengerController;

use App\Http\Controllers\Auth\GoogleLoginController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth','isadmin']);

Route::get('driver/dashboard', [driverController::class, 'index'])->middleware(['auth','isdriver']);

Route::get('passenger/dashboard', [passengerController::class, 'index'])->middleware(['auth','ispassenger']);
Route::get('passenger/activeride', [passengerController::class, 'activeride'])->middleware(['auth','ispassenger'])->name('active.ride');



// Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])
//     ->name('socialite.redirect');
// Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])
//     ->name('socialite.callback');


Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

// Route::get('/auth/google', [GoogleLoginController::class, 'handleGoogleCallback'])->name('auth.google');
// Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);