<?php

namespace App\Observers;

use App\Models\Artist;
use Illuminate\Support\Str;

class ArtistObserver
{
    public function creating(Artist $artist): void
    {
        $this->setSlug($artist);
        $artist->photo = request()->file('photo')->store('public/artists');
    }

    public function updating(Artist $artist): void
    {
        $this->setSlug($artist);
        if ($artist->isDirty('photo')) {
            $artist->photo = request()->file('photo')->store('public/artists');
        }
    }

    protected function setSlug(Artist $artist): void
    {
        if (empty($artist->slug)) {
            $artist->slug = Str::slug($artist->name);
        }
    }
}
