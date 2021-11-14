<?php

namespace App\Params;

class UserAuctionParam
{
    /**
     * @var int|null $userId
     */
    public $userId = null;

    public $auctionIds = -1;

    /**
     * @var bool $isComplete
     */
    public $isComplete = false;

    /**
     * @var bool $isWinner
     */
    public $isWinner = false;
}
