<?php

namespace App\Services;

use App\Models\Auction;
use App\Models\User;
use App\Params\UserAuctionParam;

class AuctionService
{
    public function complete($auctionId, $userId)
    {
        $auction = Auction::find($auctionId);
        $auction->winner_id = $userId;
        $auction->is_complete = 1;
        $auction->save();
    }

    /**
     * @return Auction[]
     */
    public function get(){
        $auctions = Auction::all()
            ->where('isComplete', '=', false);

        $data = [];
        foreach($auctions as $auction){
            $highestBid = $this->getAuctionHighestBid($auction);
            if($auction->is_complete || $auction->winner_id) continue;

            $data[] = $auction;
            if(isset($highestBid->amount)){
                $auction->highestBid = $highestBid;
                $user = User::where('id', $highestBid->user_id)->first();
                $auction->highestBid->user = $user->name;
            }
        }

        return $data;
    }

    /**
     * @param UserAuctionParam $par
     * @return array
     */
    public function getUserBidAuctions(UserAuctionParam $par): array
    {
        $bidService  = new BidService();
        $userBids = $bidService->getUserBids($par->userId);

        $data = [];
        $auctions = [];
        foreach($userBids as $bid){
            if(in_array($bid->auction, $auctions)) continue;
            if($bid->auction->is_complete != $par->isComplete) continue;
            if($par->isWinner && $bid->auction->winner_id != $par->userId) continue;

            $auctions[] = $bid->auction;
            $highestBid = $bid->auction
                ->bids()
                ->join('users', 'users.id', '=', 'bids.user_id')
                ->select(['users.id as userId', 'users.name', 'bids.amount'])
                ->orderBy('amount', 'DESC')
                ->first();

            $data[] = [
                'userBid' => $bid,
                'highestBid' => $highestBid->amount ? $highestBid : 0,
                'auction' => $bid->auction,
                'isUserHighestBidder' => $highestBid->userId == $par->userId,
            ];
        }

        return $data;
    }

    public function getUserWonAuctions()
    {

    }

    public function getAuctionHighestBid(Auction $auction)
    {
        return  $auction->bids()->orderBy('amount', 'DESC')->first() ?? null;
    }

    public function getAuctionById(int $auctionId)
    {
        return Auction::query()->where('id', $auctionId)->first() ?? null;
    }
}
