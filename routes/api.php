<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Website Routes CRUD
    Route::get('/websites', 'WebsitesController@index');
    Route::post('/websites', 'WebsitesController@store');
    Route::patch('/websites/{website}', 'WebsitesController@update');
    Route::delete('/websites/{website}', 'WebsitesController@destroy');

    // Uptime Routes RU
    Route::get('/websites/{website}/uptimes', 'UptimesController@index');
    Route::patch('/websites/{website}/uptimes/{uptime}', 'UptimesController@update');

    // Url Routes RU
    Route::get('/websites/{website}/urls', 'UrlsController@index');
    Route::patch('/websites/{website}/urls/{url}', 'UrlsController@update');

    // Loadspeed Routes R
    Route::get('/websites/{website}/urls/{url}/loadtimes', 'LoadtimesController@index');

    // Authentification
    Route::post('/logout', 'AuthController@logout');
});

// Authentification
Route::post('/register', 'AuthController@register');

// Tracking Routes
// Combine load and seo endpoints
//Route::post('/scripts/load/{website}/{apikey}/{time}', 'TrackingController@load');
Route::post('/scripts/seo/{website}/{apikey}/{time}', 'TrackingController@seo');
Route::post('/scripts/uptime/{website}', 'TrackingController@uptime');
Route::post('/scripts/geturls', 'TrackingController@geturls');
Route::post('/scripts/deleteOldLoadtimes', 'TrackingController@deleteLoadtimes');