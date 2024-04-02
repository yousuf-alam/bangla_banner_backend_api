<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

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
    return view('auth.login');
});

Route::get('/login', [AdminController::class,'login']);
Route::get('/register', [AdminController::class,'register']);
Route::post('/register-user',[AdminController::class, 'registerUser'])->name('register-user');

Route::post('/login-user',[AdminController::class, 'loginUser'])->name('login-user');

Route::get('/logout', [AdminController::class, 'logout']);

Route::prefix('console')->middleware(['admin_auth'])->group(function () {


    Route::get('/', [AdminController::class, 'dashboard']);

    Route::get('/all-payments', [AdminController::class, 'allPayments']);
    Route::get('/pending-payments', [AdminController::class, 'pendingPayments']);




});




