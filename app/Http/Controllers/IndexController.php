<?php

namespace App\Http\Controllers;

use Auth;

use Carbon\Carbon;

class IndexController extends Controller
{

    public $playlist;
    public $user;

    public function __construct(PlaylistController $playlist, UserController $user)
    {
        $this->playlist = $playlist;
        $this->user = $user;
    }

    public function showDashboard()
    {
        if(Auth::check()) {
            if(Auth::user()->priviledge == 0) {
                $playlists = $this->playlist->getPlaylists();
                return view('default.index')->with('playlists', $playlists);
            } elseif(Auth::user()->priviledge == 1) {
                $users = $this->user->getUsers(10);

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
                    ->with('signedUpArray', $signedUpArray);
            }
        } else {
            return redirect('/login');
        }
    }
}
