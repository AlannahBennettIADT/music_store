<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('user');
        
        $artists = Artist::all();
        return view('user.artists.index')->with('artists',$artists);
    }



    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');
    
        // No need to retrieve $artist, as Laravel will automatically inject it based on the route parameter
    
        $songs = $artist->songs;
        return view('user.artists.show', compact('artist', 'songs'));
    }

}
