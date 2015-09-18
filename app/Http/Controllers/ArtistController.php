<?php

namespace App\Http\Controllers;

use App\Artist;
use Auth;
use Validator;

use Illuminate\Http\Request;

class ArtistController extends Controller
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function createArtist()
    {
        if(Auth::check() && Auth::user()->priviledge) {

            $data = array(
                'artist_name' => $request->input('artist_name'),
                'artist_image_loc' => $request->input('artist_image_loc'),
            );

            $validation = $this->validator($data);

            if(!$validation->fails()) {
                Album::create([
                    'artist_name' => $request->input('artist_name'),
                    'artist_image_loc' => $request->input('artist__image_loc'),
                    'followers' => 0
                ]);
                return redirect('/')->with('successMessage', 'The artist has been successfully created');
            }

            $response = $validation->messages();
            return redirect('/')
                ->with('errorMessage', 'There were error(s) with the data you gave us:')
                ->with('errorValidationResponse', $response);

        }
    }

    public function deleteArtist($artistId)
    {
        if(Auth::check()) {
            Album::destroy($artistId);
            return true;
        }
        return false;
    }

    public function getArtists($paginate = null)
    {
        if($paginate == null)
            $artists = Artist::all();
        else
            $artists = Artist::paginate($paginate);
        return $artists;
    }

    public function getArtist($artistId)
    {
        $artist = Artist::find($artistId);
        return $artist;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'artist_name' => 'required|max:255|min:1|alpha_dash|unique:Artist',
            'artist_image_loc' => 'required|max:255|min:1|url'
        ]);
    }
}