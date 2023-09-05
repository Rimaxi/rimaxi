<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\HobbyController;
use App\Http\Controllers\Admin\ItalianController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\UseraddController;
use App\Http\Controllers\Admin\WriteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AdminController::class, 'admin']);
Route::get('/sidebar', [AdminController::class, 'sidebar'])->name('sidebar');
Route::post('/delete/{id?}', [AdminController::class, 'delete'])->name('delete');



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('login')->middleware('guest:admin');
    Route::post('/login', [AdminController::class, 'adminLogin'])->name('loginPost')->middleware('guest:admin');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard1', [AdminController::class, 'dashboard'])->name('dashboard');
    });
});

Route::get('/front', [AdminController::class, 'index'])->name('front');


Route::post('/status/{id?}', [FoodController::class, 'updateStatus'])->name('status');
Route::resource('food', FoodController::class);
Route::resource('/italian', ItalianController::class);

Route::resource('/hobby', HobbyController::class);

Route::resource('/country', CountryController::class);
Route::resource('/state', StateController::class);
Route::resource('/city', CityController::class);

Route::get('get_state', [StateController::class, 'getState'])->name('get_state');
Route::get('get_city', [CityController::class, 'getcity'])->name('city');

Route::get('/search', [FoodController::class, 'search'])->name('search');
// Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
// Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
// Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
// Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/countrystatus/{id?}', [CountryController::class, 'updateCountryStatus'])->name('countryStatus');
Route::get('/statestatus/{id?}', [StateController::class, 'updateStateStatus'])->name('stateStatus');
Route::get('/citystatus/{id?}', [CityController::class, 'updateCityStatus'])->name('cityStatus');


Route::post('/userstore', [UseraddController::class, 'store'])->name('storeUser');
Route::get('/edit/{id?}', [UseraddController::class, 'edit'])->name('edit');
Route::post('/update/{id?}', [UseraddController::class, 'userUpdate'])->name('update');

Route::resource('post', PostController::class);
Route::resource('write',WriteController::class);
