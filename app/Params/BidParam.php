<?php

namespace App\Params;

use App\Models\Auction;
use App\Models\User;

class BidParam
{
    /**
     * @var double $amount
     */
    public $amount = 0.0;

    /**
     * @var Auction $auction
     */
    public $auction = null;

    /**
     * @var User $user
     */
    public $user = null;
}
