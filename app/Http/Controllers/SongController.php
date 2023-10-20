<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $songs = Song::all();
        return view('songs.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
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
        //
        $request->validate([
            'song_name' => 'required'
        ]);

        Song::create([
            'song_name' => $request->song_name,
            'song_description' =>  $request->song_description,
            'song_length' => $request->song_length,
            'song_image' => $request->song_image
        ]);

        return to_route('songs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        // 
        return view('songs.show')->with('song',$song);
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