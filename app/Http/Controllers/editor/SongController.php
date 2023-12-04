<?php
/* Song Controller:
- Made Specific resource controller, comes with CRUD boilerplate code
- The controller is the coordinator, listens to what user does and tells the view how to show it, (flow of the application)
- Most routes lead here, the function tells the program what to do and what view to return
*/

namespace App\Http\Controllers\editor;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Song;
use App\Models\Album;
use App\Models\Artist;

class SongController extends Controller
{


    
    /**
     * Display a listing of all the Songs.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles('editor');

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

        // $songs = Song::with('album')->get();
    
        return view('editor.songs.index', compact('songs'));
    }
    
    
    // Other CRUD methods: create, store, edit, update, destroy, etc.



    public function show(Song $song)
    {
        $user = Auth::user();
        $user->authorizeRoles('editor');
        // returns show view, uses song id 
        return view('editor.songs.show')->with('song',$song);
    }

    /**
     * Show the form for editing the specified Song.
     */
    public function edit(Song $song)
    {
        $user = Auth::user();
        $user->authorizeRoles('editor');
        $albums = Album::all();
        //Edit Specific Song: , go to song edit with the song index that is clicked on ex: songs/edit/1
        // return view('editor.songs.edit')->with('song',$song);
        return view('editor.songs.edit',compact('song','albums'));
    }

    /**
     * Update the specified Song in storage.
     */
    public function update(Request $request, Song $song)
    {
        $user = Auth::user();
        $user->authorizeRoles('editor');
        //same validation as create function
        $request->validate([
            'song_name' => 'required',
            'song_description' =>'required',
            'song_length' => 'required',
            'song_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        //if the user uploads another image in edit, still needs to have unique name
        if($request->hasFile('song_image')){
            $image =$request->file('song_image');
            $imageName = time() . '.'.$image->extension();
            $image->storeAs('public/songs',$imageName);
            $song_image_name = 'storage/songs/' . $imageName;
        }

        //similar to create but updating the targeted song not creating a new model ($song instead of Song)
        $song->update([
            'song_name' => $request->song_name,
            'song_description' => $request->song_description,
            'song_length' => $request->song_length,
            'song_image' => $song_image_name
        ]);

        //This reroutes to show after the book is edited and calls the alert success component, inside the slot will be the message.
        return to_route('editor.songs.show',$song)->with('success','Song updated successfully');

    }    
}
