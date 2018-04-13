<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','PostsController@index');
Route::resource('discussions','PostsController');
Route::resource('comment','CommentsController');

Route::get('verify/{confirm_code}','UserController@confirmedEmail');
Route::get('user/register','UserController@register');
Route::post('user/register','UserController@store');
Route::get('user/avatar','UserController@avatar');
Route::post('user/avatar','UserController@changeAvatar');
Route::get('/user/login','UserController@login');
Route::post('/user/login','UserController@signup');
Route::get('user/showAvatar','UserController@showAvatar');
Route::post('user/crop','UserController@cropAvatar');
Route::post('post/upload','PostsController@upload');
Route::get('user/password','UserController@password');

Route::get('/user/logout','UserController@logout');