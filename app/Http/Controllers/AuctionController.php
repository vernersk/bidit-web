<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Services\AuctionService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    private $auctionService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->auctionService = new AuctionService();
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(): Renderable
    {
        return view('home', ['auctions' => $this->auctionService->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @return Renderable
     */
    public function show(Auction $auction)
    {
        $bids = $auction
            ->bids()
            ->join('users', 'users.id', '=', 'bids.user_id')
            ->select('users.name', 'bids.amount')
            ->orderBy('amount', 'DESC')
            ->limit(6)
            ->get();

        $orderedBids = [];
        $count = count($bids);
        for($i = 0; $i < $count; $i++){
            $orderedBids[$i] = $bids[($count-1)-$i];
        }

        $highestBid = $bids[0] ?? 0;

        $data = [
            'auction' => $auction,
            'bids' => $orderedBids,
            'highestBid' => $highestBid,
        ];

        return view('product')
            ->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function edit(Auction $auction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auction $auction)
    {
        $auctionService = new AuctionService();
        $auctionService->complete($auction->id, auth()->id());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auction $auction)
    {
        //
    }
}
