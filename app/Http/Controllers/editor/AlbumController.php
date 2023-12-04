<?php

namespace App\Http\Controllers\Editor;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Song;
use App\Models\Album;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $user->authorizeRoles('editor');
        
        $albums = Album::all();
        return view('editor.albums.index')->with('albums',$albums);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        //
        $user = Auth::user();
        $user->authorizeRoles('editor');

        if(!Auth::id()){
            return abort(403);
        }

        $songs = $album->songs;

        return view('editor.albums.show',compact('album','songs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //
        $user = Auth::user();
        $user->authorizeRoles('editor');
        //Edit Specific Song: , go to song edit with the song index that is clicked on ex: songs/edit/1
        // return view('editor.songs.edit')->with('song',$song);
        return view('editor.albums.edit')->with('album',$album);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        //
        $user = Auth::user();
        $user->authorizeRoles('editor');
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
        return to_route('editor.albums.index',$album)->with('success','Album Updated successfully');
    }


}
