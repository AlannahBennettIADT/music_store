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
        //using songs table schema
        Schema::table('songs', function (Blueprint $table) {
            $table->unsignedBigInteger('album_id');
            //making foreign key linking from albums table
            $table->foreign('album_id')->references('id')->on('albums')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        // Drop the column
        Schema::table('songs', function (Blueprint $table) {
            $table->dropForeign(['album_id']);
            $table->dropColumn('album_id');
        });
    }
};
