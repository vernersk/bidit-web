<?php

namespace App\Services;

use App\Models\Bid;
use App\Params\BidParam;
use Illuminate\Support\Facades\Date;

class BidService
{
    public function getUserBids(int $userId)
    {
        return Bid::query()
            ->where('user_id',  '=', $userId)
            ->get();
    }

    public function create(BidParam $par): bool
    {
        if($par->auction->expires_at > new Date()) return false;

        $user = $par->user;

        $auctionService = new AuctionService();
        $highestBid = $auctionService->getAuctionHighestBid($par->auction);

        if(!$highestBid && $par->amount > $par->auction->product->price){
            $this->setBid($par);
            return true;
        }

        if(!$highestBid || $highestBid->userId == $user->getAuthIdentifier()) return false;
        if($par->amount <= ceil($highestBid->amount)) return false;
        if($par->amount <= 0) return false;

        $this->setBid($par);

        return true;
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
