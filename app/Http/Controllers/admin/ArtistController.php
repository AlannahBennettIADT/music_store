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
    
        // Retrieve the artist instance (replace ArtistModel with your actual model name)
        $artist = ArtistModel::first();
    
        $songs = $artist->songs;
        return view('admin.artists.show', compact('artist', 'songs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
