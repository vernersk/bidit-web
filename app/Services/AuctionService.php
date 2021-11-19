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

        return (bool)$auction->is_complete;
    }

    /**
     * @return Auction[]
     */
    public function get(): array
    {
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

    public function getTopById($auctionId): array
    {
        $auction = Auction::find($auctionId);

        $bids = $auction
            ->bids()
            ->join('users', 'users.id', '=', 'bids.user_id')
            ->select('users.id', 'users.name', 'bids.amount')
            ->orderBy('amount', 'DESC')
            ->limit(6)
            ->get();

        $orderedBids = [];
        $count = count($bids);
        for($i = 0; $i < $count; $i++){
            $orderedBids[$i] = $bids[($count-1)-$i];
        }

        $highestBid = $bids[0] ?? 0;

        return [
            'auction' => $auction,
            'product' => $auction->product,
            'bids' => $orderedBids,
            'highestBid' => $highestBid,

        ];
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
            if($auction['auction']->is_complete != $par->isComplete) continue;
            if($par->isWinner && $auction['auction']->winner_id != $par->userId) continue;
            $data[] = $auction;
        }

        return $data;
    }

    /**
     * @param Model $auction
     * @return Bid|null
     */
    public function getAuctionHighestBid(Auction $auction): ?Bid
    {
        return $auction->bids()
            ->join('users', 'users.id', '=', 'bids.user_id')
            ->select(['users.id as userId', 'users.name', 'bids.amount'])
            ->orderBy('amount', 'DESC')
            ->first();
    }

    public function getAuctionById($auctionId): ?Auction
    {
        return Auction::find($auctionId);
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

            $highestBid = $this->getAuctionHighestBid($auction);

            $data[] = [
                'auction' => $auction,
                'bids' => $auction->bids,
                'highestBid' => $highestBid,
                'product' => $auction->product,
                'isUserHighestBidder' => $highestBid->userId == $userId,
            ];
        }

        return $data;
    }
}
