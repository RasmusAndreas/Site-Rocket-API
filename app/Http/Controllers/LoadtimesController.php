<?php

namespace App\Http\Controllers;

use App\Loadtime;
use App\Url;
use App\Website;
use Illuminate\Http\Request;

class LoadtimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Website $website, Url $url)
    {
        if ($website->user_id !== auth()->user()->id || $website->id !== $url->websiteID) {
            return response()->json('Unauthorized', 401);
        }

        return Loadtime::where('urlID', $url->id)->get();
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loadtime  $loadtime
     * @return \Illuminate\Http\Response
     */
    public function show(Loadtime $loadtime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Loadtime  $loadtime
     * @return \Illuminate\Http\Response
     */
    public function edit(Loadtime $loadtime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Loadtime  $loadtime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loadtime $loadtime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Loadtime  $loadtime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loadtime $loadtime)
    {
        //
    }
}
