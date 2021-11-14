<?php

namespace App\Services;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\User;
use App\Params\UserAuctionParam;
use Illuminate\Database\Eloquent\Model;

class AuctionService
{
    public function complete($auctionId, $userId)
    {
        $auction = Auction::find($auctionId);
        $auction->winner_id = $userId;
        $auction->is_complete = 1;
        $auction->users()->attach($userId);
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
            if($auction->is_complete) continue;
            $data[] = [
                'auction' => $auction,
                'product' => $auction->product,
                'highestBid' => $this->getAuctionHighestBid($auction),
            ];
        }

        return $data;
    }

    /**
     * @param UserAuctionParam $par
     * @return array
     */
    public function getAuctionsUserBidOn(UserAuctionParam $par): array
    {
        $auctions = $this->getAuctionsByUserId($par->userId, $par->auctionIds);

        $data = [];
        foreach($auctions as $auction){
            if($auction->is_complete != $par->isComplete) continue;
            if($par->isWinner && $auction->winner_id != $par->userId) continue;

            $highestBid = $this->getAuctionHighestBid($auction);

            $data[] = [
                'auction' => $auction,
                'bids' => $auction->bids(),
                'highestBid' => $highestBid,
                'product' => $auction->product,
                'isUserHighestBidder' => $highestBid->userId == $par->userId,
            ];
        }

        return $data;
    }

    /**
     * @param Model $auction
     * @return Bid|null
     */
    public function getAuctionHighestBid(Model $auction): ?Bid
    {
        return $auction->bids()
            ->join('users', 'users.id', '=', 'bids.user_id')
            ->select(['users.id as userId', 'users.name', 'bids.amount'])
            ->orderBy('amount', 'DESC')
            ->first();
    }

    public function getAuctionById(int $auctionId): ?Auction
    {
        return Auction::find($auctionId) ?? null;
    }

    /**
     * @return Auction[]
     */
    public function getAuctionsByUserId($userId, $auctionIds = -1): array
    {
        $data = [];

        $auctions = $auctionIds == -1 ? Auction::all() : Auction::query()->find($auctionIds);

        if(!$auctions) {
            return $data;
        }

        foreach($auctions as $auction){
            $datum = $auction->belongsToMany(User::class)
                ->wherePivot('user_id', $userId)
                ->first();

            if(empty($datum)) continue;

            $data[] = $auction;
        }

        return $data;
    }
}
