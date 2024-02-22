<?php

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
    });

});

Route::prefix('user')->group(function () {
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');
    Route::post('logout', 'UserController@logout');
    Route::post('refresh', 'UserController@refresh');
    Route::post('me', 'UserController@me');

    Route::middleware('auth:sanctum')->group(function () {


    });
});


