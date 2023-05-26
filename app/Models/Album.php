<?php

namespace App\Models;

use App\Interfaces\Likeable;
use App\Traits\DataTables;
use App\Traits\DateFormat;
use App\Traits\Haslikes;
use App\Traits\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model implements Likeable
{
    use HasFactory, SoftDeletes, Helpers, Haslikes, DateFormat, DataTables;

    protected $table = 'albums';
    protected $guarded = [];

    final public const PUBLISHED_TEXT = 'Опубликован';
    final public const NOT_PUBLISHED_TEXT = 'Не опубликован';

    public static function getDataTablesColumns(): array
    {
        return [
            'id' => 'ID', 'title' => 'Заголовок', 'slug' => 'URL', 'cover' => 'Изображение',
            'likes' => 'Лайки', 'status' => 'Статус', 'date' => 'Дата', 'actions' => 'Действия'
        ];
    }

    public function getRowsDatatable(array $filterParams): array
    {

        $this->setQueryBuild($filterParams, ['title', 'slug', 'content']);

        $albums = $this->getQueryBuild()
            ->with('likes')
            ->get();

        $rows = [];
        foreach ($albums AS $album) {
            $rows[] = [
                'id' => $album->id,
                'title' => $album->title,
                'slug' => $album->slug,
                'cover' => $album->getImage($album->cover),
                'likes' => $album->likes()->count(),
                'published' => $album->isPublishedText(),
                'created_at' => $album->dateTimeRU(),
                'actions' => $album->getActionButtons([
                    'edit' => route('admin.album.edit', $album->id),
                    'delete' => route('admin.album.delete', $album->id)
                ])
            ];
        }

        return [
            'draw' => $filterParams['draw'],
            'iTotalRecords' => $this->getTotalRows(),
            'iTotalDisplayRecords' => $this->getTotalRowsWithFilter(),
            'aaData' => $rows
        ];
    }

    public function getCover(): string
    {
        return Storage::url($this->cover);
    }

    public function isPublishedText(): string
    {
        return ($this->is_published ? self::PUBLISHED_TEXT : self::NOT_PUBLISHED_TEXT);
    }

    public function getAllDuration(): int
    {
        return $this->tracks->sum('duration');
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class, 'album_artists', 'album_id', 'artist_id');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'album_genres', 'album_id', 'genre_id');
    }

    public function tracks(): BelongsToMany
    {
        return $this->belongsToMany(Track::class, 'album_tracks', 'album_id', 'track_id');
    }

    public function syncGenres(array $genres): void
    {
        $genresIds = [];

        if (isset($genres)) {
            foreach ($genres AS $genre) {
                if ($this->isJson($genre)) {
                    $genre = json_decode($genre, true);
                    $genresIds[] = $genre['id'];
                }
                else {
                    $createdGenre = Genre::create([
                        'name' => $genre
                    ]);
                    $genresIds[] = $createdGenre->id;
                }
            }
        }

        $this->genres()->sync($genresIds);
    }

    public function syncArtists(array $artists): void
    {
        $artistsIds = [];

        if (isset($artists)) {
            foreach ($artists AS $artist) {
                if ($this->isJson($artist)) {
                    $artist = json_decode($artist, true);
                    $artistsIds[] = $artist['id'];
                }
                else {
                    $createdArtist = Artist::create([
                        'name' => $artist
                    ]);
                    $artistsIds[] = $createdArtist->id;
                }
            }
        }

        $this->artists()->sync($artistsIds);
    }

}
