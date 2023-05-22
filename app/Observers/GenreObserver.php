<?php

namespace App\Observers;

use App\Models\Genre;
use Illuminate\Support\Str;

class GenreObserver
{
    public function creating(Genre $genre): void
    {
        $this->setSlug($genre);
    }

    public function updating(Genre $genre): void
    {
        $this->setSlug($genre);
    }

    protected function setSlug(Genre $genre): void
    {
        if (empty($genre->slug)) {
            $genre->slug = Str::slug($genre->name);
        }
    }
}
