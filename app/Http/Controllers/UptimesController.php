<?php

namespace App\Http\Controllers;

use App\Uptime;
use App\Website;
use Illuminate\Http\Request;

class UptimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Website $website)
    {   
        if ($website->user_id !== auth()->user()->id) {
            return response()->json('Unauthorized', 401);
        }

        return Uptime::where('websiteID', $website->id)->get();
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
    public function store(Request $request, Website $website)
    {   
        if ($website->user_id !== auth()->user()->id) {
            return response()->json('Unauthorized', 401);
        }

        $data = $request->validate([
            'statusCode' => 'required|integer',
        ]);

        $uptime = Uptime::create([
            'statusCode' => $request->statusCode,
            'websiteID' => $website->id,
        ]);

        return response($uptime, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Uptime  $uptime
     * @return \Illuminate\Http\Response
     */
    public function show(Uptime $uptime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Uptime  $uptime
     * @return \Illuminate\Http\Response
     */
    public function edit(Uptime $uptime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Uptime  $uptime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Website $website, Uptime $uptime)
    {   
        if ($website->user_id !== auth()->user()->id || $website->id !== $uptime->websiteID) {
            return response()->json('Unauthorized', 401);
        }

        $data = $request->validate([
            'excludeDowntime' => 'required|boolean',
        ]);

        $uptime->update($data);

        return response($uptime, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Uptime  $uptime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Uptime $uptime)
    {
        //
    }
}
