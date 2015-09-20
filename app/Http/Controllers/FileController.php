<?php

namespace App\Http\Controllers;

use App\File;
use Auth;
use Validator;
use getID3;

use Storage;

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
    
    public function uploadFiles($files)
    {
        if (Auth::check() && Auth::user()->priviledge) {

            $whitelist = [
                'mp3'
            ];

            if (isset($files['upl']) && $files['upl']['error'] == 0) {
                $destinationPath = __DIR__ . '/../uploads/';

                foreach ($files as $file) {

                    $file['name'] = str_random(5) . ' - ' . $file['name'];

                    $pathParts = pathinfo($file['name']);
                    $extension = $pathParts['extension'];
                    
                    if (!in_array(strtolower($extension), $whitelist)) {
                        return 3;
                    }
                    if (move_uploaded_file($file['tmp_name'], $destinationPath . '/' . $file['name'])) {
                        File::create([
                            'file_name' => $file['name'],
                            'user_id' => Auth::user()->id
                        ]);
                        return 0;
                    } else {
                        return 4;
                    }
                }
            } else {
                return 2;
            }
        }
        return 1;
    }

    public function renameFile($songFile, $songName)
    {
        $destinationPath = base_path('app/Http/uploads/');
        $files = File::where('user_id', Auth::user()->id)
            ->where('file_name', 'LIKE', '%' . $songFile)
            ->orderBy('created_at', 'desc')
            ->first();

        if($files != null) {
            $file = $files->first();
            $oldFileName = $file->file_name;
            $file->file_name = camel_case($songName) . '.mp3';
            if(!Storage::exists($destinationPath . camel_case($songName) . '.mp3')) {
                rename($destinationPath . $oldFileName, $destinationPath . $file->file_name);
            }
            $file->save();
            return [
                'file_name' => $file->file_name,
                'file_id' => $file->id
            ];
        } else {
            return false;
        }
    }

    public function deleteFile($song)
    {
        $destinationPath = base_path('app/Http/uploads/');
        if(is_int($song)) {
            $file = File::where('id', $song)->first();
            File::destroy($song);
            $song = $file->file_name;
        }
        unlink($destinationPath . $song);
        return true;
    }

    public function validator(array $data)
    {
        return Validator::make($data, [
            'song_path' => 'required|string'
        ]);
    }
}
