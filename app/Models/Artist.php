<?php

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
