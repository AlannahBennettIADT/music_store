<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Song;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //redo migrate and seeding after changing the number, it adds to the number, if theres already 20 , changed to 5 and ran will have 25
        Song::factory(20)->create();
    }
}
