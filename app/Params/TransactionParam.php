<?php

namespace App\Params;

use App\Models\Auction;

class TransactionParam
{
    /**
     * @var double $total
     */
    public $total = 0.0;

    /**
     * @var double $shipping
     */
    public $shipping = 2.99;

    /**
     * @var int $userId
     */
    public $userId = null;

    /**
     * @var Auction[] $auctions
     */
    public $auctions = null;

    /**
     * @var UserDataParam $userData
     */
    public $userData = null;
}
