<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
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
}
