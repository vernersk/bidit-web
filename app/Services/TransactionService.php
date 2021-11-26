<?php

namespace App\Services;

use App\Models\Transaction;
use App\Params\TransactionParam;

class TransactionService
{
    public function store(TransactionParam $par)
    {
        $auctionService = new AuctionService();

        $transaction = new Transaction();
        $transaction->status = Transaction::STATUS_PENDING;
        $transaction->user_id = $par->userId;

        $total = 0.0;
        foreach($par->auctions as $auction){
            if($auction->transaction) continue;
            $highestBidder = $auctionService->getAuctionHighestBid($auction);
            $total += $highestBidder->amount;
        }

        $transaction->total = $total;
        $transaction->save();

        foreach($par->auctions as $auction){
            $auction->transaction()->associate($transaction);
            $auction->save();
        }

        return $transaction->id;

    }

    public function getStatus($transactionId)
    {
        return Transaction::find($transactionId)->pluck('status');
    }
}
