<?php

namespace App\Models;

use App\Traits\DataTables;
use App\Traits\HasFollower;
use App\Traits\Haslikes;
use App\Interfaces\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Artist extends Model implements Likeable
{
    use HasFactory, HasFollower, Haslikes, DataTables;

    protected $table = 'artists';
    protected $guarded = [];

    public static function getDataTablesColumns(): array
    {
        return [
            'id' => 'ID', 'name' => 'Имя', 'slug' => 'URL', 'photo' => 'Фото', 'actions' => 'Действия'
        ];
    }

    public function getRowsDatatable(array $filterParams): array
    {

        $this->setQueryBuild($filterParams, ['name', 'slug', 'content']);

        $artists = $this
            ->getQueryBuild()
            ->select('id', 'name', 'slug', 'photo')
            ->get()
            ->map(function ($item) {
                $item['photo'] = $this->getImage($item['photo']);
                $item['actions'] = $this->getActionButtons([
                    'edit' => route('admin.artist.edit', $item['id']),
                    'delete' => route('admin.artist.delete', $item['id'])
                ]);
                return $item;
            });

        return [
            'draw' => $filterParams['draw'],
            'iTotalRecords' => $this->getTotalRows(),
            'iTotalDisplayRecords' => $this->getTotalRowsWithFilter(),
            'aaData' => $artists
        ];
    }

    public function albums(): BelongsToMany
    {
        return $this->belongsToMany(Album::class, 'album_artists', 'artist_id', 'album_id');
    }

    public  function tracks(): BelongsToMany
    {
        return $this->belongsToMany(Track::class, 'artist_tracks', 'artist_id', 'track_id');
    }
}
