<?php

namespace App\Http\Controllers;

use Auth;
use App\Playlist;
use App\PlaylistContent;

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

    public function getLastActivePlaylistContents()
    {
        // $playlistContents = PlaylistContent::with(['playlist' => function($query) {
        //     $query
        //         ->where('user_id', Auth::user()->id)
        //         ->orderBy('created_at', 'desc')
        //         ->take(1);
        // }])
        //     ->orderBy('created_at', 'desc')
        //     ->get();

        // $playlistContents = PlaylistContent::with(['playlist' => function($query) {
        //     $query->where('user_id', Auth::user()->id)->toSql();
        // }])->orderBy('created_at', 'desc')->get();
        // var_dump($playlistContents);
        
        $playlist = Playlist::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->first();
        $playlistContents = PlaylistContent::with('Song')->where('playlist_id', $playlist->id)
            ->get();
        return $playlistContents;
    }
}
