<?php

namespace App\Params;

use App\Models\Bid;
use App\Models\Product;

class AuctionParam
{
    /**
     * @var int $auctionId
     */
    public $auctionId = null;

    /**
     * @var int $winnerId
     */
    public $winnerId = null;

    /**
     * @var Bid[]|null $bids
     */
    public $bids = null;

    /**
     * @var Bid|null $highestBid
     */
    public $highestBid = null;

    /**
     * @var Product $product
     */
    public $product = null;
}
