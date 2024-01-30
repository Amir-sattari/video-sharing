<?php

namespace App\Models;

use App\Filters\VideoFilters;
use Hekmatinasser\Verta\Verta;
use App\Models\Traits\likeable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    protected $perPage = 18;
    use HasFactory, likeable, SoftDeletes;

    protected $fillable = [
        'name',
        'category_id',
        'slug',
        'path',
        'description',
        'thumbnail',
        'length',
    ];


    # Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at','desc');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function relatedVideos(int $count = 8)
    {
        return $this->category->getRandomVideos($count,$this->id);
    }

    # Accessors

    public function getLengthForHumanAttribute()
    {
        return gmdate('i:s',$this->length);
    }

    public function getCreatedAtAttribute($value)
    {
        return (new Verta($value))->formatDifference();
    }

    public function getCategoryNameAttribute()
    {
        return $this->category->name;
    }

    public function getOwnerNameAttribute()
    {
        return $this->user?->name;
    }

    public function getOwnerAvatarAttribute()
    {
        return $this->user?->gravatar;
    }

    public function getVideoUrlAttribute()
    {
        return '/storage/' . $this->path;
    }

    public function getVideoThumbnailAttribute()
    {
        return '/storage/' . $this->thumbnail;
    }

    # Scopes

    public function scopeFilters(Builder $builder, array $params)
    {
        return (new VideoFilters($builder))->apply($params);
    }
}
