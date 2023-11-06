<?php

/* Song Model:
     - The model deals with all data - related things, handles how data is stored in data based and how to get it when needed 
     - Extends Eloquent class  ORM ( Object - Relational Mapping)
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;





class Song extends Model
{
    use HasFactory;
    //protection against mass assignment - can set specific attributes to guarded instead of fillable if needed.
    protected $fillable = [
        'song_name',
        'song_length',
        'song_description',
        'song_image',
    ];
}
