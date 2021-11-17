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
     * Display the specified resource.
     * @return Renderable
     */
    public function show(Auction $auction)
    {
        $data = $this->auctionService->getTopById($auction->id);

        return view('product')
            ->with('data', $data);
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
        $this->auctionService->complete($auction->id, auth()->id());
    }

    public function complete(Request $request)
    {
        $this->auctionService->complete((int)$request->auctionId, auth()->id());

        return redirect()->back();
    }
}
