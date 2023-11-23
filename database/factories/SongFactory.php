<?php

/* Song Factory:
    -  Used for generating fake data for testing purposes
	- Makes it easy to populate database with data
    - Specific to Song Model
*/

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * 
     */

     //Creates fake data
    public function definition(): array
    {
        return [
            'song_name' => fake()->sentence,
            'song_description' => fake()->paragraph,
            'song_length' => fake()->time,
            'song_image' => fake()->imageUrl,
        ];
    }
}
