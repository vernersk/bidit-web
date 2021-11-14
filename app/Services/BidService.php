<?php

namespace App\Services;

use App\Models\Bid;
use App\Params\BidParam;

class BidService
{
    public function getUserBids(int $userId)
    {
        return Bid::query()
            ->where('user_id',  '=', $userId)
            ->get();
    }

    public function create(BidParam $par)
    {
        $user = $par->user ?? auth()->user();

        $auctionService = new AuctionService();
        $highestBid = $auctionService->getAuctionHighestBid($par->auction);

        if(!$highestBid && $par->amount > 0){
            $this->setBid($par);
            return;
        }

        if($highestBid->userId == $user->getAuthIdentifier()) return;
        if($par->amount <= ceil($highestBid->amount)) return;
        if($par->amount <= 0) return;

        $this->setBid($par);
    }

    private function setBid(BidParam $par){

        $user = $par->user ?? auth()->user();

        $bid = new Bid();
        $bid->auction_id = $par->auction->id;
        $bid->user_id = (int)$user->id;
        $bid->amount = $par->amount;
        $bid->save();

        $par->auction->users()->attach($user->id);
    }
}
