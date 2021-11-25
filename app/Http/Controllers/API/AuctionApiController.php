<?php

namespace App\Http\Controllers\API;

use App\Events\OnBidPlaced;
use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Product;
use App\Models\User;
use App\Params\BidParam;
use App\Services\AuctionService;
use App\Services\BidService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuctionApiController extends Controller
{
    public function __construct()
    {
        $this->service = new AuctionService();
    }

    public function get(): array
    {
        return $this->service->get();
    }

    public function getById($auctionId): array
    {
        return $this->service->getTopById($auctionId);
    }

    public function getByUserId($userId): array
    {
        return $this->service->getAuctionsByUserId($userId);
    }

    public function bid(Request $request)
    {
        $bidService = new BidService();
        $auctionId = (int)$request->input('auctionId');
        $bid = (double)$request->input('bid');
        $auctionService = new AuctionService();

        $par = new BidParam();
        $par->amount = $bid;
        $par->user = User::find($request->input('userId'));
        $par->auction = $auctionService->getAuctionById($auctionId);

        $bidService->create($par);

        broadcast(new OnBidPlaced($par->auction))->via('pusher');
    }

    public function complete($auctionId, $userId)
    {
        return $this->service->complete($auctionId, $userId);
    }

    public function create(Request $request): bool
    {
        $product = Product::find($request->productId);
        $auction = new Auction();
        $auction->product()->associate($product);
        $auction->expires_at = Carbon::now()->addDays(rand(1, 55));
        $auction->save();

        return true;
    }
}
