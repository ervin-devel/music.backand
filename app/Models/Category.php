<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public function tracks(): BelongsToMany
    {
        return $this->belongsToMany(Track::class, 'category_tracks', 'category_id', 'track_id');
    }

}
