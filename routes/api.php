<?php

use Illuminate\Http\Request;

session_start();

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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('/get-monitor-data', 'API\ServiceController@getMonitorData');
Route::post('user-login', 'API\ServiceController@userLogin');
Route::post('/get-wash-crush-batch', 'API\WashCrushService@getWashCrushBatchData');

