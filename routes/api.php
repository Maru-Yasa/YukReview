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

Route::get('/', function(){

    return "hello";

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'auth'], function(){

    Route::post('/login', 'App\Http\Controllers\Api\AuthController@login');
    Route::post('/register', 'App\Http\Controllers\Api\AuthController@register');

    Route::group(['middleware' => 'auth:sanctum'], function(){
        Route::post('/me', 'App\Http\Controllers\Api\AuthController@getUser');
        Route::post('/logout', 'App\Http\Controllers\Api\AuthController@logout');
        Route::post('/update', 'App\Http\Controllers\Api\AuthController@update');
        Route::post('/reset_password', 'App\Http\Controllers\Api\AuthController@resetPassword');
    });

});