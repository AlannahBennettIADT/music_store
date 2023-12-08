<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Artist; // Assuming your Artist model is in the 'App\Models' namespace
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/* Artist User Controller:
- Made Specific resource controller, comes with CRUD boilerplate code
- The controller is the coordinator, listens to what user does and tells the view how to show it, (flow of the application)
- Most routes lead here, the function tells the program what to do and what view to return
- The user can only view everything, no edit, create or delete privileges
*/

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
