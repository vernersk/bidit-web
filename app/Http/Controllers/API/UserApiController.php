<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\WinService;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function get(){
        return User::all();
    }

    public function getById($userId)
    {
        return User::query()
            ->where('id', '=', $userId)
            ->firstOrFail();
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
