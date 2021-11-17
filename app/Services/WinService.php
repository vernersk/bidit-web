<?php

namespace App\Services;

use App\Params\UserAuctionParam;

class WinService
{
    public function getUserWins($userId = null, $auctionIds = -1){
        $auctionService = new AuctionService();
        $par = new UserAuctionParam;
        $par->userId = $userId ?? auth()->id();
        $par->auctionIds = $auctionIds;
        $par->isWinner = true;
        $par->isComplete = true;

        return $auctionService->getAuctionsUserBidOn($par);
    }
}
