<?php

use App\Http\Controllers\API\AuctionApiController;
use App\Http\Controllers\API\TransactionApiController;
use App\Http\Controllers\API\UserApiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TransactionController;
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

// Example: http://bidit-web.herokuapp.com/api/users/45/bids

// All users
Route::get('users', [UserApiController::class, 'get']);
//Specific user
Route::get('users/{userId}', [UserApiController::class, 'getById']);
// Every auction user has bid on
Route::get('users/{userId}/bids', [UserApiController::class, 'getAuctionsUserBidOn']);
// Every auction user has won
Route::get('users/{userId}/wins', [UserApiController::class, 'getWonAuctions']);
// Get user transactions
Route::get('users/{userId}/transactions', [UserApiController::class, 'getTransactionsByUserId']);
// Get user address form data
Route::get('users/{userId}/address-form-data', [UserApiController::class, 'getAddressFormData']);
// Set user address form data
Route::post('users/set-address-form-data', [UserApiController::class, 'setAddressFormData']);
// Get all transactions
Route::get('transactions', function () {
    return Transaction::all();
});
// Need userId and auctionIds
Route::post('transactions/create', [TransactionController::class, 'create']);
// Get specific transaction
Route::get('transactions/{transactionId}', [TransactionApiController::class, 'getById']);
// Need transactionId and status as data
Route::post('transactions/{transactionId}/update', [TransactionApiController::class, 'updateTransaction']);

// All auctions
Route::get('auctions', [AuctionApiController::class, 'get']);
// Get auction by id
Route::get('auctions/{auctionId}', [AuctionApiController::class, 'getById']);
// Create an auction from a product, requires productId and expires_at - date / datetime
Route::post('/auctions/create', [AuctionApiController::class, 'create']);
// Add a new bid to an auction
// Required API form-data: auctionId, bid, userId
Route::post('/auctions/bids/create', [AuctionApiController::class, 'bid']);

// Get auctions that user has bid on
Route::get('auctions/users/{userId}', [AuctionApiController::class, 'getByUserId']);
//// For debugging purposes, completes an auction
Route::get('auctions/{auctionId}/users/{userId}/complete', [AuctionApiController::class, 'complete']);

// Get all products
Route::get('products', function () {
    return Product::all();
});
// Get paginated products
Route::get('/products/pages/{page}', [ProductController::class, 'getPage']);
// Refresh our database from WH db
Route::get('products/refresh', [ProductController::class, 'refresh']);

Route::apiResource('wins', WinController::class);
Route::apiResource('checkout', PurchaseController::class);
Route::apiResource('purchase', PurchaseController::class);

