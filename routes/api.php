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
//Route::post('/get-wash-crush-batch', 'API\WashCrushService@getWashCrushBatchData'); //Rubiyat
Route::post('/get-wash-crush-batch', 'API\WashCrushService@getWashCrushBatchDataNew'); //Azharul

Route::post('/wash-crush-crude-salt-stock', 'API\WashCrushService@getCrudeSaltStock'); //Rubiyat
//Route::post('/post-iodize-data','API\ServiceIodizeController@getIodizeBatchData');//jalal
Route::post('/post-iodize-data','API\ServiceIodizeController@getIodizeBatchDataNew');//Azharul
//Route::post('/wash-crush-stock', 'API\ServiceIodizeController@getWashCrushStock'); //Rubiyat
Route::post('/wash-crush-stock', 'API\ServiceIodizeController@getWashCrushStockNew'); //Azharul
Route::post('/chemical-stock', 'API\ServiceIodizeController@getChemicalStock'); //Rubiyat
Route::post('/store-iodize-data','API\ServiceIodizeController@storeIodizeData');//jalal
Route::post('/store-wash-crush-data','API\WashCrushService@storeWashCrashData');//jalal
//Route::post('user-login-production-sale', 'API\ProductionAndSaleController@userLogin');//jalal
Route::post('user-login-production-sale', 'API\ProductionAndSaleController@userLoginNew');//Azharul



