<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    	$responseArray = array(
    		'error' => $this->responseError,
    		'message' => $this->responseMessage
    	);

    	echo json_encode($responseArray);
    }
}
