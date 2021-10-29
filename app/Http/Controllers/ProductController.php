<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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
    public function index(): Renderable
    {
        $products = Product::all();
        foreach($products as $product){
            $product->highestBid = $product
                ->bids()
                ->orderBy('amount', 'DESC')
                ->first();
        }

        return view('home', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Renderable
     */
    public function show(Product $product): Renderable
    {
        $bids = $product->bids()
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

        return view('product')->with('product', $product)->with('bids', $orderedBids);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return void
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return void
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return void
     */
    public function destroy(Product $product)
    {
        //
    }
}
