<?php

namespace App\Params;

class UserAuctionParam
{
    /**
     * @var int|null $userId
     */
    public $userId = null;

    /**
     * @var bool $isComplete
     */
    public $isComplete = false;

    /**
     * @var bool $isWinner
     */
    public $isWinner = false;

    public function getRpc(){
        return [
            'userId' => $this->userId,
            ''
        ];
    }
}
