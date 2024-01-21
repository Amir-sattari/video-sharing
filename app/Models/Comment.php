<?php

namespace App\Models;

use App\Models\Traits\likeable;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, likeable;

    protected $fillable = [
        'body',
        'user_id',
    ];
    
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return (new Verta($value))->formatDifference();
    }
}
