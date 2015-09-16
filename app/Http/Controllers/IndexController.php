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
        if(Auth::user()->priviledge == 0) {
            $playlists = $this->playlist->getPlaylists();

            if(Auth::check()) {
                return view('default.index')->with('playlists', $playlists);
            } else {
                return redirect('/login');
            }
        } elseif(Auth::user()->priviledge == 1) {
            return view('admin.index');
        }
    }
}
