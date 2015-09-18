<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Artists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['artist_name', 'artist_image_loc', 'followers'];
}
