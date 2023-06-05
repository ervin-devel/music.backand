<?php

namespace App\Observers;

use App\Models\Album;
use Illuminate\Support\Str;

class AlbumObserver
{
    protected Album $album;

    public function creating(Album $album): void
    {
        $this->setSlug($album);
        $this->setCover($album);
        $this->setPublished($album);
    }

    public function updating(Album $album): void
    {
        $this->album = $album;

        $this->setSlug($album);

        if ($album->isDirty('cover')) {
            $this->setCover($album);
        }

        $this->setPublished($album);

    }

    protected function setPublished(Album $album): void
    {
        $album->is_published = ($album->is_published === 'on' ? true : false);
    }

    protected function setCover(Album $album): void
    {
        $album->cover = request()->file('cover')->store('public/covers');
    }

    protected function setSlug(Album $album): void
    {
        if (empty($album->slug)) {
            $album->slug = Str::slug($album->title);
        }
    }


}
