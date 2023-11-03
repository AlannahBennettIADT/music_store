<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;

class SongController extends Controller
{
    /**
     * Display a listing of all the Songs.
     */
    // public function index()
    // {
    //     //inside the songs variable is the model song calling all
    //     $songs = Song::all();

    //     //show view index ( home page ), compact creates an array from a list of variable names 
    //     //where the variable names become the keys. It's a way to pass variables to views thats more readable and consise.
        
    //     return view('songs.index', compact('songs'));
    // }

    public function index(Request $request)
    {
        $query = Song::query();
    
        // Check if a filter is applied
        if ($request->has('sort_order')) {
            // If the 'sort_order' parameter is present in the request, use it for sorting
            $sortOrder = $request->input('sort_order');
            $query->orderBy('song_name', $sortOrder);
        } else {
            // No filter applied, use the default sorting (ascending)
            $query->orderBy('id', 'asc');
        }
    
        $songs = $query->get();
        
        // Use pagination with a default number of items per page (e.g., 10)
        $songs = $query->paginate(10);
    
        return view('songs.index', compact('songs'));
    }
    
    
    

    // Other CRUD methods: create, store, edit, update, destroy, etc.
    /**
     * Show the form for creating a new Song.
     */

    public function create()
    {
        //
        return view('songs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Create wasn't working so I bug tested to see how far into the function the program gets:
        // testing to see if it goes into the store function - it does
        // return to_route('songs.index');

        //used laravel documentation for validation to add restrictions to the data that is allowed to be submitted
        $request->validate([
            'song_name' => 'required | min:5 | max:50',
            'song_description' =>'required | max:200',
            'song_length' => 'required | regex:/(\d+\:\d+)/',
            'song_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        

        //If there is an image uploaded this code piece renames it a unique name and stores it in storage/songs
        if($request->hasFile('song_image')){
            $image =$request->file('song_image');
            $imageName = time() . '.'.$image->extension();
            $image->storeAs('public/songs',$imageName);
            $song_image_name = 'storage/songs/' . $imageName;
        }

        //Creation of another Song Object/Model
        Song::create([
            'song_name' => $request->song_name,
            'song_description' => $request->song_description,
            'song_length' => $request->song_length,
            'song_image' => $song_image_name
        ]);

        //This reroutes to index after the book is created and calls the alert success component, inside the slot will be the message.
        return to_route('songs.index')->with('success','Song created successfully');
    }

    /**
     * Display the specified Song.
     */
    public function show(Song $song)
    {
        // 
        return view('songs.show')->with('song',$song);
    }

    /**
     * Show the form for editing the specified Song.
     */
    public function edit(Song $song)
    {
        //Edit Specific Song: , go to song edit with the song index that is clicked on ex: songs/edit/1
        return view('songs.edit')->with('song',$song);
    }

    /**
     * Update the specified Song in storage.
     */
    public function update(Request $request, Song $song)
    {
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
        return to_route('songs.show',$song)->with('success','Song updated successfully');

    }

    /**
     * Remove the specified Song from storage.
     */
    public function destroy(Song $song)
    {
        // Delete the song
        $song->delete();
    
        // Redirect to a route or view after deleting the song
        return redirect()->route('songs.index')->with('success', 'Song deleted successfully');
    }
    
}
