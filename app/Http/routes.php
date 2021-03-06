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

Route::get('/', function () {
    return view('welcome');
});

/**
 * Show Site Pages
 */
Route::get('sitepage{id}', 'PageController@showPage')->where('id', '[0-9]+');



/**
 * Admin panel
 */

// main
Route::get('admin', [
  'middleware' => 'auth',
  'uses' => 'AdminController@showMain'
]);

//page
Route::get('admin/sitepage{page}', [
  'middleware' => 'auth',
  'uses' => 'AdminController@showPage'
]);


/**
 * Auth
 */

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

/**
 * Reg
 */
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');