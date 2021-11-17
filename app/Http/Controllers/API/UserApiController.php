<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserData;
use App\Services\WinService;
use Illuminate\Http\Request;

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

    public function getAdditionalInfo()
    {

    }
}
