<?php
namespace App\Services;

use App\Models\Track;
use Owenoj\LaravelGetId3\GetId3;

class AudioInfo
{

    public array $id3v1;

    public function __construct(string $path)
    {
        $track = GetId3::fromDiskAndPath('local', $path);
        $this->id3v1 = $track->extractInfo();
        return $this;
    }

    public function getYear()
    {
        return $this->id3v1['tags']['id3v1']['year'][0] ?? null;
    }

    public function getAlbum()
    {
        return $this->id3v1['tags']['id3v1']['album'][0] ?? null;
    }

    public function getArtist()
    {
        return $this->id3v1['tags']['id3v1']['artist'][0] ?? Track::NOT_ARTIST_TEXT;
    }

    public function getTitle()
    {
        return $this->id3v1['tags']['id3v1']['title'][0] ?? Track::NOT_NAME_TEXT;
    }

    public function getDuration()
    {
        return $this->id3v1['playtime_seconds'];
    }

    public function getFileSize()
    {
        return $this->id3v1['filesize'];
    }

    public function getFileFormat()
    {
        return $this->id3v1['fileformat'];
    }
}