<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api'],function () {

    Route::post('registerClient',[AuthController::class,'registerClient']);

    Route::post('loginClient',[AuthController::class,'loginClient']);

    Route::post('registerRestaurant',[AuthController::class,'registerRestaurant']);

    Route::post('loginRestaurant',[AuthController::class,'loginRestaurant']);

    Route::post('resetRestaurantPassword',[AuthController::class,'resetRestaurantPassword']);

    Route::post('updateRestaurantPassword',[AuthController::class,'updateRestaurantPassword']);

    Route::post('resetClientPassword',[AuthController::class,'resetClientPassword']);

    Route::post('updateClientPassword',[AuthController::class,'updateClientPassword']);


    Route::group(['middleware' => 'auth:api-restaurant'],function () {

        Route::get('offers',[MainController::class,'offers']);

        Route::get('orders',[MainController::class,'orders']);

        Route::get('products',[MainController::class,'products']);

        Route::post('addOffer',[OfferController::class,'addOffer']);

        Route::post('updateOffer/{id}',[OfferController::class,'updateOffer']);

        Route::post('deleteOffer/{id}',[OfferController::class,'deleteOffer']);

        Route::post('addProduct',[ProductController::class,'addProduct']);

        Route::post('updateProduct/{id}',[ProductController::class,'updateProduct']);

        Route::post('deleteProduct/{id}',[ProductController::class,'deleteProduct']);

        Route::post('review',[OrderController::class,'addReview']);

        Route::get('commissions',[MainController::class,'commissions']);

        Route::get('settings/{id}',[MainController::class,'settings']);

        Route::post('acceptOrder',[OrderController::class,'acceptOrder']);

        Route::post('rejectOrder',[OrderController::class,'rejectOrder']);

        Route::post('deliverOrder',[OrderController::class,'deliverOrder']);

        Route::post('declineOrder',[OrderController::class,'declineOrder']);

    });

    Route::group(['middleware' => 'auth:api'],function () {

        Route::post('send-email',[AuthController::class,'sendEmail']);

        Route::post('addOrder',[OrderController::class,'addOrder']);

        Route::post('acceptClientOrder',[OrderController::class,'acceptOrder']);
    });

});

