<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\User;
use App\Params\UserAuctionParam;
use App\Services\AuctionService;
use Illuminate\Http\Request;
use App\Models\UserData;
use App\Services\WinService;

class UserApiController extends Controller
{
    public function get(){
        return User::query()
            ->with('userData')
            ->get();
    }

    public function getById($userId)
    {
        $user = User::query()
            ->where('id', '=', $userId)
            ->firstOrFail();

        return [
            'user' => $user,
            'userData' => UserData::query()->where('user_id', '=', $userId)->first(),
        ];
    }

    public function getWonAuctions($userId): array
    {
        $service = new WinService();
        return $service->getUserWins($userId);
    }

    public function getAuctionsUserBidOn($userId): array
    {
        $par = new UserAuctionParam();
        $par->userId = $userId;
        $par->isWinner = false;
        $par->isComplete = false;

        $auctionService = new AuctionService();

        return $auctionService->getAuctionsUserBidOn($par);
    }

}
