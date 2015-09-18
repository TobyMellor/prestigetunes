<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//TODO: check authentication on all API paths

class ApiController extends Controller
{

	private $responseError = 0;
	private $responseMessage = 'Action was successful';
	private $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

    public function createPlaylist(PlaylistController $playlist)
    {
    	$playlistName = $this->request->input('playlistName');

    	if(isset($playlistName)
    			&& $playlistName != null
    			&& $this->doValidation('playlist', $playlistName)) {
			if(!$playlist->createPlaylist($playlistName)) {
				$this->responseError = 1;
				$this->responseMessage = 'You are not logged in, try refreshing';
			}
		} else {
			$this->responseError = 1;
			$this->responseMessage = 'Playlist name is not valid';
		}
    }

    public function deleteUser(UserController $user)
    {
        $userId = $this->request->input('entityId');

        if(isset($userId) && $userId != null) {
            if(!$user->deleteUser($userId)) {
                $this->responseError = 1;
                $this->responseMessage = 'You\'re not logged in or you tried deleting yourself. Try refreshing.';
            }
        } else {
            $this->responseError = 1;
            $this->responseMessage = 'User ID is not valid';
        }
    }

    public function deleteArtist(ArtistController $artist)
    {
        $artistId = $this->request->input('entityId');

        if(isset($artistId) && $artistId != null) {
            if(!$artist->deleteArtist($artistId)) {
                $this->responseError = 1;
                $this->responseMessage = 'You\'re not logged in or you tried deleting yourself. Try refreshing.';
            }
        } else {
            $this->responseError = 1;
            $this->responseMessage = 'User ID is not valid';
        }
    }

    public function deleteAlbum(AlbumController $album)
    {
        $albumId = $this->request->input('entityId');

        if(isset($albumId) && $albumId != null) {
            if(!$album->deleteAlbum($albumId)) {
                $this->responseError = 1;
                $this->responseMessage = 'You\'re not logged in or you tried deleting yourself. Try refreshing.';
            }
        } else {
            $this->responseError = 1;
            $this->responseMessage = 'User ID is not valid';
        }
    }

    public function doValidation($type, $data)
    {
    	if($type == 'playlist') {
    		if(strlen($data) <= 3 || strlen($data) >= 20) {
    			return false;
    		}
    	}
    	return true;
    }

    public function __destruct()
    {
    	$responseArray = [
    		'error' => $this->responseError,
    		'message' => $this->responseMessage
    	];

    	echo json_encode($responseArray);
    }
}
