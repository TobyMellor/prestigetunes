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

/**
 * Routes used for showing views
 */
Route::get('/', 'IndexController@showDashboard');

/**
 * Routes used for Authentication
 */
Route::get('/login', 'UserController@index');
Route::get('/register', function () {
    return redirect('/login');
});
Route::post('/login', 'UserController@authenticateUser');
Route::post('/register', 'UserController@registerUser');
Route::get('/logout', 'UserController@unauthenticateUser');

/**
 * Routes used by JavaScript AJAX only
 */
Route::post('/api/playlist', 'ApiController@createPlaylist');
Route::delete('/api/user', 'ApiController@deleteUser');
Route::delete('/api/album', 'ApiController@deleteAlbum');
Route::delete('/api/artist', 'ApiController@deleteArtist');
Route::delete('/api/song', 'ApiController@deleteSong');

/**
 * Routes used by forms
 */
Route::post('/artist', 'ArtistController@createArtist');
Route::post('/album', 'AlbumController@createAlbum');
Route::post('/song', 'SongController@createSong');
Route::post('/upload', 'ApiController@uploadSong');