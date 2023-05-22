<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genres';
    protected $guarded = [];

    public function albums(): BelongsToMany
    {
        return $this->belongsToMany(Album::class, 'album_genres', 'genre_id', 'album_id');
    }
}
