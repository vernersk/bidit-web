<?php

namespace App\Http\Controllers;

use App\Models\Win;
use App\Services\WinService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WinController extends Controller
{
    /**
     * @var WinService
     */
    private $service;

    public function __construct()
    {
        $this->service = new WinService();
    }

    public function index(Request $request)
    {
        $auctionIds = (bool)$request->get('isCart') ? $request->get('auctionIds') : -1;

        return $this->service->getUserWins($auctionIds);
    }

    public function get(){

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param Win $win
     * @return Response
     */
    public function show(Win $win)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Win $win
     * @return Response
     */
    public function edit(Win $win)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Win $win)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Win $win
     * @return Response
     */
    public function destroy(Win $win)
    {
        //
    }
}
