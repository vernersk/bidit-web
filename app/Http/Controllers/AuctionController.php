<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(): Renderable
    {
        $auctions = Auction::all();

        foreach($auctions as $auction){
            $bid = $auction->bids()
                ->orderBy('amount', 'DESC')
                ->first();

            if(isset($bid->amount)){
                $auction->highestBid = $bid;
                $user = User::where('id', $bid->user_id)->first();
                $auction->highestBid->user = $user->name;
            }


        }
        var_dump($auctions[1]->product->name);
        return view('home', ['auctions' => $auctions]);
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

        return view('product')
            ->with('auction', $auction)
            ->with('bids', $orderedBids)
            ->with('highestBid', $highestBid);
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
        //
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
