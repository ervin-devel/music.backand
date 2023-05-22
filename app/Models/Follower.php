<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Follower extends Model
{
    use HasFactory;

    protected $table = 'followers';

    public function followable(): MorphTo
    {
        return $this->morphTo();
    }
    public function userable(): MorphTo
    {
        return $this->morphTo();
    }
 
}