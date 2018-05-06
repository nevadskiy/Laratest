<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size', 'team_id'];

    public function add($users)
    {
        $this->guardTeamOverflow($users);

        if ($users instanceof User) {
            return $this->members()->save($users);
        }
        
        return $this->members()->saveMany($users);
    }

    protected function guardTeamOverflow($newUsers)
    {
        if ($this->isFull() || !$this->isUsersFitToTeam($newUsers)) {
            throw new \Exception('Team is fully');
        }
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
    }

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

    protected function isUsersFitToTeam($newUsers)
    {
        $newTeamCount = $this->count() + (is_iterable($newUsers) ? count($users) : 1);

        return $newTeamCount <= $this->size;
    }
}
