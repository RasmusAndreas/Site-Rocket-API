<?php

namespace App\Http\Controllers;

use App\Loadtime;
use App\Url;
use App\Website;
use App\User;
use App\Uptime;
use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TrackingController extends Controller
{

    // check if loadtimes older than 30 days exists and delete them
    public function createLoadtime (Request $request, Website $website, User $user, Url $url, $apikey, $time) {
        // get url from db using the url from the site
        $urlfrom = Url::where('url', $request->url)->get();

        if (count($urlfrom) > 1 || count($urlfrom) === 0) {

            return response()->json('nope url', 200);

        } else {

            if ($urlfrom[0]['websiteID'] !== $website->id) {

                return response()->json('nope website', 200);

            } else {

                $websitefrom = Website::where('id', $website->id)->get();
                $userfrom = User::where('id', $websitefrom[0]['user_id'])->get();

                if ($userfrom[0]['apikey'] !== $apikey) {

                    return response()->json('nope user', 200);

                } else {
                    $settings = $this->getSettings($website);
                    if ($settings['loadtime'] == 1) {
                        // delete old records
                        // $oldloads = Loadtime::where('created_at',);
                        // save loadtime
                        $loadtime = Loadtime::create([
                            'loadtime' => $time,
                            'urlID' => $urlfrom[0]['id'],
                        ]);
                        return response($loadtime, 201);
                    } else {
                        return response()->json('Setting not activated', 200);
                    }
                }
            }
        }
    }

    public function seo (Request $request, Website $website, User $user, Url $url, $apikey, $time) {
        // get url from db using the url from the site
        $urlfrom = Url::where('url', $request->url)->get();
        if (count($urlfrom) === 0) {
            // Url does not exist
            //return response()->json('Url does not exist', 200);
            $exists = false;
            // Create url and seo data
        } else if (count($urlfrom) > 1) {
            // Too many urls exists
            //return response()->json('Too many urls exists', 200);
        } else {
            // Url exists
            //return $urlfrom;
            $exists = true;
            // Update url and seo data
        }
        $websitefrom = Website::where('id', $website->id)->get();
        $userfrom = User::where('id', $websitefrom[0]['user_id'])->get();
        if ($userfrom[0]['apikey'] !== $apikey) {

            return response()->json('nope user', 200);

        } else {
            if (!isset($exists)) {
                // Something was wrong
                return response()->json('Something was wrong', 200);
            } else if ($exists === false) {
                // check for basic errors and send notification
                $this->checkSEOcreate($request, $userfrom[0]['email'], $websitefrom[0]);
                // If url does not exists create url and seo data
                $url = Url::create([
                    'url' => $request->url,
                    'wordCount' => $request->wordCount,
                    'metaDescription' => $request->metaDescription,
                    'altText' => $request->altText,
                    'title' => $request->title,
                    'h1' => $request->h1,
                    'h2' => $request->h2,
                    'h3' => $request->h3,
                    'h4' => $request->h4,
                    'h5' => $request->h5,
                    'h6' => $request->h6,
                    'websiteID' => $website->id,
                ]);
                $this->createLoadtime($request, $website, $user, $url, $apikey, $time);
                return response($url, 201);
            } else {
                // If url exists update url and seo data
                $data = $request->validate([
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
                $this->checkSEOupdate($request, $userfrom[0]['email'], $urlfrom[0]['id'], $websitefrom[0]);
                $urlfrom[0]->update($data);
                $this->createLoadtime($request, $website, $user, $url, $apikey, $time);
                // check for basic errors and send notification
                return response($urlfrom[0], 201);
            }
        }     
    }

    public function uptime (Request $request, Website $website) {
        $this->client = DB::table('oauth_clients')->where('id', 2)->first();
        if ($request->client_secret !== $this->client->secret) {
            return response()->json('The id does not match', 400);
        } else {
            $settings = $this->getSettings($website);
            if ($settings['uptime'] == 1) {
                // send notification to the user
                $user = User::where('id', $website->user_id)->first();
                $latestUptime = Uptime::where('websiteID', $website->id)->latest()->first();
                $timenow = new \DateTime(null, new \DateTimeZone('Europe/Copenhagen'));
                $interval = $latestUptime['created_at']->diff($timenow);
                if ($interval->format('%Y-%m-%d %H:%i:%s') < "00-0-0 01:00:00") {
                    // Less than an hour ago since last mail was sent, therefor do nothing
                } else {
                    // More than an hour ago since the mail was sent, therefor send a mail
                    $to      = $user['email'];
                    $subject = 'Uptime notification from SiteRocket';
                    $message = "<!DOCTYPE html>
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
                                                <td>Hello<br><br>Your site: " 
                                                . $website['websiteName'] . 
                                                " is down right now<br><br> Visit SiteRocket to view more details
                                                </td>
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
                }
                $uptime = Uptime::create([
                   'statusCode' => $request->statusCode,
                   'websiteID' => $website->id,
                ]);
            } else {
                return response()->json('The setting is not activated', 400);
            }
        }
    }

    public function geturls (Request $request, Website $website) {
        $this->client = DB::table('oauth_clients')->where('id', 2)->first();
        //return response()->json($this->client->secret, 200);
        $websitesToPing = array();
        if ($request->client_secret !== $this->client->secret) {
            return response()->json('The id does not match', 400);
        } else {
            // check if setting activated
            $websitesgot = Website::get();
            foreach ($websitesgot as $websitegot) {
                $settings = $this->getSettings($websitegot);
                if ($settings["uptime"] == 1) {
                    array_push($websitesToPing, $websitegot);
                }
            }
            return $websitesToPing;
        }
    }

    public function getSettings(Website $website) {
        $websitefrom = Website::where('id', $website->id)->pluck('featureSettings')->all();
        $partial = explode(';', $websitefrom[0]);
        $settings = array();
        array_walk($partial, function($val,$key) use(&$settings){
            list($key, $value) = explode(':', $val);
            $settings[$key] = $value;
        });
        return $settings;
    }

    public function checkSEOupdate($request, $mail, $urlid, $website) {
        $urlfrom = Url::where('id', $urlid)->get();
        if ($request->h1 !== 1 ||
            $request->title < 50 || 
            $request->title > 70 ||
            $request->altText > 0 ||
            $request->metaDescription < 120 ||
            $request->metaDescription > 180 ||
            $request->wordCount < 300) {
                
            $timefromlastupdate = $urlfrom[0]['updated_at'];
            $timenow = new \DateTime();
            $interval = $timefromlastupdate->diff($timenow);
            if ($interval->format('%Y-%m-%d %H:%i:%s') >= "00-0-1 00:00:00") {
                $to      = $mail;
                $subject = 'Loadtime notification from SiteRocket';
                $message = "<!DOCTYPE html>
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
                              <td>Hello<br><br>You have a seo issue on your site: " 
                          . $website['websiteName'] . 
                          "<br> The problem is present on: " 
                          . $request->url . 
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
            }
            
        }
    }

    public function checkSEOcreate($request, $mail, $website) {
        if ($request->h1 !== 1 ||
            $request->title < 50 || 
            $request->title > 70 ||
            $request->altText > 0 ||
            $request->metaDescription < 120 ||
            $request->metaDescription > 180 ||
            $request->wordCount < 300) {

            $to      = $mail;
            $subject = 'Loadtime notification from SiteRocket';
            $message = "<!DOCTYPE html>
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
                              <td>Hello<br><br>You have a seo issue on your site: " 
                          . $website['websiteName'] . 
                          "<br> The problem is present on: " 
                          . $request->url . 
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
        }
    }

    public function deleteLoadtimes() {
        if ($request->client_secret !== $this->client->secret) {
            return response()->json('The id does not match', 400);
        } else {
            $loadtimes = Loadtime::get();
            foreach ($loadtimes as $loadt) {
                $timenow = new \DateTime();
                $interval = $loadt["created_at"]->diff($timenow);
                if ($interval->format('%Y-%m-%d %H:%i:%s') >= "00-1-0 00:00:01") {
                    $loadt->delete();
                }
            }
        }
    }
}
