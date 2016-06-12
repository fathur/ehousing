<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('test', function(){
   return \Hunian::with('referensi')->get();

});

// Route::get('/', ['uses' => 'Front\HomeController@index', 'as' => 'front.home']);

Route::get('login', ['uses' => 'Front\AuthController@getLogin','as' => 'front.auth.login']);
Route::post('login', ['uses' => 'Front\AuthController@postLogin','as' => 'front.auth.check']);
Route::get('password/forgot', ['uses' => 'Front\AuthController@getLostPassword','as' => 'front.auth.forgot']);
Route::post('password/forgot', ['uses' => 'Front\AuthController@postLostPassword','as' => 'front.auth.reset']);

// Provinsi routes
Route::get('{provinsi}', ['uses' => 'Front\ProvinsiController@getDashboard','as'=>'front.provinsi.dashboard']);
Route::get('{provinsi}/profile', ['uses' => 'Front\ProvinsiController@getProfile','as'=>'front.provinsi.profile']);
