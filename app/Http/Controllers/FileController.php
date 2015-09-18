<?php

namespace App\Http\Controllers;

use App\Song;
use Auth;
use Validator;
use getID3;

use Illuminate\Http\Request;

class FileController extends Controller
{

    protected $songPath;

    public function getSongDuration($songPath)
    {
        $data = ['song_path' => $songPath];

        $validation = $this->validator($data);

        if(!$validation->fails()) {
            $getID3 = new getID3;
            $songInfo = $getID3->analyze($songPath);
            $playTime = $songInfo['playtime_seconds'];
            $playTime = ceil($playTime * 1000);

            return $playTime;
        } else {
            return 0;
        }
    }

    public function validator(array $data)
    {
        return Validator::make($data, [
            'song_path' => 'required|string'
        ]);
    }
}
