<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\UserData;
use App\Services\AuctionService;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
  public function addressForm(Request $request)
  {
      $auctionService = new AuctionService();
      $auction = $auctionService->getAuctionById((int)$request->auction);
      $highestBid = $auctionService->getAuctionHighestBid($auction);

      $userData = UserData::query()
          ->where('user_id', '=', auth()->id())
          ->first() ?? null;

      return view('purchase.address-form')
          ->with('auction', $auction)
          ->with('highestBid', $highestBid)
          ->with('userData', $userData);
  }

  public function delivery(Request $request)
  {
      $validated = $request->validate([
          'name' => 'required',
          'surname' => 'required',
          'address' => 'required',
          'address2' => '',
          'city' => 'required',
          'state' => 'required',
          'zip' => 'required',
      ]);

      $validated['user_id'] = auth()->id();

      $userData = new UserData();
      $userData->fill($validated);
      $userData->save();

//      if(!$validated) return redirect()->back();

      $auctionService = new AuctionService();
      $auction = $auctionService->getAuctionById($request->auctionId);

      return view('purchase.delivery', [
          'userData' => $userData,
          'auction' => $auction,
      ]);
  }

  public function getValidationFactory()
  {

  }
}
