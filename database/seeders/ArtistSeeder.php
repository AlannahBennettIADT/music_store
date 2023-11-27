<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artist;
use App\Models\Song;


class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        Artist::factory()
        ->times(3)
        ->create();

        
        foreach(Song::all() as $song)
        {
            $artists = Artist::inRandomOrder()->take(rand(1,3))->pluck('id');
            $song->artists()->attach($artists);
        }
    }
}
