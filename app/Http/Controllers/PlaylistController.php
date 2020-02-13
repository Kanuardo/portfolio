<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Playlist;
use App\Http\Resources\Playlist as PlaylistResource;

class PlaylistController extends Controller
{
    public function index()
    {

        //Get playlist
        $playlist = Playlist::paginate(5);
        
        //Return collection as a resource
        return PlaylistResource::collection($playlist);
    }
}
