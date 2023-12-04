<?php

namespace App\Http\Controllers\editor;
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
        $user->authorizeRoles('editor');
        
        $artists = Artist::all();
        return view('editor.artists.index')->with('artists',$artists);
    }


    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        $user = Auth::user();
        $user->authorizeRoles('editor');
    
        // No need to retrieve $artist, as Laravel will automatically inject it based on the route parameter
    
        $songs = $artist->songs;
        return view('editor.artists.show', compact('artist', 'songs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        //
        $user = Auth::user();
        $user->authorizeRoles('editor');
        //Edit Specific Song: , go to song edit with the song index that is clicked on ex: songs/edit/1
        // return view('editor.songs.edit')->with('song',$song);
        return view('editor.artists.edit')->with('artist',$artist);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        //
        $user = Auth::user();
        $user->authorizeRoles('editor');
        //same validation as create function
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
        $artist->update([
            'artist_name' => $request->artist_name,
            'management' => $request->management,
            'monthly_listeners' => $request->monthly_listeners,
            'country' => $request->country,
            'artist_image' => $artist_image_name,
        ]);

        //This reroutes to index after the book is created and calls the alert success component, inside the slot will be the message.
        return to_route('editor.artists.index',$artist)->with('success','Album Updated successfully');
    }

}
