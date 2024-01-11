<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'slug',
        'url',
        'description',
        'thumbnail',
        'length',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getLengthForHumanAttribute()
    {
        return gmdate('i:s',$this->length);
    }

    public function getCreatedAtAttribute($value)
    {
        return (new Verta($value))->formatDifference();
    }


    public function relatedVideos(int $count = 6)
    {
        return Video::all()->random($count);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategoryNameAttribute()
    {
        return $this->category?->name;
    }
}
