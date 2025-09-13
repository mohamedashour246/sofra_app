<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PaymentController;

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

    Route::get('logout',[LoginController::class,'logout'])->name('logout');

Route::group(['middleware' => 'auth','checkPermission'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('cities',CityController::class);

    Route::resource('districts',DistrictController::class);

    Route::resource('categories',CategoryController::class);

    Route::get('offers',[OfferController::class,'index'])->name('offers.index');

    Route::delete('offers/delete/{id}',[OfferController::class,'deleteOffer'])->name('offers.delete');

    Route::get('contacts',[ContactController::class,'index'])->name('contacts.index');

    Route::delete('contacts/delete/{id}',[ContactController::class,'deleteContacts'])->name('contacts.delete');

    Route::get('editSetting',[SettingController::class,'editSetting'])->name('setting.edit');

    Route::post('updateSetting',[SettingController::class,'updateSetting'])->name('setting.update');

    Route::get('restaurants',[RestaurantController::class,'index'])->name('restaurants.index');

    Route::post('restaurants/delete/{id}',[RestaurantController::class,'deleteRestaurant'])->name('restaurants.delete');

    Route::post('changeRestaurantStatus',[RestaurantController::class,'changeRestaurantStatus'])->name('changeRestaurantStatus');

    Route::get('clients',[ClientController::class,'index'])->name('clients.index');

    Route::post('clients/delete/{id}',[ClientController::class,'deleteClient'])->name('clients.delete');

    Route::post('changeClientStatus',[ClientController::class,'changeClientStatus'])->name('changeClientStatus');

    Route::resource('payments',PaymentController::class);

    Route::get('orders',[OrderController::class,'index'])->name('orders.index');

    Route::resource('users',UserController::class);

    Route::resource('roles',RoleController::class);
});
