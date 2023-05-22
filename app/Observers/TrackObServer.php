<?php

namespace App\Observers;

use App\Models\Track;
use App\Services\AudioInfo;

class TrackObserver
{

    public function creating(Track $track): void
    {

        $track->file = request()->file('file')->store('public/audio');

        $audioInfo = new AudioInfo($track->file);

        $track->duration = $audioInfo->getDuration();
        $track->filesize = $audioInfo->getFileSize();
        $track->expansion = $audioInfo->getFileFormat();

        $track->artist = $audioInfo->getArtist();
        $track->name = $audioInfo->getTitle();
        $track->id3v1_year = $audioInfo->getYear();
        $track->id3v1_album = $audioInfo->getAlbum();
        $track->user_id = auth()->user()->id ?? 1;
    }

    public function updating(Track $track): void
    {

    }

}
