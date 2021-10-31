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
