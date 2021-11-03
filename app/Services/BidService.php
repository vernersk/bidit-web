<?php

namespace App\Services;

use App\Models\Bid;

class BidService
{
    public function getUserBids(int $userId)
    {
        return Bid::query()
            ->where('user_id',  '=', $userId)
            ->get();
    }
}
