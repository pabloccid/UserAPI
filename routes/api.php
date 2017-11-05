<?php

use Illuminate\Http\Request;
use App\User;

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


 

 
Route::get('users/{user}', 'UserController@show');

Route::post('users/{user}/image', 'UserController@storeImage');

Route::put('users/{user}', 'UserController@update');

Route::delete('users/{user}', 'UserController@delete');