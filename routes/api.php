<?php

use App\Http\Controllers\API\AuctionApiController;
use App\Http\Controllers\API\UserApiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\WinController;
use App\Models\Product;
use App\Models\Transaction;
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

Route::get('users', [UserApiController::class, 'get']);
Route::get('users/{userId}', [UserApiController::class, 'getById']);
Route::get('users/{userId}/wins', [UserApiController::class, 'getWonAuctions']);

Route::get('auctions', [AuctionApiController::class, 'get']);
// Required API form-data: auctionId, bid, userId
Route::post('auctions/bids/create', [AuctionApiController::class, 'bid']);
Route::get('auctions/{auctionId}', [AuctionApiController::class, 'getById']);
Route::get('auctions/users/{userId}', [AuctionApiController::class, 'getByUserId']);
Route::get('auctions/{auctionId}/users/{userId}/complete', [AuctionApiController::class, 'complete']);

Route::apiResource('product', ProductController::class);
Route::apiResource('win', WinController::class);
Route::apiResource('checkout', PurchaseController::class);
Route::apiResource('purchase', PurchaseController::class);

Route::get('transactions', function() {
    return Transaction::all();
});


