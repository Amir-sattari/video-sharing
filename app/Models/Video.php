<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $perPage = 18;
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

    public function relatedVideos(int $count = 8)
    {
        return $this->category->getRandomVideos($count);
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
