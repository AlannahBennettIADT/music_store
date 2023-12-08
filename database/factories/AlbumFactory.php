<?php
/* Album Factory:
    -  Used for generating fake data for testing purposes
	- Makes it easy to populate database with data
    - Specific to Album Model
*/
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence,
            'description' => fake()->paragraph,
            'length' => fake()->time,
            'type' => fake()->sentence,
        ];
    }
}
