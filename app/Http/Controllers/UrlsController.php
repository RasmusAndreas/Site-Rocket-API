<?php

namespace App\Http\Controllers;

use App\Url;
use App\Website;
use Illuminate\Http\Request;

class UrlsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Website $website)
    {
        return Url::where('websiteID', $website->id)->get();
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
            'url' => 'required|string',
            'htmlToText' => 'required|between:0,100.00',
            'wordCount' => 'required|integer',
            'metaDescription' => 'required|integer',
            'altText' => 'required|integer',
            'title' => 'required|integer',
            'h1' => 'required|integer',
            'h2' => 'required|integer',
            'h3' => 'required|integer',
            'h4' => 'required|integer',
            'h5' => 'required|integer',
            'h6' => 'required|integer',
            'websiteID' => 'required|integer',

        ]);

        $url = Url::create($data);

        return response($url, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function show(Url $url)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function edit(Url $url)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Website $website, Url $url)
    {
        $data = $request->validate([
            'htmlToText' => 'required|between:0,100.00',
            'wordCount' => 'required|integer',
            'metaDescription' => 'required|integer',
            'altText' => 'required|integer',
            'title' => 'required|integer',
            'h1' => 'required|integer',
            'h2' => 'required|integer',
            'h3' => 'required|integer',
            'h4' => 'required|integer',
            'h5' => 'required|integer',
            'h6' => 'required|integer',

        ]);

        $url->update($data);

        return response($url, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
        //
    }
}
