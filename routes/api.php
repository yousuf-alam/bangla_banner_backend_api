<?php

use App\Http\Controllers\PaymentSubmissionController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->group(function () {
    Route::post('register', 'AdminController@register');
    Route::post('login', 'AdminController@login');
    Route::post('logout', 'AdminController@logout');
    Route::post('refresh', 'AdminController@refresh');
    Route::post('me', 'AdminController@me');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('users', 'AdminController@users');
        Route::get('user/{id}', 'AdminController@user');
        Route::post('user', 'AdminController@createUser');
        Route::put('user/{id}', 'AdminController@updateUser');
        Route::delete('user/{id}', 'AdminController@deleteUser');


        Route::prefix('package')->group(function () {
            Route::post('create', 'PackageController@createPackage');
            Route::post('update', 'PackageController@updatePackage');
            Route::post('delete/{id}', 'PackageController@deletePackage');
            Route::get('get', 'PackageController@getPackage');
            Route::get('get/{id}', 'PackageController@getPackageById');
        });

        Route::prefix('banner')->group(function () {
            Route::post('create', 'BannerController@createBanner');
            Route::post('update', 'BannerController@updateBanner');
            Route::post('delete/{id}', 'BannerController@deleteBanner');
            Route::get('get', 'BannerController@getBanner');
            Route::get('get/{id}', 'BannerController@getBannerById');
        });
        Route::prefix('payment')->group(function () {
            Route::get('get', [PaymentSubmissionController::class,'getPayment']);
            Route::get('get/{id}', [PaymentSubmissionController::class,'getPaymentById']);
            Route::post('update', [PaymentSubmissionController::class,'updatePayment']);
        });
    });

});

Route::prefix('user')->group(function () {
    Route::post('register', [UserController::class, 'userRegister']);
    Route::post('login', [UserController::class, 'userLogin']);


    Route::middleware('auth:sanctum')->group(function () {

        Route::get('user-profile', [UserController::class,'userProfile']);
        Route::get('debit-wallet', [UserController::class,'debitUserWallet']);
        Route::post('payment-submission', [PaymentSubmissionController::class,'paymentSubmission']);
        Route::post('logout', [UserController::class,'userLogout']);
    });
});


