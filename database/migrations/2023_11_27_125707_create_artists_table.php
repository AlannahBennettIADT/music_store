<?php

/* Artist Migrations:
	- php files that define changes to database structure (schema) 
	- Collaborate on database changes
    - Instructions for changing database
    - It will create a database table named 'Artists' with the specified columns, 
      and it will set up the necessary database structure for the application to store information about Artists
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
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('artist_name');
            $table->integer('monthly_listeners');
            $table->string('artist_image');
            $table->string('country');
            $table->string('management');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artists');
    }
};
