<?php

namespace App\Http\Controllers;

use Auth;
use App\Album;

use Carbon\Carbon;

class IndexController extends Controller
{

    public $playlist;
    public $user;

    public function __construct(
        PlaylistController $playlist,
        UserController $user,
        ArtistController $artist,
        AlbumController $album,
        SongController $song
    )
    {
        $this->playlist = $playlist;
        $this->user = $user;
        $this->artist = $artist;
        $this->album = $album;
        $this->song = $song;
    }

    public function showDashboard()
    {
        if(Auth::check()) {
            if(!Auth::user()->priviledge) {
                $playlists = $this->playlist->getPlaylists();

                $lastActivePlaylistContents = $this->playlist->getLastActivePlaylistContents();

                $newSongs = $this->song->getSongs(8, 'new');
                $topSongs = $this->song->getSongs(10, 'top');
                $randomSongs = $this->song->getSongs(12, 'random');

                return view('default.index')
                    ->with('playlists', $playlists)
                    ->with('lastActivePlaylistContents', $lastActivePlaylistContents)
                    ->with('userName', Auth::user()->name)

                    ->with('newSongs', $newSongs)
                    ->with('topSongs', $topSongs)
                    ->with('randomSongs', $randomSongs);
            } elseif(Auth::user()->priviledge) {

                $groupedArtists = [];
                $artists = $this->artist->getArtists();
                foreach($artists as $artist) {
                    $selectedAlbums = [];
                    $albums = Album::where('artist_id', $artist->id);
                    if($albums->count() != 0) {
                        foreach($albums->get() as $album) {
                            $selectedAlbums[$album->id] = [
                                'album_id' => $album->id,
                                'album_name' => $album->album_name
                            ];
                        }
                        $groupedArtists[$artist->id] = [
                            'artist' => $artist->artist_name,
                            'albums' => $selectedAlbums
                        ];
                    }
                }

                $users = $this->user->getUsers(10);
                $artists = $this->artist->getArtists(10);
                $albums = $this->album->getAlbums(10);
                $songs = $this->song->getSongs(10);

                $signedUpArray = [];
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
                    ->with('songs', $songs)

                    ->with('groupedArtists', $groupedArtists)

                    ->with('signedUpArray', $signedUpArray);
            }
        } else {
            return redirect('/login');
        }
    }
}
