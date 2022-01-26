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

Route::middleware('auth:api')->get('/user', function (Request $request) { return $request->user(); });
Route::delete('runtime/{id}', 'DataController@delete');
Route::get('ajax','finance\ajax@index')->name('ajax');
Route::get('runtime/{id_feasibility}', 'DataController@runtime');
Route::get('update/{id}', 'DataController@updateView');
Route::get('updatejeniss/{id_jenis}','DataController@updatejenis');
Route::get('getjenis/{id_jenis}', 'DataController@getjenis');
// Route::post('add','DataController@add');
// Route::put('update','DataController@update');
// Route::get('pkp','DataController@index')->name('pkp');
// Route::get('for','DataController@for')->name('for');