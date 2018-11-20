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

    Route::get('/websites', 'WebsitesController@index');

    Route::post('/logout', 'AuthController@logout');
});

// implement /users/{user} on all routes

// Website Routes

Route::post('/websites', 'WebsitesController@store');

Route::patch('/websites/{website}', 'WebsitesController@update');

Route::delete('/websites/{website}', 'WebsitesController@destroy');

// Uptime Routes
Route::get('/websites/{website}/uptimes', 'UptimesController@index');

Route::post('/websites/{website}/uptimes', 'UptimesController@store');

Route::patch('/websites/{website}/uptimes/{uptime}', 'UptimesController@update');

// Url Routes
Route::get('/websites/{website}/urls', 'UrlsController@index');

Route::post('/websites/{website}/urls', 'UrlsController@store');

Route::patch('/websites/{website}/urls/{url}', 'UrlsController@update');

// Loadspeed Routes
Route::get('/websites/{website}/urls/{url}/loadtimes', 'LoadtimesController@index');

Route::post('/websites/{website}/urls/{url}/loadtimes', 'LoadtimesController@store');

// Authentification

Route::post('/register', 'AuthController@register');