<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/save-household','HouseHoldController@createHouseHold');
Route::get('/display-household','HouseHoldController@displayHouseHold');
Route::delete('/update-household/{id}','HouseHoldController@updateToBought');
Route::delete('/mark-as-bought/{id}','HouseHoldController@markAsNotBought');
Route::delete('/delete-permanently/{id}','HouseHoldController@deleteHouseholdPermanently');
Route::get('/display-particular-household/{id}','HouseHoldController@displayParticularHousehold');
