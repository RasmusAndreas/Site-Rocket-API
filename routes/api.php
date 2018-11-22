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

    // Uptime Routes CRU
    Route::get('/websites/{website}/uptimes', 'UptimesController@index');
    Route::post('/websites/{website}/uptimes', 'UptimesController@store');
    Route::patch('/websites/{website}/uptimes/{uptime}', 'UptimesController@update');

    // Url Routes CRU
    Route::get('/websites/{website}/urls', 'UrlsController@index');
    Route::post('/websites/{website}/urls', 'UrlsController@store');
    Route::patch('/websites/{website}/urls/{url}', 'UrlsController@update');

    // Loadspeed Routes CR
    Route::get('/websites/{website}/urls/{url}/loadtimes', 'LoadtimesController@index');
    Route::post('/websites/{website}/urls/{url}/loadtimes', 'LoadtimesController@store');

    // Authentification
    Route::post('/logout', 'AuthController@logout');
});

// Authentification
Route::post('/register', 'AuthController@register');

Route::post('/scripts/load/{website}/{apikey}/{time}', 'TrackingController@load');
Route::post('/scripts/seo/{website}/{apikey}', 'TrackingController@seo');
Route::post('/scripts/uptime/{website}', 'TrackingController@uptime');