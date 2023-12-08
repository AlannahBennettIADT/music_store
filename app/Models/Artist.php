<?php
/* Artist Model:
     - The model deals with all data - related things, handles how data is stored in data based and how to get it when needed 
     - Extends Eloquent class  ORM ( Object - Relational Mapping)
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Song;
class Artist extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function songs()
    {
        return $this->belongstoMany(Song::class)->withTimestamps();
    }
}
