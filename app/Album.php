<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Albums';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['album_name', 'album_image_loc', 'artist_id'];
}
