<?php

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('products', function() {
    return Product::all();
});

Route::get('auctions', function() {
    return Auction::all();
});

Route::get('transactions', function() {
    return Transaction::all();
});

Route::get('bids', function() {
    return Bid::all();
});
