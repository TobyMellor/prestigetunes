<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Songs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'song_name',
        'album_id',
        'song_duration',
        'is_explicit'
    ];
}
