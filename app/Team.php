<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size', 'team_id'];

    public function add($user)
    {
        if ($this->isFull()) {
            throw new \Exception('Team is fully');
        }

        if ($user instanceof User) {
            return $this->members()->save($user);
        }
        
        return $this->members()->saveMany($user);
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
        $this->members()->update(['team_id' => null]);
    }

    public function remove(User $user)
    {
        return $user->leaveTeam();
    }0

    public function removeMany($users) {
        $userIds = $users->pluck('id');
        $this->members()
            ->whereIn('id', $userIds)
            ->update(['team_id' => null]);
    }

    protected function isFull()
    {
        return $this->count() >= $this->size;
    }
}
