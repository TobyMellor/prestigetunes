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

Route::get('/', 'IndexController@showDashboard');

Route::get('/login', 'AuthController@index');
Route::get('/register', function () {
    return redirect('/login');
});
Route::post('/login', 'AuthController@authenticateUser');
Route::post('/register', 'AuthController@registerUser');
Route::get('/logout', 'AuthController@unauthenticateUser');

Route::post('/api/create-playlist', 'ApiController@createPlaylist');
