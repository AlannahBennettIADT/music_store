<?php

/* Album Seeder:
	- Responsible for filling database with predefined data
	- Filled with specific records that application needs to function correctly
    - Ensures required data is available at the start
*/
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Album;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     */
    public function run(): void
    {
        //how many times to create an album and how many songs to put in it

        Album::factory()
        ->times(3)
        ->hasSongs(4)
        ->create();
    }
}
