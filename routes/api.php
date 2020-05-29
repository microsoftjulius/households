<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/save-household','HouseHoldController@createHouseHold');
Route::get('/display-household','HouseHoldController@displayHouseHold');
Route::delete('/update-household/{id}','HouseHoldController@updateToBought');
Route::delete('/mark-as-bought/{id}','HouseHoldController@markAsNotBought');
Route::delete('/delete-permanently/{id}','HouseHoldController@deleteHouseholdPermanently');
Route::get('/display-particular-household/{id}','HouseHoldController@displayParticularHousehold');