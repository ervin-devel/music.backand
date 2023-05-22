<?php
namespace App\Traits;

use App\Models\Follower;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasFollower
{
    public function followers(): MorphMany
    {
        return $this->morphMany(Follower::class, 'followable');
    }
}