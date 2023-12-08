<?php
/* Role Model:
     - The model deals with all data - related things, handles how data is stored in data based and how to get it when needed 
     - Extends Eloquent class  ORM ( Object - Relational Mapping)
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany('User', 'user_role');
    }
}
