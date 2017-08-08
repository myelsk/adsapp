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


Route::get('/', 'AdsController@index')->name('home');

Route::get('/ads/create', 'AdsController@create');

Route::get('/ads/{ad}', 'AdsController@show');

Route::post('/ads', 'AdsController@store');

Route::post('/ads/{ad}/edit', 'AdsController@edit');

Route::put('/ads/{ad}', 'AdsController@update');

Route::delete('/ads/{ad}', 'AdsController@destroy');




Route::post('/login', 'LoginController@store');

Route::get('/logout', 'LoginController@destroy');
