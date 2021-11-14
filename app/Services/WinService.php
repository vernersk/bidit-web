<?php

namespace App\Services;

use App\Params\UserAuctionParam;

class WinService
{
    public function getUserWins($auctionIds = -1){
        $auctionService = new AuctionService();
        $par = new UserAuctionParam;
        $par->userId = auth()->id();
        $par->auctionIds = $auctionIds;
        $par->isWinner = true;
        $par->isComplete = true;

        return $auctionService->getAuctionsUserBidOn($par);
    }
}
