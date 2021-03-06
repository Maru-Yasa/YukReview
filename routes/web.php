<?php

use App\Http\Controllers\GoogleController;
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
Route::get('/','App\Http\Controllers\WelcomeController@index');
Route::get('/movies','App\Http\Controllers\WelcomeController@allMoviesView');
Route::get('/scrap','App\Http\Controllers\ScrapperController@findBy');
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google_login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/detail/{id}', 'App\Http\Controllers\WelcomeController@detail')->name('movieDetail');
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){


   
    Route::post('/updateProfile', 'App\Http\Controllers\UserController@update')->name('updateProfile');

    Route::group(['middleware' => 'admin'], function(){
        Route::post('/updateuser', 'App\Http\Controllers\UserController@updateById')->name('updateUser');
        Route::get('/users', 'App\Http\Controllers\UserController@view')->name('usersView');
        Route::get('/user/edit', 'App\Http\Controllers\UserController@editById')->name('userEdit');
        Route::get('/user/delete', 'App\Http\Controllers\UserController@delete')->name('userDelete');
        Route::get('/user/export', 'App\Http\Controllers\UserController@export')->name('userExport');

        Route::group(['prefix' => 'movies'], function(){ 
            Route::get('/', 'App\Http\Controllers\MovieController@view');
            Route::get('/add', 'App\Http\Controllers\MovieController@createView');
            Route::post('/add', 'App\Http\Controllers\MovieController@create')->name('movieAdd');
            Route::get('/update', 'App\Http\Controllers\MovieController@updateView');
            Route::post('/update', 'App\Http\Controllers\MovieController@update')->name('movieUpdate');
            Route::get('/delete', 'App\Http\Controllers\MovieController@delete')->name('deleteMovie');
       
        });

    });

});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::post('/review/add', 'App\Http\Controllers\ReviewController@create')->name('createReview');
});