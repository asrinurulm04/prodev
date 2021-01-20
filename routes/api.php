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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('ajax','finance\ajax@index')->name('ajax');

Route::get('runtime/{id_feasibility}', 'DataController@runtime');

Route::delete('runtime/{id}', 'DataController@delete');

Route::get('update/{id}', 'DataController@updateView');

Route::get('updatejeniss/{id_jenis}','DataController@updatejenis');
Route::get('getjenis/{id_jenis}', 'DataController@getjenis');

//ApiController
Route::get('pkp','DataController@index')->name('pkp');
Route::get('for','DataController@for')->name('for');