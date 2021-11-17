<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Params\BidParam;
use App\Params\UserAuctionParam;
use App\Services\AuctionService;
use App\Services\BidService;
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

    public function getAuctionsUserBidOn(int $userId, bool $isWinner = false, bool $isComplete = false, $auctionIds = -1): array
    {
        $par = new UserAuctionParam();
        $par->userId = $userId;
        $par->isWinner = $isWinner;
        $par->isComplete = $isComplete;
        $par->auctionIds = $auctionIds;

        return $this->service->getAuctionsUserBidOn($par);
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

        return $bidService->create($par);
    }

    public function complete($auctionId, $userId)
    {
        return $this->service->complete($auctionId, $userId);
    }
}
