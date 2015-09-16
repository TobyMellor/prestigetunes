<?php

namespace App\Http\Controllers;

use Auth;
use App\Playlist;

class PlaylistController extends Controller
{

	public function __construct(){}

    public function createPlaylist($playlistName)
    {
    	if(Auth::check()) {
        	$playlist = new Playlist;

        	$playlist->playlist_name = $playlistName;
        	$playlist->user_id = Auth::id();

        	$playlist->save();
        	return true;
    	}
    	return false;
    }

    public function getPlaylists()
    {
    	return Playlist::where('user_id', Auth::id())
			->orderBy('updated_at', 'desc')
			->get();
    }
}
