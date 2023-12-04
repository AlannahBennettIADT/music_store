<?php
/* Song Controller:
- Made Specific resource controller, comes with CRUD boilerplate code
- The controller is the coordinator, listens to what user does and tells the view how to show it, (flow of the application)
- Most routes lead here, the function tells the program what to do and what view to return
*/

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Song;
use App\Models\Album;
use App\Models\Artist;

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
        $user->authorizeRoles('admin');

        $query = Song::query();
    
        // Check which form is submitted
        if ($request->has('sort_order')) {
            // If the 'sort_order' parameter is present in the request, use it for sorting
            $sortOrder = $request->input('sort_order');
            $query->orderBy('song_name', $sortOrder);
        } elseif ($request->has('search')) {
            // Check if a search term is provided
            $searchTerm = $request->input('search');
            $query->whereHas('artists', function ($query) use ($searchTerm) {
                $query->where('artist_name', 'like', '%' . $searchTerm . '%');
            });
        }else {
            // Default sorting if no form is submitted
            $query->orderBy('id', 'asc');
        }
    
        $songs = $query->get();

        // Use pagination with a default number of items per page (10)
        $songs = $query->paginate(10);

        // $songs = Song::with('album')->get();
    
        return view('admin.songs.index', compact('songs'));
    }
    
    
    // Other CRUD methods: create, store, edit, update, destroy, etc.


    /**
     * Show the form for creating a new Song.
     */

    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        $albums = Album::all();
        $artists = Artist::all();
        //returns create view
        return view('admin.songs.create')->with('albums',$albums)->with('artists',$artists);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $user = Auth::user();
        $user->authorizeRoles('admin');
        //Create wasn't working so I bug tested to see how far into the function the program gets:
        // testing to see if it goes into the store function - it does
        // return to_route('songs.index');

        //used laravel documentation for validation to add restrictions to the data that is allowed to be submitted
        $request->validate([
            'song_name' => 'required | min:5 | max:50',
            'song_description' =>'required | max:200',
            'song_length' => 'required | regex:/(\d+\:\d+)/',
            'song_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'album_id' =>'required',
            'artists' =>['required','exists:artists,id']
        ]);
        

        //If there is an image uploaded this code piece renames it a unique name and stores it in storage/songs
        if($request->hasFile('song_image')){
            $image =$request->file('song_image');
            $imageName = time() . '.'.$image->extension();
            $image->storeAs('public/songs',$imageName);
            $song_image_name = 'storage/songs/' . $imageName;
        }

        //Creation of another Song Object/Model
        $song = Song::create([
            'song_name' => $request->song_name,
            'song_description' => $request->song_description,
            'song_length' => $request->song_length,
            'song_image' => $song_image_name,
            'album_id' =>$request->album_id,
            // 'artists' =>$request->artists,
        ]);

        $song->artists()->attach($request->artists);

        //This reroutes to index after the book is created and calls the alert success component, inside the slot will be the message.
        return to_route('admin.songs.index')->with('success','Song created successfully');
    }

    /**
     * Display the specified Song.
     */
    public function show(Song $song)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        // returns show view, uses song id 
        return view('admin.songs.show')->with('song',$song);
    }

    /**
     * Show the form for editing the specified Song.
     */
    public function edit(Song $song)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        $albums = Album::all();
        //Edit Specific Song: , go to song edit with the song index that is clicked on ex: songs/edit/1
        // return view('admin.songs.edit')->with('song',$song);
        return view('admin.songs.edit',compact('song','albums'));
    }

    /**
     * Update the specified Song in storage.
     */
    public function update(Request $request, Song $song)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
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
        return to_route('admin.songs.show',$song)->with('success','Song updated successfully');

    }

    /**
     * Remove the specified Song from storage.
     */
    public function destroy(Song $song)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        // Delete the song
        $song->delete();
    
        // Redirect to a route or view after deleting the song
        return redirect()->route('admin.songs.index')->with('success', 'Song deleted successfully');
    }
    
}
