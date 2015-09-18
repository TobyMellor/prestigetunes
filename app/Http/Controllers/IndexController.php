<?php

namespace App\Http\Controllers;

use Auth;

use Carbon\Carbon;

class IndexController extends Controller
{

    public $playlist;
    public $user;

    public function __construct(
        PlaylistController $playlist,
        UserController $user,
        ArtistController $artist,
        AlbumController $album
    )
    {
        $this->playlist = $playlist;
        $this->user = $user;
        $this->artist = $artist;
        $this->album = $album;
    }

    public function showDashboard()
    {
        if(Auth::check()) {
            if(!Auth::user()->priviledge) {
                $playlists = $this->playlist->getPlaylists();
                return view('default.index')
                    ->with('playlists', $playlists)
                    ->with('userName', Auth::user()->name);
            } elseif(Auth::user()->priviledge) {
                $users = $this->user->getUsers(10);
                $artists = $this->artist->getArtists(10);
                $albums = $this->album->getAlbums(10);

                $signedUpArray = array();
                foreach($users as $user) {
                    $userCreatedAt = new Carbon($user->created_at);
                    $signedUpArray[$user->id] = $userCreatedAt->diffForHumans();
                }

                return view('admin.index')
                    ->with('errorMessage', session('errorMessage'))
                    ->with('errorValidationResponse', session('errorValidationResponse'))
                    ->with('successMessage', session('successMessage'))

                    ->with('users', $users)
                    ->with('artists', $artists)
                    ->with('albums', $albums)

                    ->with('signedUpArray', $signedUpArray);
            }
        } else {
            return redirect('/login');
        }
    }
}
