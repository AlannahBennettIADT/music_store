<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Song;
use App\Models\Album;
use App\Models\Artist;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        
        $artists = Artist::all();
        return view('admin.artists.index')->with('artists',$artists);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //returns create view
        return view('admin.artists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();
        $user->authorizeRoles('admin');


        //used laravel documentation for validation to add restrictions to the data that is allowed to be submitted
        $request->validate([
            'artist_name' => 'required | min:5 | max:50',
            'management' =>'required | max:200',
            'monthly_listeners' => 'required',
            'country' => 'required',
            'artist_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($request->hasFile('artist_image')){
            $image =$request->file('artist_image');
            $imageName = time() . '.'.$image->extension();
            $image->storeAs('public/artists',$imageName);
            $artist_image_name = 'storage/artists/' . $imageName;
        }
        
        //Creation of another Song Object/Model
        Artist::create([
            'artist_name' => $request->artist_name,
            'management' => $request->management,
            'monthly_listeners' => $request->monthly_listeners,
            'country' => $request->country,
            'artist_image' => $artist_image_name,
        ]);

        //This reroutes to index after the book is created and calls the alert success component, inside the slot will be the message.
        return to_route('admin.artists.index')->with('success','Album created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
    
        // No need to retrieve $artist, as Laravel will automatically inject it based on the route parameter
    
        $songs = $artist->songs;
        return view('admin.artists.show', compact('artist', 'songs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
