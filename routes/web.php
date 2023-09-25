<?php

use App\Http\Controllers\frontend\DashboardController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\UserController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::group(['middleware' => 'guest', 'prefix' => 'user', 'as' => 'user.'], function(){
    Route::controller(UserController::class)->group(function(){
        Route::get('/open/account', 'openAccount')->name('openAccount');
        Route::post('/register', 'store')->name('store');
        Route::get('/login', 'login')->name('login');
        Route::post('/login/action', 'loginAction')->name('loginAction');
    });
});

//User Dashboard
Route::group(['middleware' => 'user.auth'], function(){
    Route::group(['prefix' => 'user', 'as' => 'user.'], function(){
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    });
});
