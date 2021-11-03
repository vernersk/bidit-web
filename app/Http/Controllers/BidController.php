<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Params\UserAuctionParam;
use App\Services\AuctionService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BidController extends Controller
{
    private $auctionService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->auctionService = new AuctionService();
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

        $data = $this->auctionService->getUserBidAuctions($par);

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
        $auctionService = new AuctionService();
        $auction = $auctionService->getAuctionById((int)$request->input('auctionId'));
        $highestBid = $auction->bids()->orderBy('amount', 'DESC')->first();

        $userBid = $request->input('bid');

        if($highestBid->user != auth()->user()){
            if(!isset($highestBid->amount) || $userBid > ceil($highestBid->amount)) {
                $bid = new Bid();
                $bid->auction_id = $auctionId;
                $bid->user_id = (int)auth()->id();
                $bid->amount = (double)$request->input('bid');
                $bid->save();
            }
        }

        return redirect()->route('auction.show', ['auction' => $auction]);
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
