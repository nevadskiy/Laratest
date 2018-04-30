<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Article extends Model
{
    public function scopeTrending(Builder $query, $take = 3)
    {
        return $query->orderByDesc('reads')->take($take);
    }
}
