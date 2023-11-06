<?php
/* Song Migrations:
	- php files that define changes to database structure (schema) 
	- Collaborate on database changes
    - Instructions for changing database
    - It will create a database table named 'songs' with the specified columns, 
      and it will set up the necessary database structure for the application to store information about songs
*/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('song_name');
            $table->text('song_description');
            $table->time('song_length');
            $table->string('song_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
