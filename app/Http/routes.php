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

Route::get('/login', 'UserController@index');
Route::get('/register', function () {
    return redirect('/login');
});
Route::post('/login', 'UserController@authenticateUser');
Route::post('/register', 'UserController@registerUser');
Route::get('/logout', 'UserController@unauthenticateUser');

Route::post('/api/playlist', 'ApiController@createPlaylist');
Route::delete('/api/user', 'ApiController@deleteUser');
