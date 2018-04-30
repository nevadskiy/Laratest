<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add(User $user)
    {
        if ($this->isFull()) {
            throw new \Exception('Team is fully');
        }

        $this->members()->save($user);
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function count(): int
    {
        return $this->members()->count();
    }

    public function flush()
    {
        $this->members()->delete();
    }

    public function remove(User $user)
    {
        $user->team_id = null;
        $user->save();
    }

    protected function isFull()
    {
        return $this->count() >= $this->size;
    }
}
