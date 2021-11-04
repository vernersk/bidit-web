<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;
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

Route::resource('auction', AuctionController::class)->middleware('auth');

Route::resource('bid', BidController::class)->middleware('auth');

Route::resource('win', WinController::class)->middleware('auth');

Route::resource('product', \App\Http\Controllers\ProductController::class)->middleware('auth');




Route::get('/new1', function () {
    return view('new1');
});

Route::get('/new2', function () {
    return view('new2');
});

Route::get('/new3', function () {
    return view('new3');
});

Route::get('/new4', function () {
    return view('new4');
});

Route::get('/new5', function () {
    return view('new5');
});

