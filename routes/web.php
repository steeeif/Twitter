<?php

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
Route::get('status/{id}', 'ProfileController@status');
Route::put('status/{id}', 'ProfileController@update');
Route::get('viewprofile/{id}', 'ProfileController@index');
Route::get('profile/{id}', 'ProfileController@show');
Route::get('users', 'FollowController@index');
Route::get('user/{id}', 'FollowController@show');
Route::get('tweet', 'TweetController@index');
Route::get('tweet/{id}', 'TweetController@show');
Route::post('tweet', 'TweetController@store');

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
