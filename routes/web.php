<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('dashboard');

Route::get('/user/dashboard', function () {
    return view('front');
})->name('user.dashboard');
//login & logout
Route::POST('/logout',[LoginController::class,'logout'])->name('logout');
Route::POST('/login',[LoginController::class,'login'])->name('login');

Route::get('/register',[UserController::class,'register'])->name('register');
Route::POST('/register',[UserController::class,'userRegister'])->name('userRegister');



Route::group(['middleware' => ['auth']], function () { 
     //admin route
     Route::prefix('admin')->group(function () {
        Route::resource('user',UserController::Class);
    });

    Route::prefix('user')->group(function () {
        Route::resource('booking',BookingController::Class);
        Route::get('/sloat',[BookingController::class,'sloat'])->name('booking.sloat');
    });

});