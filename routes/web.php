<?php

use App\Http\Controllers\DddCodesValueController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SimulatorController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('master')->group(function(){
    Route::get('/', [IndexController::class, 'homepage'])->name('homepage');

    Route::get('termsofservice', function () {
        return view('terms_of_use');
    });

    Route::get('privacypolicy', function () {
        return view('privacy_policy');
    });

    Route::get('cookiespolicy', function () {
        return view('cookie_policy');
    });

    Route::post('simulatecallprice', [SimulatorController::class, 'simulateCallPrice'])->name('simulatecallprice');
    Route::post('listdddcodesvalue', [DddCodesValueController::class, 'listDddCodesValue'])->name('listdddcodesvalue');
});

