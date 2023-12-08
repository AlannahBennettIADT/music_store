<?php

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
        //creating pivot table
        Schema::create('artist_song', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artist_id');
            $table->unsignedBigInteger('song_id');
            $table->timestamps();
            
            //adding two foreign keys
            $table->foreign('artist_id')->references('id')->on('artists')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('song_id')->references('id')->on('songs')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_song');
    }
};
