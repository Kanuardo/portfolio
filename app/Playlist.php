<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $fillable = ['artist', 'track', 'genre', 'year', 'duration'];
}
