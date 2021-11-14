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


    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $auctionId = (int)$request->input('auctionId');
        $bid = (double)$request->input('bid');
        $auctionService = new AuctionService();

        $par = new BidParam();
        $par->amount = $bid;
        $par->auction = $auctionService->getAuctionById($auctionId);

        $this->bidService->create($par);

        return redirect()->route('auction.show', ['auction' => $par->auction]);
    }

    /**
     * Display the specified resource.
     *
     * @param Bid $bid
     * @return void
     */
    public function show(Bid $bid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Bid $bid
     * @return void
     */
    public function edit(Bid $bid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Bid $bid
     * @return void
     */
    public function update(Request $request, Bid $bid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bid $bid
     * @return void
     */
    public function destroy(Bid $bid)
    {
        //
    }
}
