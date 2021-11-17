<?php

namespace App\Http\Controllers;

use App\Services\WinService;
use Illuminate\Http\Request;

class WinController extends Controller
{
    /**
     * @var WinService
     */
    private $service;

    public function __construct()
    {
        $this->service = new WinService();
    }

    public function index(Request $request)
    {
        $auctionIds = (bool)$request->get('isCart') ? $request->get('auctionIds') : -1;

        return $this->service->getUserWins($request->get('userId') ?? null, $auctionIds);
    }
}
