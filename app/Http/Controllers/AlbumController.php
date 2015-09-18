<?php

namespace App\Http\Controllers;

use App\Album;
use Auth;
use Validator;

use Illuminate\Http\Request;

class AlbumController extends Controller
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function createAlbum()
    {
        if(Auth::check() && Auth::user()->priviledge) {

            $data = array(
                'album_name' => $request->input('album_name'),
                'album_image_loc' => $request->input('album_image_loc'),
            );

            $validation = $this->validator($data);

            if(!$validation->fails()) {
                Album::create([
                    'album_name' => $request->input('album_name'),
                    'album_image_loc' => $request->input('album_image_loc')
                ]);
                return redirect('/')->with('successMessage', 'The album has been successfully created');
            }

            $response = $validation->messages();
            return redirect('/')
                ->with('errorMessage', 'There were error(s) with the data you gave us:')
                ->with('errorValidationResponse', $response);

        }
    }

    public function deleteAlbum($albumId)
    {
        if(Auth::check()) {
            Album::destroy($albumId);
            return true;
        }
        return false;
    }

    public function getAlbums($paginate = null)
    {
        if($paginate == null)
            $albums = Album::all();
        else
            $albums = Album::paginate($paginate);
        return $albums;
    }

    public function getAlbum($albumId)
    {
        $album = Album::find($albumId);
        return $album;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'album_name' => 'required|max:255|min:1|alpha_dash|unique:Album',
            'album_image_loc' => 'required|max:255|min:1|url'
        ]);
    }
}
