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

Route::get('/', function () {
    return view('welcome');
});

Route::Group(['prefix' => 'search'], function () {
	Route::get('/provinces/{id}', 'SearchController@getProvice')->name('GetProvice');
	Route::get('/cities/{id}', 'SearchController@getCity')->name('Getcity');
});