<?php
/* Songs Seeder:
	- Responsible for filling database with predefined data
	- Filled with specific records that application needs to function correctly
    - Ensures required data is available at the start
*/

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Specific to Song Model
use App\Models\Song;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   

        //tells the factory how many songs to create
        //redo migrate and seeding after changing the number, 
        //it adds to the number, if theres already 20 , changed to 5 and ran will have 25
        Song::factory(20)->create();
    }
}
