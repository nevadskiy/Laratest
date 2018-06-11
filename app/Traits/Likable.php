<?php

namespace App\Traits;

use Auth;
use App\Like;

trait Likable
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function like()
    {
        $like = new Like(['user_id' => auth()->id()]);

        $this->likes()->save($like);
    }

    public function unlike()
    {
        $this->likes()->where('user_id', Auth::id())->delete();
    }

    public function isLiked()
    {
        return (bool)$this->likes()->where('user_id', Auth::id())->count();
    }

    public function toggle()
    {
        if ($this->isLiked()) {
            return $this->unlike();
        }

        return $this->like();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}