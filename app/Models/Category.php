<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function getRandomVideos(int $count,int $id = null)
    {
        return $this->videos()->inRandomOrder()->get()->take($count)->except($id);
    }
}
