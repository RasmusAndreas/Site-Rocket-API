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

    public function sendMail(Request $request, Website $website) {
        if ($website->user_id !== auth()->user()->id) {
            return response()->json('Unauthorized', 401);
        }
        // get report link and send it to the mail that was input
        $websiteToSend = Website::where('id', $website->id)->get();

        $to      = $request->mail;
        $subject = 'Report link from SiteRocket';
        $message = "
            <!DOCTYPE html>
            <html lang='en' dir='ltr'>
                <head>
                    <meta charset='utf-8'>
                    <title></title>
                </head>
                <body bgcolor='#cecece' style='backround-color: #cecece;'>
                    <center>
                        <table bgcolor='#cecece' width='100%' height='100%'>
                            <tr style='height: 60px;'>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <center>
                                    <table cellspacing='0' width='100%' style='max-width: 540px; font-family: Arial, Helvetica, sans-serif;'>
                                        <tr bgcolor='#5D7A82' height='120px'>
                                            <td width='20%'></td>
                                            <td width='60%'><img src='http://assets.sovid.dk/siterocket_logo.png'></td>
                                            <td width='20%'></td>
                                        </tr>
                                        <tr bgcolor='#ffffff' style='backround-color: #ffffff; height: 60px;'>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr bgcolor='#ffffff' style='backround-color: #ffffff;'>
                                            <td></td>
                                            <td>Hello<br><br>You have received a link to the report regarding your site: " 
                                            . $websiteToSend[0]->websiteName . 
                                            "<br> The link to your report is: " 
                                            . $websiteToSend[0]->reportLink . 
                                            "</td>
                                            <td></td>
                                        </tr>
                                        <tr bgcolor='#ffffff' style='backround-color: #ffffff; height: 60px;'>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr bgcolor='#ffffff'>
                                            <td></td>
                                            <td>Best regards<br><br>The SiteRocket team</td>
                                            <td></td>
                                        </tr>
                                        <tr bgcolor='#ffffff' style='height: 60px;'>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </center>
                            </tr>
                            <tr style='height: 60px;'>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </center>
                </body>
            </html>";                
        $headers = 'From: Team SiteRocket <r@rasmusandreas.dk>' . "\r\n" .
            'Reply-To: noreply@rasmusandreas.dk' . "\r\n" .
            'X-Mailer: PHP/' . phpversion() . "\r\n" .
            "MIME-Version: 1.0" . "\r\n" .
            "Content-Type: text/html; charset=ISO-8859-1" . "\r\n";

        mail($to, $subject, $message, $headers);

        return response()->json("Link was sent to $request->mail", 200);
    }
}
