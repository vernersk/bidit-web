<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Models\Product;
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

    Route::resource('bid', BidController::class);

    Route::get('my-transactions', function() {
       return view('user-transactions');
    })->name('my-transactions');

    Route::get('my-wins', function () {
        return view('user-wins');
    })->name('my-wins');

    Route::get('thank-you', function () {
        return view('purchase.thanks');
    })->name('thank-you');

    Route::get('cart', function(){
        return view('/purchase/shopping-cart');
    })->name('cart');

    Route::get('checkout', function () {
        return view('checkout');
    })->name('checkout');

    Route::get('/purchase/delivery', [PurchaseController::class, 'delivery'])
        ->name('purchase.delivery');

    Route::get('/products', function() {
        return view('products');
    })->name('products');

    Route::resource('product', ProductController::class);

    Route::resource('auction', AuctionController::class);
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

