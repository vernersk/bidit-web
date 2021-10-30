<?php

namespace App\Http\Controllers;

use App\Models\Win;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class WinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('user-wins');
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
     *
     * @param  \App\Models\Win  $win
     * @return \Illuminate\Http\Response
     */
    public function show(Win $win)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Win  $win
     * @return \Illuminate\Http\Response
     */
    public function edit(Win $win)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Win  $win
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Win $win)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Win  $win
     * @return \Illuminate\Http\Response
     */
    public function destroy(Win $win)
    {
        //
    }
}
