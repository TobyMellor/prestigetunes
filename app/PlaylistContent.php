<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaylistContent extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Playlist_contents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['playlist_id', 'song_id'];

    public function playlist()
    {
        return $this->belongsTo(Playlist::class, 'playlist_id');
    }

    public function song()
    {
        return $this->belongsTo(Song::class, 'song_id');
    }
}
