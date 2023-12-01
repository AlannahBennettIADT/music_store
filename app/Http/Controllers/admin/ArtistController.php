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
            'description' =>'required | max:200',
            'length' => 'required',
            'type' => 'required',
        ]);
        
        //Creation of another Song Object/Model
        Artist::create([
            'name' => $request->name,
            'description' => $request->description,
            'length' => $request->length,
            'type' =>$request->type,
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
