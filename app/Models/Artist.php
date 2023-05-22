<?php

namespace App\Models;

use App\Traits\HasFollower;
use App\Traits\Haslikes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Artist extends Model implements \App\Interfaces\Likeable
{
    use HasFactory, HasFollower, Haslikes;

    protected $table = 'artists';
    protected $guarded = [];

    public function albums(): BelongsToMany
    {
        return $this->belongsToMany(Album::class, 'album_artists', 'artist_id', 'album_id');
    }

    public  function tracks(): BelongsToMany
    {
        return $this->belongsToMany(Track::class, 'artist_tracks', 'artist_id', 'track_id');
    }
}
