<?php

namespace App\Http\Controllers;

use App\Song;
use App\Rating;
use App\Album;
use Auth;
use Validator;

use Illuminate\Http\Request;

class SongController extends Controller
{

    protected $request;
    protected $file;

    public function __construct(Request $request, FileController $file)
    {
        $this->request = $request;
        $this->file = $file;
    }

    public function createSong()
    {
        if(Auth::check() && Auth::user()->priviledge) {

            $request = $this->request;

            $songName = $request->input('song_name');
            $albumId = $request->input('album_id');
            $songFile = $request->input('song_file');

            if($songFile != null) {

                $songFileArray = $this->file->renameFile($songFile, $songName);
                $songFile = $songFileArray['file_name'];
                $songFileId = $songFileArray['file_id'];

                if($songFile != false) {

                    $songDuration = $this->file->getSongDuration(base_path('public/uploads') . '/' . $songFile);
                    $isExplicit = $request->input('is_explicit');

                    if($isExplicit == null) {
                        $isExplicit = false;
                    } else {
                        $isExplicit = true;
                    }

                    if($songDuration != 0) {
                        $data = [
                            'song_name' => $songName,
                            'album_id' => $albumId,
                            'song_duration' => $songDuration,
                            'is_explicit' => $isExplicit
                        ];

                        $validation = $this->validator($data);

                        if(!$validation->fails()) {
                            Song::create([
                                'song_name' => $songName,
                                'album_id' => $albumId,
                                'song_duration' => $songDuration,
                                'is_explicit' => $isExplicit,
                                'file_id' => $songFileId
                            ]);
                            return redirect('/')->with('successMessage', 'The song has been successfully created');
                        }

                        $response = $validation->messages();
                        return redirect('/')
                            ->with('errorMessage', 'There were error(s) with the data you gave us:')
                            ->with('errorValidationResponse', $response);
                    } else {
                        return redirect('/')->with('errorMessage', 'An internal server error occured whilst checking the duration of the song.<br />Make sure the file is valid, then try again.');
                    }
                } else {
                    return redirect('/')->with('errorMessage', 'We couldn\'t find your uploaded file. Try again.');
                }
            } else {
                return redirect('/')->with('errorMessage', 'Please select a song before submitting it!');
            }
        }
    }

    public function addRating($songId, $songRating)
    {
        if(Auth::check()) {
            $previousRating = Rating::where('user_id', Auth::user()->id)
                ->where('song_id', $songId)
                ->count();
            if($previousRating == 0) {
                Rating::create([
                    'user_id' => Auth::user()->id,
                    'song_id' => $songId
                ]);

                $song = Song::find($songId);
                $songTotalRating = $song->song_rating + $songRating;
                $song->song_rating = $songTotalRating;
                $song->save();

                return true;
            }
        }
        return false;
    }

    public function getSongRating($songId, $songTotalRating = null)
    {
        if(Auth::check()) {
            if($songTotalRating == null) {
                $song = Song::find($songId);
                $songTotalRating = $song->song_rating;
            }
            $songRatingCount = Rating::where('song_id', $songId)->count();
            $songRating = $songTotalRating / $songRatingCount;

            return $songRating;
        }
        return false;
    }

    public function getSongs($paginate = null, $type = null)
    {
        if($paginate == null) {
            $songs = Song::all();
        } else {
            if($type == null) {
                $songs = Song::paginate($paginate);
            } else {
                //TODO: Implement Ratings (TOP LIST)
                if($type == 'new' || $type == 'top') {
                    $songs = Song::with('album')
                        ->orderBy('created_at', 'desc')
                        ->take($paginate)
                        ->get();
                } else {
                    $songs = Song::with('album')
                        ->orderByRaw('Rand()')
                        ->take($paginate)
                        ->get();
                }
            }
        }
        return $songs;
    }

    public function getSong($songId)
    {
        $song = Song::find($songId);
        return $song;
    }

    public function deleteSong($songId)
    {
        if(Auth::check()) {
            $song = Song::where('id', $songId)->first();

            if($this->file->deleteFile($song->file_id)) {
                Song::destroy($songId);
                return true;
            }
        }
        return false;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'song_name' => 'required|between:1,30|alpha_dash_spaces|unique:Songs',
            'album_id' => 'required|integer',
            'song_duration' => 'required|integer',
            'is_explicit' => 'required|boolean'
        ]);
    }
}
