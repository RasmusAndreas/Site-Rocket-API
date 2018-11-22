<?php

namespace App\Http\Controllers;

use App\Website;
use Illuminate\Http\Request;

class WebsitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Website::where('user_id', auth()->user()->id)->get();
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
        $data = $request->validate([
            'websiteName' => 'required|string',
            'domain' => 'required|string',
            'featureSettings' => 'required|string',
            'reportLink' => 'required|string',
        ]);

        $website = Website::create([
            'websiteName' => $request->websiteName,
            'domain' => $request->domain,
            'featureSettings' => $request->featureSettings,
            'reportLink' => $request->reportLink,
            'user_id' => auth()->user()->id,
        ]);

        return response($website, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function show(Website $website)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function edit(Website $website)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Website $website)
    {
        if ($website->user_id !== auth()->user()->id) {
            return response()->json('Unauthorized', 401);
        }

        $data = $request->validate([
            'websiteName' => 'required|string',
            'domain' => 'required|string',
            'featureSettings' => 'required|string',
            'reportLink' => 'required|string',
        ]);

        $website->update($data);

        return response($website, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function destroy(Website $website)
    {
        if ($website->user_id !== auth()->user()->id) {
            return response()->json('Unauthorized', 401);
        }

        $website->delete();

        return response('Website deleted successfully', 200);
    }
}
