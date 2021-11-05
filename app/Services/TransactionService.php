<?php

namespace App\Services;

use App\Models\Auction;
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
            $auction->transaction()->associate($transaction);
            $highestBidder = $auctionService->getAuctionHighestBid($auction);
            $total += $highestBidder->amount;
        }

        $transaction->total = $par->total ?? $total;
        $transaction->save();
    }

    public function setStatus($transactionId, $status)
    {
        if(!in_array($status, Transaction::STATUSES)) return;
        $transaction = Transaction::find($transactionId);
        $transaction->status = $status;
        $transaction->save();
    }

    public function getStatus($transactionId)
    {
        return Transaction::find($transactionId)->pluck('status');
    }
}
