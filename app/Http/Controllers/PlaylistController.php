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

    public function getPlaylist($playlistId)
    {
        $playlistInformation = PlaylistContent::with('playlist')
            ->where('playlist_id', $playlistId)
            ->orderBy('updated_at', 'desc')
            ->get();

        $playlistContents = [];

        foreach($playlistInformation as $playlistContent) {
            $playlistContents[$playlistContent->song->song_id . rand(1,5)] = [
                'song_name' => $playlistContent->song->song_name,
                'album_name' => $playlistContent->song->album->album_name,
                'album_image_loc' => $playlistContent->song->album->album_image_loc,
                'artist_name' => $playlistContent->song->album->artist->artist_name,
                'file_name' => $playlistContent->song->file->file_name
            ];
        }

        return $playlistContents;
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
