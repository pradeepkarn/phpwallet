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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('api')->group(function () {
    Route::get('api/get_currency', 'Api\ApiController@index')->name('api.get_currency');
});

Route::middleware('api')->group(function () {
    
    //sendMoney
    Route::get('/get_currency/{id}', 'Api\ApiController@index')->name('get_currency');
    Route::post('/send_money', 'Api\ApiController@postRequest')->name('send_money');

    //Registerition
    Route::get('/get_country', 'Api\ApiController@getCountry')->name('get_country');
    Route::post('/register', 'Api\ApiController@register')->name('register');

//exchange_currency//
    Route::post('/exchange_currency/{id}', 'Api\ApiController@exchange_currency')->name('exchange_currency');

    //virtual card
    Route::post('/virtual_card/{id}', 'Api\ApiController@virtual_card')->name('virtual_card');

    //request money
    Route::post('/request_money/{id}', 'Api\ApiController@request_money')->name('request_money');

});

