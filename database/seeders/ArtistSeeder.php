<?php
/* Artist Seeder:
	- Responsible for filling database with predefined data
	- Filled with specific records that application needs to function correctly
    - Ensures required data is available at the start
*/

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
        //how many times to create an artist
        Artist::factory()
        ->times(3)
        ->create();


        //for every artist, attatch an artist id to each song
        
        foreach(Song::all() as $song)
        {
            $artists = Artist::inRandomOrder()->take(rand(1,3))->pluck('id');
            $song->artists()->attach($artists);
        }
    }
}
