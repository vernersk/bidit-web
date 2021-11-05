<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\WinController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [AuctionController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/auction/complete', [AuctionController::class, 'complete'])
        ->name('auction.complete');

    Route::resource('auction', AuctionController::class);

    Route::resource('bid', BidController::class);

    Route::resource('win', WinController::class);

    Route::resource('product', ProductController::class);

    Route::post('/purchase/address-form', [PurchaseController::class, 'addressForm'])
        ->name('purchase.address-form');

    Route::post('/purchase/delivery', [PurchaseController::class, 'delivery'])
        ->name('purchase.delivery');

    Route::post('/purchase/thanks', [PurchaseController::class, 'thanks'])
        ->name('purchase.thanks');
});



Route::get('/new4', function () {
    return view('new4');
});

Route::get('/new5', function () {
    return view('new5');
});

Route::fallback(function () {
    return abort(404);
});

