<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Params\UserAuctionParam;
use App\Services\AuctionService;
use App\Models\UserData;
use App\Services\WinService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserApiController extends Controller
{
    public function get(){
        return User::query()
            ->with('userData')
            ->get();
    }

    public function getById($userId): array
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

    public function getTransactionsByUserId($userId){
        $transactions = Transaction::query()
            ->where('user_id', '=', $userId)
            ->get();

        foreach($transactions->whereNotNull('package_id') as $transaction){
            $response = Http::get("http://biditdelivery.herokuapp.com/api/delivery/package/{$transaction->package_id}/status");
            if($response->object()->deliveryStatus) {
                $transaction->status = $response->object()->deliveryStatus;
                $transaction->save();
            }
        }

        return $transactions;
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

    public function getAddressFormData($userId)
    {
        try{
            $userData = UserData::where('user_id', '=', $userId)->first();
            $userEmail = User::where('id', '=', $userId)->first()->email;
        }catch(\Exception $e){
            return null;
        }

        return array_merge($userData->toArray(), ['email' => $userEmail]);
    }

    public function setAddressFormData(Request $request): bool
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'address' => 'required',
            'address2' => '',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
        ]);

        if(!$validated) return false;

        $userData = new UserData();
        $userData->fill($validated);
        $userData->save();

        return true;
    }
}
