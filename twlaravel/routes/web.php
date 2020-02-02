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

Route::get('/', function () {
	return view('index');
});

Route::prefix('api')->group(function () 
{
	Route::get('/addDocument',     'ApiController@index');
	Route::any('/uploadDocument',  'ApiController@uploadDocument');
	//http://twlaravel.sozinov.space/public/api/searcInDocument?query=jam
	Route::any('/searcInDocument','ApiController@searcInDocument');


	Route::any('/test','ApiController@test');
});