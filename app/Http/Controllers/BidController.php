<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }


    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->query()->where('id', $request->input('productId'))->first();


        $highestBid = $product
            ->bids()
            ->orderBy('amount', 'DESC')
            ->first();

        if($request->input('bid') > $highestBid){
            $bid = new Bid();
            $bid->product_id = $request->input('productId');
            $bid->user_id = Auth::id();
            $bid->amount = $request->input('bid');
            $bid->save();
        }

        return redirect('product.show', $request->input('productId'));
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
