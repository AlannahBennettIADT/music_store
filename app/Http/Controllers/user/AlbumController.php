<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Support\Facades\Auth;
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
