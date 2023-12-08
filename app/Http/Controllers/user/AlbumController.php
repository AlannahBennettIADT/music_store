<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/* Album User Controller:
- Made Specific resource controller, comes with CRUD boilerplate code
- The controller is the coordinator, listens to what user does and tells the view how to show it, (flow of the application)
- Most routes lead here, the function tells the program what to do and what view to return
- The user can only view everything, no edit, create or delete privileges
*/

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
