<?php
/* Song Controller:
- Made Specific resource controller, comes with CRUD boilerplate code
- The controller is the coordinator, listens to what user does and tells the view how to show it, (flow of the application)
- Most routes lead here, the function tells the program what to do and what view to return
*/

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Song;

class SongController extends Controller
{

    //  OLD INDEX FUNCTION, before adding queries
    // public function index()
    // {
    //     //inside the songs variable is the model song calling all
    //     $songs = Song::all();

    //     //show view index ( home page ), compact creates an array from a list of variable names 
    //     //where the variable names become the keys. It's a way to pass variables to views thats more readable and consise.
        
    //     return view('songs.index', compact('songs'));
    // }

    
    /**
     * Display a listing of all the Songs.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        $query = Song::query();
    
        // Check if a filter is applied
        if ($request->has('sort_order')) {
            // If the 'sort_order' parameter is present in the request, use it for sorting
            $sortOrder = $request->input('sort_order');
            $query->orderBy('song_name', $sortOrder);
        } else {
            // doesn't automatically sort 
            $query->orderBy('id', 'asc');
        }
    
        $songs = $query->get();

        // Use pagination with a default number of items per page (10)
        $songs = $query->paginate(10);
    
        return view('user.songs.index', compact('songs'));
    }
    
    
    /**
     * Display the specified Song.
     */
    public function show(Song $song)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');
        // returns show view, uses song id 
        return view('user.songs.show')->with('song',$song);
    }
    
}
