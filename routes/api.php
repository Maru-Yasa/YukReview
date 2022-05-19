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

Route::get('/reload_captcha', 'App\Http\Controllers\CaptchaController@reloadCaptcha')->name('reloadCaptcha');

Route::get('/', function(){

    return "hello";

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/usergetdatax', 'App\Http\Controllers\UserController@getDataX')->name('userGetDataX');
Route::get('/movegetdatax', 'App\Http\Controllers\MovieController@getDataX')->name('movieGetDataX');

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

Route::group(['prefix' => 'movie'], function(){

    Route::get('/getbyid', 'App\Http\Controllers\Api\MovieController@getById');
    Route::get('/all', 'App\Http\Controllers\Api\MovieController@getAll');

    Route::group(['middleware' => 'auth:sanctum'], function(){
        Route::post('/create', 'App\Http\Controllers\Api\MovieController@create');
        Route::post('/update', 'App\Http\Controllers\Api\MovieController@update');
        Route::post('/delete', 'App\Http\Controllers\Api\MovieController@delete');
    });

});

Route::group(['prefix' => 'actor'], function(){

    Route::get('/getbyid', 'App\Http\Controllers\Api\ActorController@getById');
    Route::get('/all', 'App\Http\Controllers\Api\ActorController@getAll');

    Route::group(['middleware' => 'auth:sanctum'], function(){
        Route::post('/create', 'App\Http\Controllers\Api\ActorController@create');
        Route::post('/update', 'App\Http\Controllers\Api\ActorController@update');
        Route::post('/delete', 'App\Http\Controllers\Api\ActorController@delete');
    });

});

Route::group(['prefix' => 'review'], function(){

    Route::get('/getbyid', 'App\Http\Controllers\Api\ReviewController@getById');
    Route::get('/all', 'App\Http\Controllers\Api\ReviewController@getAll');

    Route::group(['middleware' => 'auth:sanctum'], function(){
        Route::post('/create', 'App\Http\Controllers\Api\ReviewController@create');
        Route::post('/update', 'App\Http\Controllers\Api\ReviewController@update');
        Route::post('/delete', 'App\Http\Controllers\Api\ReviewController@delete');
    });

});