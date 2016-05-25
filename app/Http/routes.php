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
/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/
/*Route::get('home', 'HomeController@index');*/

Route::get('/', 'CompanyController@index');

Route::post('/add', 'CompanyController@store');

Route::put('/edit/{id}', 'CompanyController@update');

Route::delete('/destroy/{id}', 'CompanyController@destroy');


