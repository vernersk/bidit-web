<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
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
     * @return Renderable
     */
    public function index()
    {
        $bids = Bid::query()
            ->where('user_id',  '=', auth()->id())
            ->get();

        $data = [];
        $products = [];
        foreach($bids as $bid){
            if(in_array($bid->auction->product, $products)) continue;

            $products[] = $bid->auction->product;
            $highestBid = $bid->auction
                ->bids()
                ->join('users', 'users.id', '=', 'bids.user_id')
                ->select(['users.id as userId', 'users.name', 'bids.amount'])
                ->orderBy('amount', 'DESC')
                ->first();

            $data[] = [
                'userBid' => $bid,
                'highestBid' => $highestBid->amount ? $highestBid : 0,
                'auction' => $bid->auction,
                'isUserHighestBidder' => $highestBid->userId == auth()->id(),
            ];
        }

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
        $auction = Auction::query()
            ->where('id', $request->input('auctionId'))
            ->first();

        $highestBid = $auction->bids()->orderBy('amount', 'DESC')->first();

        $userBid = $request->input('bid');

        if(!$highestBid->amount || $userBid > $highestBid->amount) {
            $bid = new Bid();
            $bid->auction_id = $request->input('auctionId');
            $bid->user_id = Auth::id();
            $bid->amount = $request->input('bid');
            $bid->save();
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
