<?php

namespace App\Models\Traits;

use App\Models\Like;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

trait likeable
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function getLikesCountAttribute()
    {
        $cache_key_name = 'likes_count_for_' . class_basename($this) . '_' . $this->id;
        
        return Cache::remember($cache_key_name,3600,function(){
            return $this->likes()->where('vote', 1)->count();
        });

    }

    public function getDislikesCountAttribute()
    {
        $cache_key_name = 'dislikes_count_for_' . class_basename($this) . '_' . $this->id;

        return Cache::remember($cache_key_name,3600,function(){
            return $this->likes()->where('vote', -1)->count();
        });}

    public function likedBy(User $user)
    {
        if($this->isLikedBy($user))
            return $this->removeLike($user);

        return $this->likes()->create([
            'vote' => 1,
            'user_id' => $user->id,
        ]);
    }

    public function dislikedBy(User $user)
    {
        if($this->isDislikedBy($user))
            return $this->removeDislike($user);

        return $this->likes()->create([
            'vote' => -1,
            'user_id' => $user->id,
        ]);
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()
        ->where('vote',1)
        ->where('user_id',$user->id)
        ->exists();
    }

    public function isDislikedBy(User $user)
    {
        return $this->likes()
        ->where('vote',-1)
        ->where('user_id',$user->id)
        ->exists();
    }

    public function removeLike(User $user)
    {
        return $this->likes()->where('vote', 1)->where('user_id', $user->id)->delete();
    }

    public function removeDislike(User $user)
    {
        return $this->likes()->where('vote', -1)->where('user_id', $user->id)->delete();
    }
}