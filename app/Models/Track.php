<?php

namespace App\Models;

use App\Traits\DataTables;
use App\Traits\DateFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Track extends Model
{
    use HasFactory, DateFormat, DataTables;

    protected $table = 'tracks';
    protected $guarded = [];

    final public const NOT_ARTIST_TEXT = 'Неизвестный';
    final public const NOT_NAME_TEXT = 'Неуказан';

    public static function getDataTablesColumns(): array
    {
        return [
            'id' => 'ID', 'name' => 'Название', 'user' => 'Загрузил', 'date' => 'Дата', 'actions' => 'Действия'
        ];
    }

    public function getFullName(): string
    {
        return $this->artist . ' - ' . $this->name . $this->getDurationToString();
    }


    public function getRowsDatatable(array $filterParams): array
    {

        $this->setQueryBuild($filterParams, ['artist', 'name']);

        $tracks = $this->getQueryBuild()
            ->with('user')
            ->get();

        $rows = [];
        foreach ($tracks AS $track) {
            $rows[] = [
                'id' => $track->id,
                'name' => $track->getFullName(),
                'user' => $track->user->name,
                'created_at' => $track->dateTimeRU(),
                'actions' => $track->getActionButtons([
                    'edit' => route('admin.track.edit', $track->id),
                    'delete' => route('admin.track.delete', $track->id)
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

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class, 'artist_tracks', 'track_id', 'artist_id');
    }

    public function related(): BelongsToMany
    {
        return $this->belongsToMany(Track::class, 'track_related', 'track_id', 'track_related_id');
    }

    public function user(): hasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function syncArtists(array $artists): void
    {
        $artistIds = [];
        foreach ($artists AS $artist) {
            $artist = json_decode($artist, true);
            $artistIds[] = $artist['id'];
        }

        $this->artists()->sync($artistIds);
    }
}
