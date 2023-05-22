<?php
namespace App\Traits;

use App\Interfaces\Followable;
use App\Models\Follower;

trait HasFollowed
{
    public function follow(Followable $followable)
    {
        if ($this->hasFollowed($followable)) {
             return;
        }
        app(Follower::class)
            ->userable()->associate($this)
            ->followable()->associate($followable)
            ->save();
    }
    public function unfollow(Followable $followable)
    {
        $followable->followers()
            ->whereMorphedTo('userable', $this)
            ->delete();
    }
    public function hasFollowed(Followable $followable)
    {
        if (! $followable->exists) {
          return false;
        }
 
        return $followable->followers()->whereRelation('user', 'user.id', $this->id)->exists();
    }
}