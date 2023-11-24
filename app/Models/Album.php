<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Song;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'length',
        'description',
        'type',
    ];

    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}
