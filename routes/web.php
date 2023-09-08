<?php

// use App\Http\Controllers\AdminController;
// use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\CityController;
// use App\Http\Controllers\CountryController;
// use App\Http\Controllers\FoodController;
// use App\Http\Controllers\HobbyController;
// use App\Http\Controllers\ItalianController;
// use App\Http\Controllers\StateController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;






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

Auth::routes();

Route::group(['middleware' => 'guest'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth:user')->name('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth:user')->name('home');



Route::get('/userlogin', [UserController::class, 'login'])->name('user.login')->middleware('guest:user');
Route::post('/userlogin', [UserController::class, 'userlogin'])->name('loginuser')->middleware('guest:user');
Route::get('/user', [UserController::class, 'front'])->name('userRegister');
Route::post('/storeuser', [UserController::class, 'store'])->name('userStore');
Route::get('/logoutuser', [UserController::class, 'logout'])->name('logoutUsers')->middleware('auth:user');

Route::get('forget-password', [UserController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [UserController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [UserController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [UserController::class, 'submitResetPasswordForm'])->name('reset.password.post');
