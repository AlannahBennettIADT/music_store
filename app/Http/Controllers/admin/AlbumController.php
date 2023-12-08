<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Song;
use App\Models\Album;



    /* Album Admin Controller:
    - Made Specific resource controller, comes with CRUD boilerplate code
    - The controller is the coordinator, listens to what user does and tells the view how to show it, (flow of the application)
    - Most routes lead here, the function tells the program what to do and what view to return
    */
class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //authorized to see if current user is admin
        $user = Auth::user();
        $user->authorizeRoles('admin');
        
        $albums = Album::all();
        return view('admin.albums.index')->with('albums',$albums);

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //authorized to see if current user is admin
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //returns create view
        return view('admin.albums.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //authorized to see if current user is admin
        $user = Auth::user();
        $user->authorizeRoles('admin');


        //used laravel documentation for validation to add restrictions to the data that is allowed to be submitted
        $request->validate([
            'name' => 'required | min:5 | max:50',
            'description' =>'required | max:200',
            'length' => 'required',
            'type' => 'required',
        ]);
        
        //Creation of another Song Object/Model
        Album::create([
            'name' => $request->name,
            'description' => $request->description,
            'length' => $request->length,
            'type' =>$request->type,
        ]);

        //This reroutes to index after the book is created and calls the alert success component, inside the slot will be the message.
        return to_route('admin.albums.index')->with('success','Album created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        //authorized to see if current user is admin
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //error message if theres no album with that ID
        if(!Auth::id()){
            return abort(403);
        }

        $songs = $album->songs;

        return view('admin.albums.show',compact('album','songs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //authorized to see if current user is admin
        $user = Auth::user();
        $user->authorizeRoles('admin');
        //Edit Specific Song: , go to song edit with the song index that is clicked on ex: songs/edit/1
        // return view('admin.songs.edit')->with('song',$song);
        return view('admin.albums.edit')->with('album',$album);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        //authorized to see if current user is admin
        $user = Auth::user();
        $user->authorizeRoles('admin');
        //same validation as create function
        $request->validate([
            'name' => 'required | min:5 | max:50',
            'description' =>'required | max:200',
            'length' => 'required',
            'type' => 'required',
        ]);
        
        //Creation of another Song Object/Model
        $album->update([
            'name' => $request->name,
            'description' => $request->description,
            'length' => $request->length,
            'type' =>$request->type,
        ]);

        //This reroutes to index after the book is created and calls the alert success component, inside the slot will be the message.
        return to_route('admin.albums.index',$album)->with('success','Album Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        //authorized to see if current user is admin
        $user = Auth::user();
        $user->authorizeRoles('admin');
        // Delete the album
        $album->delete();
    
        // Redirect to a route or view after deleting the album
        return redirect()->route('admin.albums.index')->with('success', 'Album deleted successfully');
    }
}
