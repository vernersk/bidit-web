<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Params\TransactionParam;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * @var TransactionService
     */
    private $transactionService;

    public function __construct()
    {
        $this->transactionService = new TransactionService();
    }


    public function create(Request $request)
    {
        $par = new TransactionParam();
        $par->userId = $request->userId;
        $par->auctions = Auction::find($request->auctionIds);
        $this->transactionService->store($par);
        return true;
    }
}
