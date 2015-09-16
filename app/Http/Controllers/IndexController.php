<?php

namespace App\Http\Controllers;

use Auth;

class IndexController extends Controller
{

    public $playlist;

    public function __construct(PlaylistController $playlist)
    {
        $this->playlist = $playlist;
    }

    public function showDashboard()
    {

        $playlists = $this->playlist->getPlaylists();

        if(Auth::check()) {
            return view('index')->with('playlists', $playlists);
        } else {
            return redirect('/login');
        }
    }
}
