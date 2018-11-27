<?php

namespace App\Http\Controllers;

use App\Loadtime;
use App\Url;
use App\Website;
use App\User;
use App\Uptime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function load (Request $request, Website $website, User $user, Url $url, $apikey, $time) {
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

    public function seo (Request $request, Website $website, User $user, Url $url, $apikey) {
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
                $urlfrom[0]->update($data);
        
                return response($urlfrom[0], 201);
            }
        }     
    }

    public function uptime (Request $request, Website $website) {
        $this->client = DB::table('oauth_clients')->where('id', 2)->first();
        //return response()->json($this->client->secret, 200);

        if ($request->client_secret !== $this->client->secret) {
            return response()->json('The id does not match', 400);
        } else {
            $settings = $this->getSettings($website);
            if ($settings['uptime'] == 1) {
                $uptime = Uptime::create([
                    'statusCode' => $request->statusCode,
                    'websiteID' => $website->id,
                    ]);
                return response($uptime, 201);
            } else {
                return response()->json('The setting is not activated', 400);
            }
        }
    }

    public function geturls (Request $request, Website $website) {
        $this->client = DB::table('oauth_clients')->where('id', 2)->first();
        //return response()->json($this->client->secret, 200);

        if ($request->client_secret !== $this->client->secret) {
            return response()->json('The id does not match', 400);
        } else {
            return Website::get();
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
}
