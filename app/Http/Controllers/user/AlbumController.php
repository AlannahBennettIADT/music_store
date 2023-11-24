<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $user->authorizeRoles('user');
        
        $albums = Album::all();
        return view('user.albums.index')->with('albums',$albums);
    }


    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        //
        $user = Auth::user();
        $user->authorizeRoles('user');

        if(!Auth::id()){
            return abort(403);
        }

        $songs = $album->songs;

        return view('user.albums.show',compact('album','songs'));
    }
}
