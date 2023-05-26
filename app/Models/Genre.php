<?php

namespace App\Models;

use App\Traits\DataTables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    use HasFactory, DataTables;

    protected $table = 'genres';
    protected $guarded = [];

    public static function getDataTablesColumns(): array
    {
        return [
            'id' => 'ID', 'name' => 'Название', 'slug' => 'URL', 'actions' => 'Действия'
        ];
    }

    public function getRowsDatatable(array $filterParams): array
    {

        $this->setQueryBuild($filterParams, ['name']);
        $genres = $this->getQueryBuild()->get();

        $rows = [];
        foreach ($genres AS $genre) {
            $rows[] = [
                'id' => $genre->id,
                'name' => $genre->name,
                'slug' => $genre->slug,
                'actions' => $genre->getActionButtons([
                    'edit' => route('admin.genre.edit', $genre->id),
                    'delete' => route('admin.genre.delete', $genre->id)
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

    public function albums(): BelongsToMany
    {
        return $this->belongsToMany(Album::class, 'album_genres', 'genre_id', 'album_id');
    }
}
