<?php
/* Album Migrations:
	- php files that define changes to database structure (schema) 
	- Collaborate on database changes
    - Instructions for changing database
    - It will create a database table named 'Albums' with the specified columns, 
      and it will set up the necessary database structure for the application to store information about Albums
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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->time('length');
            $table->text('description');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
