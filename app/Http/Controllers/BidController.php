<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Params\BidParam;
use App\Params\UserAuctionParam;
use App\Services\AuctionService;
use App\Services\BidService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BidController extends Controller
{
    /**
     * @var BidService
     */
    private $bidService;

    /**
     * @var AuctionService
     */
    private $auctionService;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->auctionService = new AuctionService();
        $this->bidService = new BidService();
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        $par = new UserAuctionParam;
        $par->userId = auth()->id();
        $par->isComplete = false;

        $data = $this->auctionService->getAuctionsUserBidOn($par);

        return view('user-bids', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $auctionId = $request->input('auctionId');
        $bid = (double)$request->input('bid');
        $auctionService = new AuctionService();

        $par = new BidParam();
        $par->amount = $bid;
        $par->auction = $auctionService->getAuctionById($auctionId);

        $this->bidService->create($par);

        return redirect()->route('auction.show', ['auction' => $par->auction]);
    }
}
