<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Playlists';

    public function playlistContent()
    {
    	return $this->hasMany(PlaylistContent::class);
    }
}
